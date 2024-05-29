<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity_key' => $this->faker->text(255),
            'activity_content' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
