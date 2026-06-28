@extends('layouts.app')

@section('title', 'Book Details')

@section('content')

    <div class="max-w-4xl mx-auto">

        <!-- Book Card -->
        <div class="bg-white rounded-xl shadow p-8 mb-8">

            <h1 class="text-3xl font-bold text-gray-900">
                {{ $book->title }}
            </h1>

            <p class="text-lg text-gray-500 mt-2">
                by {{ $book->author }}
            </p>

            <div class="flex items-center gap-6 mt-5 text-sm">

                <div class="flex items-center gap-2">
                    <x-star-rating :rating="$book->reviews_avg_rating" />
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-blue-500 text-lg">📝</span>
                    <span class="font-medium text-gray-700">
                {{ $book->reviews_count }} Reviews
            </span>
                </div>

            </div>

            <div class="mt-5 pt-4 border-t flex gap-6 text-sm text-gray-500">

        <span>
            📅 {{ $book->created_at->format('M d, Y') }}
        </span>

                <span>
            ✏️ {{ $book->updated_at->format('M d, Y') }}
        </span>

            </div>

        </div>

        @if(session()->has('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">

                {{ session('success') }}

            </div>
        @endif

            <div>
                 <a href="{{ route('books.reviews.create', ['book'=>$book]) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-5 inline-block"
                 >
                     Add Review

                 </a>
           </div>


        <!-- Reviews -->
        <div>

            <h2 class="text-2xl font-bold mb-5">
                Reviews
            </h2>

            @forelse($book->reviews as $review)

                <div class="bg-white rounded-xl shadow p-5 mb-4">

                    <div class="flex justify-between items-center mb-4">

                        <x-star-rating :rating="$review->rating" />

                        <span class="text-sm text-gray-400">
            {{ $review->created_at->format('M d, Y') }}
        </span>

                    </div>

                    <p class="text-gray-700 leading-7">
                        {{ $review->review }}
                    </p>

                </div>

            @empty

                <div class="bg-white rounded-xl shadow p-8 text-center text-gray-500">

                    <div class="text-5xl mb-3">📝</div>

                    <p class="font-semibold">
                        No reviews yet
                    </p>

                </div>

            @endforelse

        </div>

    </div>

@endsection
