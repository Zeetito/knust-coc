<?php

namespace Database\Seeders;

use App\Models\SemesterProgram;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramOfficiatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach (SemesterProgram::all() as $semesterProgram) {

            for ($i = 1; $i <= mt_rand(10, 18); $i++) {

                DB::table('officiators_programs')->insert([
                    'semester_program_id' => $semesterProgram->id,
                    'officiating_role_id' => DB::table('officiating_roles')->get()->random()->id,
                    'officiator_id' => User::all()->random()->id,
                    'is_user' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }

        }
    }
}
