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
            'nilai1' => fake()->numberBetween(1, 100),
            'nilai2' => fake()->numberBetween(1, 100),
            'nilai3' => fake()->numberBetween(1, 100),
            'nilai4' => fake()->numberBetween(1, 100),
            'nilai5' => fake()->numberBetween(1, 100),
        ];
    }
}
