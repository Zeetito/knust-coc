<?php

namespace Database\Factories;

use App\Models\SemesterProgram;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProgramOutlineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $semesterProgram = SemesterProgram::alL()->random();
        if ($semesterProgram->last_session() == null) {
            $position = 1;
        } else {
            $position = $semesterProgram->last_session()->position;
        }

        return [
            'semester_program_id' => $semesterProgram->id,
            'name' => fake()->firstname(),
            'position' => $position,
            'officiator_id' => User::all()->random()->id,
            'start_time' => fake()->time(),
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
