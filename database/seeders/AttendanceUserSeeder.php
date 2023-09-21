<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendanceUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($count=1; $count<=Attendance::all()->count(); $count++){

            for($i=1; $i<=mt_rand(100,350); $i++){

                DB::table('attendance_users')->insert(
                    [
                        'attendance_id' =>Attendance::all()->random()->id,
                        'user_id' =>User::all()->random()->id,
                        'checked_by' =>User::all()->random()->id,
                    ]
                );
            }
            $count++; // You're already incrementing $count on #18
        }

    }
}
