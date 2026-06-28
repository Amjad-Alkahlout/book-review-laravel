@extends('layouts.app')
@section('title', 'Add Review')

@section('content')
    <div class="max-w-4xl mx-auto">

        @if(session()->has('error'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-transition
                x-show="show"
                class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-6">Add Review for "{{ $book->title }}"</h1>

        <form action="{{ route('books.reviews.store', ['book' => $book]) }}" method="POST" class="bg-white rounded-xl shadow p-8">
            @csrf

            <div class="mb-4">
                <label for="rating" class="block text-gray-700 font-medium mb-2">Rating</label>
                <select name="rating" id="rating" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    <option value="">Select a rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="review" class="block text-gray-700 font-medium mb-2">Review</label>
                <textarea name="review" id="review" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">{{ old('review') }}</textarea>
                @error('review')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Submit Review</button>
        </form>
    </div>
@endsection
