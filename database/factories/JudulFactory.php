<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Judul>
 */
class JudulFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mahasiswa_id' => mt_rand(1, 10),
            'judul' => fake()->jobTitle(),
            'latar_belakang' => fake()->paragraph(4),
            'pembimbing1_id' => 0,
            'pembimbing2_id' => 0,
        ];
    }
}
