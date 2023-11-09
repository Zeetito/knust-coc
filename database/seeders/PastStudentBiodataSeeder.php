<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PastStudentBiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //This is for Students who are in at least 2nd year. To seed fake history for them.

        foreach (User::where('is_student', 1)->get() as $student) {
            if ($student->biodata() != null) {
                $year = $student->year();
                for ($i = $year - 1; $i < $year; $i++) {
                    $zone = Zone::where('id', '<', 17)->get()->random();
                    DB::table('members_biodatas')->insert([
                        'user_id' => $student->id,
                        'year' => ($year - 1),
                        'program_id' => $student->program()->id,
                        'college_id' => $student->college()->id,
                        'zone_id' => $zone->id,
                        'residence_id' => $zone->residences->random()->id,
                        'room' => rand(1, 500),
                        'academic_year_id' => 1,
                    ]);
                }

            }

        }

    }
}
