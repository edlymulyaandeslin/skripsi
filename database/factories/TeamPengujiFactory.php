<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamPenguji>
 */
class TeamPengujiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'penguji1_id' => mt_rand(1, 10),
            'penguji2_id' => mt_rand(1, 10),
            'penguji3_id' => mt_rand(1, 10),
            'penguji4_id' => mt_rand(1, 10),
            'penguji5_id' => mt_rand(1, 10),
        ];
    }
}
