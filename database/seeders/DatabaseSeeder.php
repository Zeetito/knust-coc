<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ZoneSeeder::class);
        $this->call(ResidenceSeeder::class);
        $this->call(CollegeSeeder::class);
        $this->call(ProgramSeeder::class);

        $this->call(BiodataSeeder::class);
        $this->call(OthernameSeeder::class);
        $this->call(ContactSeeder::class);

        $this->call(MeetingSeeder::class);
        $this->call(AttendanceSeeder::class);
        $this->call(AttendanceUserSeeder::class);
        $this->call(AcademicYearSeeder::class);
        $this->call(SemesterSeeder::class);

        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
