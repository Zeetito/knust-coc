<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($count = 1; $count <= Attendance::all()->count(); $count++) {

            for ($i = 1; $i <= mt_rand(100, 350); $i++) {

                DB::table('attendance_users')->insert(
                    [
                        'attendance_id' => Attendance::all()->random()->id,
                        'person_id' => User::all()->random()->id,
                        'checked_by' => User::all()->random()->id,
                        'is_user' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
            // $count++; // You're already incrementing $count on #18
        }

    }
}
