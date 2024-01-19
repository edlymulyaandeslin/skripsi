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
            'judul' => fake()->title(),
            'latar_belakang' => fake()->paragraph(4),
            'team_pembimbing_id' => mt_rand(1, 10),
        ];
    }
}
