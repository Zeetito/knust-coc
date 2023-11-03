<?php

namespace Database\Seeders;

use App\Models\Biodata;
use App\Models\Program;
use App\Models\Residence;
use App\Models\User;
use App\Models\YearGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Biodata::factory(501)->create();

        foreach (User::all() as $user) {

            // Check if user is a student member
            if ($user->is_member == 1 && $user->is_student == 1) {

                $program = Program::all()->random();
                $college = $program->college;

                $residence = Residence::all()->random();
                $zone = $residence->zone;
                DB::table('members_biodatas')->insert([
                    'user_id' => $user->id,
                    'year' => rand(1, 4),
                    'program_id' => $program->id,
                    'college_id' => $college->id,
                    'residence_id' => $residence->id,
                    'zone_id' => $zone->id,
                    'room' => rand(1, 500),

                ]);
            } elseif ($user->is_member == 1 && $user->is_student == 0) {
                // Check if user is a non-student member
                $residence = Residence::all()->random();
                $zone = $residence->zone;

                // A condition for alumin and year_group
                $is_alumini = rand(0, 1);
                if ($is_alumini == 1) {
                    $year_group_id = YearGroup::all()->random()->id;
                } else {
                    $year_group_id = null;
                }

                DB::table('members_biodatas')->insert([
                    'user_id' => $user->id,

                    'residence_id' => $residence->id,
                    'zone_id' => $zone->id,
                    'room' => rand(1, 500),

                    'ns_status' => rand(0, 1),
                    'is_alumini' => $is_alumini,
                    'year_group_id' => $year_group_id,
                ]);

            } elseif ($user->member == 0 && $user->is_student == 0) {
                // If User is Alumini
                DB::table('alumini_biodatas')->insert([
                    'user_id' => $user->id,
                    'year_group_id' => YearGroup::all()->random()->id,
                    'country' => fake()->country(),
                    'city' => fake()->city(),
                    'state' => fake()->state(),
                    'local_congregation' => fake()->city().' Church of Christ',
                ]);

            }

        }

    }
}
