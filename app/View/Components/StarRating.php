<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class StarRating extends Component
{
    public function __construct(
        public float|null $rating
    ) {}

    public function render()
    {
        return view('components.star-rating');
    }
}
