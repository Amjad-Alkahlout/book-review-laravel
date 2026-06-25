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
                    <span class="text-yellow-500 text-lg">⭐</span>
                    <span class="font-medium text-gray-700">
                {{ number_format($book->reviews_avg_rating, 1) }}/5
            </span>
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

        <!-- Reviews -->
        <div>

            <h2 class="text-2xl font-bold mb-5">
                Reviews
            </h2>

            @forelse($book->reviews as $review)

                <div class="bg-white rounded-xl shadow p-5 mb-4">

                    <div class="flex justify-between items-center mb-4">

                        <div class="flex items-center gap-1">

                            @for($i = 1; $i <= 5; $i++)

                                @if($i <= $review->rating)

                                    <span class="text-yellow-400">★</span>

                                @else

                                    <span class="text-gray-300">★</span>

                                @endif

                            @endfor

                        </div>

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
