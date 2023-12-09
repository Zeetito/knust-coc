<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnavailableMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::unavailable_members()->get() as $user) {
            $rand = array_rand(['sick', 'travelled', 'not_yet_in']);
            DB::table('unavailable_members')->insert([
                'user_id' => $user->id,
                // 'category' => fake()->randomElement(['sick', 'travelled', 'not_yet_in']),
                'category' => $rand == 0 ? "sick" : ($rand == 1 ? "travelled":"not_yet_in"),
                // 'info' => fake()->sentence(),
                'info' => "Nothing",
                'recorded_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
