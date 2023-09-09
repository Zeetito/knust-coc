<?php

namespace Database\Factories;

use App\Models\College;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rand = rand(1,2);
        if ($rand === 1) {
            $type ="ug";
        }else{
            $type ="pg";
        }
        return [
            //
            "name" => fake()->name(),
            "college_id" => College::all()->random()->id,
            "type" => $type,
            "span" => rand(1,6),
        ];
    }
}
