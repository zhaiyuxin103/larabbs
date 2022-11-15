<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        $body = $this->faker->text();

        return [
            'title' => $this->faker->sentence(),
            'subtitle' => $this->faker->sentence(),
            'body' => $body,
            'user_id' => $this->faker->numberBetween(1, 100),
            'category_id' => Category::whereNotNull('parent_id')->where('is_directory', false)->where('level', 1)->where('show', 1)->inRandomOrder()->value('id'),
            'is_released' => $this->faker->boolean(),
            'need_released' => $this->faker->boolean(),
            'released_at' => $this->faker->dateTime(),
            'vote_count' => $this->faker->numberBetween(1, 100),
            'collect_count' => $this->faker->numberBetween(1, 100),
            'view_count' => $this->faker->numberBetween(1, 1000),
            'excerpt' => make_excerpt($body),
            'order' => $this->faker->randomNumber(3),
        ];
    }
}
