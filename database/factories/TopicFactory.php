<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['title' => 'string', 'subtitle' => 'string', 'body' => 'string', 'user_id' => 'int', 'category_id' => 'int', 'is_released' => 'bool', 'need_released' => 'bool', 'released_at' => "\DateTime", 'excerpt' => 'string'])]
 public function definition(): array
 {
     return [
         'title' => $this->faker->sentence(),
         'subtitle' => $this->faker->sentence(),
         'body' => $this->faker->text(),
         'user_id' => $this->faker->numberBetween(1, 100),
         'category_id' => $this->faker->numberBetween(1, 61),
         'is_released' => $this->faker->boolean(),
         'need_released' => $this->faker->boolean(),
         'released_at' => $this->faker->dateTime(),
         'excerpt' => $this->faker->sentence(),
     ];
 }
}
