@extends('layouts.app')

@section('title', 'Books')

@section('content')

    <form method="GET" action="{{ route('books.index') }}" class="mb-6 flex gap-3">

        <input
            type="text"
            name="title"
            id="title"
            value="{{ request('title') }}"
            placeholder="Search books by title..."
            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <input
            type="hidden"
            name="filter"
            value="{{ request('filter') }}"
        >

        <button
            type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
            Search
        </button>

    </form>

    @php
        $filters = [
            '' => 'Latest',
            'popular_last_month' => 'Popular Last Month',
            'popular_last_6months' => 'Popular Last 6 Months',
            'highest_rated_last_month' => 'Highest Rated Last Month',
            'highest_rated_last_6months' => 'Highest Rated Last 6 Months',
        ];
    @endphp

    <div class="flex flex-wrap gap-2 mb-8">

        @foreach($filters as $key => $label)

            <a
                href="{{ route('books.index', [...request()->query(),'filter' => $key, 'title' => request('title')]) }}"
                class="px-4 py-2 rounded-lg border transition
            {{ request('filter') == $key
                ? 'bg-blue-600 text-white border-blue-600'
                : 'bg-white text-gray-700 hover:bg-gray-100 border-gray-300' }}">

                {{ $label }}

            </a>

        @endforeach

    </div>
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">
            Books
        </h1>

    </div>

    <div class="grid gap-5">

        @forelse($books as $book)

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">

                <h2 class="text-xl font-semibold mb-1">
                    <a
                        href="{{ route('books.show', $book) }}"
                        class="hover:text-blue-600">

                        {{ $book->title }}

                    </a>
                </h2>

                <p class="text-gray-500 mb-4">
                    by {{ $book->author }}
                </p>

                <div class="flex items-center justify-between text-sm">
                    <div class="flex">
                        <x-star-rating :rating="$book->reviews_avg_rating" />
                    </div>

                    <span class="text-gray-500">
                    📝 {{ $book->reviews_count }} Reviews
                </span>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-xl shadow p-8 text-center text-gray-500">

                <div class="text-5xl mb-3">📚</div>

                <p class="text-lg font-medium">
                    No books found
                </p>

                <p class="text-sm text-gray-400 mt-1">
                    Try another search or filter.
                </p>

            </div>

        @endforelse

    </div>

    @if(method_exists($books, 'links'))
        <div class="mt-8 flex justify-center">
            {{ $books->links() }}
        </div>
    @endif

@endsection
