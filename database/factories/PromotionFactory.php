<?php

namespace Database\Factories;

use App\Models\Promotion;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promotion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'price_promo' => $this->faker->randomNumber(1),
            'date_start' => $this->faker->dateTime(),
            'date_end' => $this->faker->dateTime(),
            'promotionable_type' => $this->faker->randomElement([
                \App\Models\MenuItem::class,
            ]),
            'promotionable_id' => function (array $item) {
                return app($item['promotionable_type'])->factory();
            },
        ];
    }
}
