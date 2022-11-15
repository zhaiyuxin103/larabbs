<?php

namespace Database\Factories;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'topic_id' => $this->faker->numberBetween(1, 1000),
            'user_id' => $this->faker->numberBetween(1, 100),
            'parent_id' => $this->faker->randomElement([$this->faker->randomNumber(3), null]),
            'content' => $this->faker->sentence(),
            'show' => $this->faker->randomElement([0, 1]),
            'order' => $this->faker->randomNumber(3),
        ];
    }
}
