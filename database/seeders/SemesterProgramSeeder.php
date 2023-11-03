<?php

namespace Database\Seeders;

use App\Models\SemesterProgram;
use Illuminate\Database\Seeder;

class SemesterProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SemesterProgram::factory(60)->create();
    }
}
