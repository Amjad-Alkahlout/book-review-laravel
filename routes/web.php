<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index']);
Route::resource('books', BookController::class);
Route::resource('books.reviews', ReviewController::class)->scoped(['books' => 'reviews']);

