<?php

namespace Database\Factories;

use App\Models\Ping;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ping::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_start' => $this->faker->dateTime(),
            'date_end' => $this->faker->dateTime(),
            'note' => $this->faker->text(255),
            'is_active' => $this->faker->boolean(),
            'pingable_type' => $this->faker->randomElement([
                \App\Models\Restaurant::class,
            ]),
            'pingable_id' => function (array $item) {
                return app($item['pingable_type'])->factory();
            },
        ];
    }
}
