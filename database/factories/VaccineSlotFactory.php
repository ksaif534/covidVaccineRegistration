<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VaccineSlot>
 */
class VaccineSlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'           => fake()->unique()->numberBetween(1, 50),
            'vaccine_center_id' => fake()->numberBetween(1, 20),
            'vaccination_date'  => null
        ];
    }
}
