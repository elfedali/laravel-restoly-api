<?php

namespace Database\Factories;

use App\Models\Term;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Term::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(255),
            'slug' => $this->faker->slug(),
            'taxonomy_id' => \App\Models\Taxonomy::factory(),
        ];
    }
}
