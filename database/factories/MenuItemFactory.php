<?php

namespace Database\Factories;

use App\Models\MenuItem;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(255),
            'ingredients' => $this->faker->text(255),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'is_disponible' => $this->faker->boolean(),
            'is_vegetarian' => $this->faker->boolean(),
            'picture' => $this->faker->text(255),
            'menu_id' => \App\Models\Menu::factory(),
        ];
    }
}
