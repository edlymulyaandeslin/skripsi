<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sempro>
 */
class SemproFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul_id' => fake()->uuid(),
            'tanggal_seminar' => fake()->date(),
            'jam' => fake()->time(),
            'ruang' => fake()->locale(),
            'status' => 'diterima'
        ];
    }
}
