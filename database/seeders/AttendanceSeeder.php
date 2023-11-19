<?php

namespace Database\Seeders;

use App\Models\Meeting;
use App\Models\Semester;
use App\Models\Attendance;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For Each semester, we create about 18 - 22 attendance sessions
        foreach(Semester::all() as $semester){
            // Foreach semester program, Create an attendance session
            foreach($semester->semester_programs()->get() as $semester_program){
                // Create an attendance session
                $attendance =  new Attendance;
                $attendance['semester_program_id'] = $semester_program->id;
                $attendance['semester_id'] = $semester->id;
                $attendance['is_active'] = 0;
                $attendance->save();

            }
        }

    }
}
