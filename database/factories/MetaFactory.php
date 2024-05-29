<?php

namespace Database\Factories;

use App\Models\Meta;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meta::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meta_key' => $this->faker->text(255),
            'metaable_type' => $this->faker->randomElement([
                \App\Models\Restaurant::class,
                \App\Models\User::class,
            ]),
            'metaable_id' => function (array $item) {
                return app($item['metaable_type'])->factory();
            },
        ];
    }
}
