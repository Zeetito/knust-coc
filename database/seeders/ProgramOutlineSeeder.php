<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SemesterProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Factories\ProgramOutlineFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramOutlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach(SemesterProgram::all() as $semesterProgram) {


            // use a forLoop to populate the outline sessions
            for ($i=1; $i<=mt_rand(6, 15); $i++){
                DB::table('program_outlines')->insert([
                'semester_program_id' => $semesterProgram->id,
                'name'=>fake()->firstname(),
                'position' => $i,
                'officiator_id' => $semesterProgram->user_officiators()->get()->random()->officiator_id,
                'start_time' => fake()->time(),
                'created_at'=>now(),
                'updated_at'=>now(),
                ]);
            }

        }       

    }
}
