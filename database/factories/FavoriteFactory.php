<?php

namespace Database\Factories;

use App\Models\Favorite;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'favoritable_type' => $this->faker->randomElement([
                \App\Models\Restaurant::class,
            ]),
            'favoritable_id' => function (array $item) {
                return app($item['favoritable_type'])->factory();
            },
        ];
    }
}
