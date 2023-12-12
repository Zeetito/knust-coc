<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'tito',
            'firstname' => 'Ernest',
            'lastname' => 'Agyare',
            'othername' => 'Victor',
            'gender' => 'm',
            'is_activated' => 1,
            'is_student' => 1,
            'is_member' => 1,
            'is_available' => 1,
            'is_baptized' => 1,
            'email' => 'tito44@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('passkmsssap'), // password
            'remember_token' => Str::random(10),
        ]);
        // User::factory(500)->create();
        

    }
}
