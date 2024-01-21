<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kompre>
 */
class KompreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul_id' => mt_rand(1, 5),
            'tanggal_seminar' => fake()->date(),
            'jam' => fake()->time(),
            'ruang' => fake()->locale(),
            'team_penguji_id' => mt_rand(1, 5)
        ];
    }
}
