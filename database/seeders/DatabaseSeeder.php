<?php

namespace Database\Seeders;
use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        Book::factory()->count(33)->create()->each(function ($book) {
            $reviewsnum=random_int(5,30);
            Review::factory()->count($reviewsnum)->
                good()->for($book)->create();
        });

        Book::factory()->count(33)->create()->each(function ($book) {
            $reviewsnum=random_int(5,30);
            Review::factory()->count($reviewsnum)->
            avg()->for($book)->create();
        });

        Book::factory()->count(34)->create()->each(function ($book) {
            $reviewsnum=random_int(5,30);
            Review::factory()->count($reviewsnum)->
            bad()->for($book)->create();
        });
    }
}
