<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NilaiKompre>
 */
class NilaiKompreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kompre_id' => fake()->uuid(),
            'nilai1_pem1' => fake()->numberBetween(0, 15),
            'nilai2_pem1' => fake()->numberBetween(0, 15),
            'nilai3_pem1' => fake()->numberBetween(0, 10),
            'nilai4_pem1' => fake()->numberBetween(0, 10),
            'nilai5_pem1' => fake()->numberBetween(0, 10),
            'nilai6_pem1' => fake()->numberBetween(0, 20),
            'nilai7_pem1' => fake()->numberBetween(0, 20),
            'nilai1_pem2' => fake()->numberBetween(0, 15),
            'nilai2_pem2' => fake()->numberBetween(0, 15),
            'nilai3_pem2' => fake()->numberBetween(0, 10),
            'nilai4_pem2' => fake()->numberBetween(0, 10),
            'nilai5_pem2' => fake()->numberBetween(0, 10),
            'nilai6_pem2' => fake()->numberBetween(0, 20),
            'nilai7_pem2' => fake()->numberBetween(0, 20),
            'nilai1_peng1' => fake()->numberBetween(0, 25),
            'nilai2_peng1' => fake()->numberBetween(0, 15),
            'nilai3_peng1' => fake()->numberBetween(0, 10),
            'nilai4_peng1' => fake()->numberBetween(0, 25),
            'nilai5_peng1' => fake()->numberBetween(0, 25),
            'nilai1_peng2' => fake()->numberBetween(0, 25),
            'nilai2_peng2' => fake()->numberBetween(0, 15),
            'nilai3_peng2' => fake()->numberBetween(0, 10),
            'nilai4_peng2' => fake()->numberBetween(0, 25),
            'nilai5_peng2' => fake()->numberBetween(0, 25),
            'nilai1_peng3' => fake()->numberBetween(0, 25),
            'nilai2_peng3' => fake()->numberBetween(0, 15),
            'nilai3_peng3' => fake()->numberBetween(0, 10),
            'nilai4_peng3' => fake()->numberBetween(0, 25),
            'nilai5_peng3' => fake()->numberBetween(0, 25),
        ];
    }
}
