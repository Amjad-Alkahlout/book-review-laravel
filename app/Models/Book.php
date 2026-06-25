<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
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
            ->orderByDesc('reviews_count')->withAvg('reviews', 'rating');
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
            ->orderByDesc('reviews_avg_rating')->withCount('reviews');
    }

    public function scopeLatestBooks($query){
        return $query->latest()->withCount('reviews')
            ->withAvg('reviews', 'rating');
    }

}
