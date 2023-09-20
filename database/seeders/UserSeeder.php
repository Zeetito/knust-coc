<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        User::create([
            'username' => 'tito',
            'firstname'=>'Ernest',
            'lastname'=>'Agyare',
            'gender'=>'m',
            'is_activated'=>1,
            'is_student'=> 1,
            'is_with_us'=> 1,
            'email' => 'tito44@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ]);
        User::factory(50)->create();

    }
}
