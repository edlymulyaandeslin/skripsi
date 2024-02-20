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
            'mahasiswa_id' => fake()->uuid(),
            'judul' => fake()->jobTitle(),
            'latar_belakang' => fake()->paragraph(4),
            'pembimbing1_id' => fake()->uuid(),
            'pembimbing2_id' => fake()->uuid(),
            'status' => 'diterima',
        ];
    }
}
