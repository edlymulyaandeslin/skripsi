<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bobot>
 */
class BobotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bobot1' => 1,
            'bobot2' => 2,
            'bobot3' => 1,
            'bobot4' => 1,
        ];
    }
}
