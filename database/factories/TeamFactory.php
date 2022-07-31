<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['name' => 'string', 'user_id' => 'mixed', 'personal_team' => 'bool'])]
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'user_id' => $this->faker->numberBetween(1, 100),
            'personal_team' => true,
        ];
    }
}
