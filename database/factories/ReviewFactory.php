<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->text(),
            'rating' => $this->faker->numberBetween(0, 127),
            'user_id' => \App\Models\User::factory(),
            'reviewable_type' => $this->faker->randomElement([
                \App\Models\Restaurant::class,
            ]),
            'reviewable_id' => function (array $item) {
                return app($item['reviewable_type'])->factory();
            },
        ];
    }
}
