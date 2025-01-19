

    <h1>Submit Your Review</h1>

    <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="rating">Rating (1-5)</label>
            <input type="number" id="rating" name="rating" min="1" max="5" value="{{ old('rating') }}">
            @error('rating') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="review">Review</label>
            <textarea id="review" name="review">{{ old('review') }}</textarea>
            @error('review') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="image">Upload Image (Optional)</label>
            <input type="file" id="image" name="image">
            @error('image') <span>{{ $message }}</span> @enderror
        </div>

        <button type="submit">Submit Review</button>
    </form>

