<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InactiveAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach (User::inactive_accounts()->get() as $user) {
            DB::table('inactive_accounts')->insert([
                'user_id' => $user->id,
                'reason' => fake()->randomElement(['suspended', 'fresher', 'new_account']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
