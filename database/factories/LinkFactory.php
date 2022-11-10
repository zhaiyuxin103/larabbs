<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'description' => $this->faker->sentence,
            'link' => $this->faker->url,
            'show' => $this->faker->randomElement([0, 1]),
            'order' => $this->faker->randomNumber(3),
        ];
    }
}
