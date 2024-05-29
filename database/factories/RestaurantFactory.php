<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->text(),
            'excerpt' => $this->faker->text(255),
            'is_published' => $this->faker->boolean(),
            'comment_status' => $this->faker->boolean(),
            'ping_status' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTime(),
            'phone' => $this->faker->phoneNumber(),
            'phone_2' => $this->faker->text(255),
            'phone_3' => $this->faker->text(255),
            'reservation_required' => $this->faker->boolean(),
            'website_url' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
