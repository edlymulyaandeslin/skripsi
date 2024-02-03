<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NilaiSempro>
 */
class NilaiSemproFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sempro_id' => 1,
            'nilai1' => fake()->numberBetween(0, 25),
            'nilai2' => fake()->numberBetween(0, 15),
            'nilai3' => fake()->numberBetween(0, 10),
            'nilai4' => fake()->numberBetween(0, 25),
            'nilai5' => fake()->numberBetween(0, 25),
        ];
    }
}
