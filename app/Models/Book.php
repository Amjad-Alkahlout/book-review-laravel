<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'review',
    ];

    public function reviews(){

        return $this->hasMany(Review::class);
    }

    public function scopeSearch($query, $search){
        if($search){
            $query->where(function($query) use($search){
                $query->where('title', 'LIKE', '%'.$search.'%');
            });
        }
    }

    public function scopePopular($query, $from = null, $to = null)
    {
        return $query
            ->withCount([
                'reviews' => function ($query) use ($from, $to) {

                    $query->when($from && $to, function ($query) use ($from, $to) {
                        $query->whereBetween('created_at', [$from, $to]);
                    });
                }
            ])
            ->orderByDesc('reviews_count')->withAvg([
                'reviews' => function ($query) use ($from, $to) {

                    $query->when($from && $to, function ($query) use ($from, $to) {
                        $query->whereBetween('created_at', [$from, $to]);
                    });

                }
            ], 'rating');
    }

    public function scopeHighestRated($query, $from = null, $to = null)
    {
        return $query
            ->withAvg([
                'reviews' => function ($query) use ($from, $to) {

                    $query->when($from && $to, function ($query) use ($from, $to) {
                        $query->whereBetween('created_at', [$from, $to]);
                    });

                }
            ], 'rating')
            ->orderByDesc('reviews_avg_rating')->withCount([
                'reviews' => function ($query) use ($from, $to) {
                    $query->when($from && $to, function ($query) use ($from, $to) {
                        $query->whereBetween('created_at', [$from, $to]);
                    });
                }
            ]);
    }

    public function scopeLatestBooks($query){
        return $query->latest()->withCount('reviews')
            ->withAvg('reviews', 'rating');
    }
    protected static function booted()
    {
        static::created(function (Book $book) {
            cache()->forget("book:{$book->id}");
            cache()->flush();
        });

        static::updated(function (Book $book) {
            cache()->forget("book:{$book->id}");
            cache()->flush();
        });

        static::deleted(function (Book $book) {
            cache()->forget("book:{$book->id}");
            cache()->flush();
        });
    }
}
