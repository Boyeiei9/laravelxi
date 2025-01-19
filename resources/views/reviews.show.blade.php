@extends('layouts.app')

@section('content')
    <h3>Your Review</h3>

    @if(session('review'))
        <p><strong>Rating:</strong> {{ session('review')['rating'] }}</p>
        <p><strong>Review:</strong> {{ session('review')['review'] }}</p>

        @if(session('review')['image'])
            <img src="{{ Storage::url(session('review')['image']) }}" alt="Review Image">
        @endif
    @else
        <p>No review found.</p>
    @endif
@endsection