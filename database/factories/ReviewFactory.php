<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           "book_id" =>null,
            'review' => $this->faker->text(),
            'rating' => $this->faker->numberBetween(1,5),
            'created_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'updated_at' => fake()->dateTimeBetween('-2 years', 'now'),

        ];
    }

    public function good(){
        return $this->state([
            'rating' => $this->faker->numberBetween(4,5),
        ]);
    }
    public function bad(){
        return $this->state([
            'rating' => $this->faker->numberBetween(1,3),
        ]);
    }

    public function avg(){
        return $this->state([
            'rating' => $this->faker->numberBetween(3,5),
        ]);
    }
}
