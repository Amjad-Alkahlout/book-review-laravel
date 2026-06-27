<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = $request->input('filter', '');
        $title = $request->input('title');
        $page = $request->input('page', 1);
        $cacheKey = "books-test:title={$title}:filter={$filter}:page={$page}";
        $books = Book::query();
            if ($title) {
                $books->search($title);
            }



        $books = match ($filter) {
            'popular_last_month' =>
            $books->popular(now()->subMonth(), now()),

            'popular_last_6months' =>
            $books->popular(now()->subMonths(6), now()),

            'highest_rated_last_month' =>
            $books->highestRated(now()->subMonth(), now()),

            'highest_rated_last_6months' =>
            $books->highestRated(now()->subMonths(6), now()),

            default =>
            $books->latestBooks()
        };
        $books = Cache::remember($cacheKey, 3600, fn () => $books->paginate(10));
        return view('books.index', compact('books'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Cache::remember("book:{$id}", 3600, function () use ($id) {
            return Book::with([
                'reviews' => function ($query) {
                    $query->orderByDesc('created_at');
                }
            ])
                ->withCount('reviews')
                ->withAvg('reviews', 'rating')
                ->findOrFail($id);
        });


        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
