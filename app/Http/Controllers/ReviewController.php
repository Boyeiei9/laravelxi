<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function create()
    {
        return view('reviews.create');  // แสดงฟอร์มสำหรับกรอกรีวิว
    }

    public function store(Request $request)
    {
        // การตรวจสอบข้อมูลที่ได้รับจากฟอร์ม
        $request->validate([
            'product_id' => 'required|exists:products,id',  // ตรวจสอบว่า product_id มีอยู่จริงในฐานข้อมูล
            'rating' => 'required|integer|min:1|max:5',  // ตรวจสอบคะแนนรีวิว
            'review' => 'required|string|min:10|max:1000',  // ตรวจสอบข้อความรีวิว
            'image' => 'nullable|image|max:2048',  // ตรวจสอบไฟล์ภาพ
        ]);

        // การอัปโหลดไฟล์ภาพ (ถ้ามี)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');  // บันทึกภาพในโฟลเดอร์ 'reviews'
        }

        // การบันทึกรีวิวลงในฐานข้อมูล
        Review::create([
            'product_id' => $request->input('product_id'),
            'user_id' => Auth::id(),  // ใช้ user_id ของผู้ใช้ที่ล็อกอิน
            'rating' => $request->input('rating'),
            'review' => $request->input('review'),
            'image' => $imagePath,
        ]);

        // ส่งกลับไปที่หน้าแสดงสินค้าหรือหน้าที่ต้องการ
        return redirect()->route('products.show', ['product' => $request->input('product_id')])
                         ->with('success', 'Review submitted successfully!');
    }
}

