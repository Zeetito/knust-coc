<?php

namespace Database\Factories;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Residence>
 */
class ResidenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->streetName(),
            'zone_id' => Zone::all()->random()->id,
            'description' => fake()->sentence(),
            'landmark' => fake()->sentence(),
            'rep_id' => null,
        ];
    }
}
