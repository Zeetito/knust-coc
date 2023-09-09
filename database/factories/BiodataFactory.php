<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Zone;
use App\Models\College;
use App\Models\Program;
use App\Models\Residence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Biodata>
 */
class BiodataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uniqueUserIds = User::all()->pluck('id')->shuffle();
        return [
            
            //
            'user_id' => $uniqueUserIds->pop(),
            'year' => rand(1,8),
            'zone_id' => Zone::all()->random()->id,
            'residence_id' => Residence::all()->random()->id,
            'room' => fake()->buildingNumber(),
            'college_id' => College::all()->random()->id,
            'program_id' => Program::all()->random()->id,

        ];
    }
}
