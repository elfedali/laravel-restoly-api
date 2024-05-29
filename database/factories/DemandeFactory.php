<?php

namespace Database\Factories;

use App\Models\Demande;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Demande::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'demandeable_type' => $this->faker->randomElement([
                \App\Models\Restaurant::class,
            ]),
            'demandeable_id' => function (array $item) {
                return app($item['demandeable_type'])->factory();
            },
        ];
    }
}
