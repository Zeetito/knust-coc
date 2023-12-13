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
        $this->call(YearGroupSeeder::class);
        $this->call(AcademicYearSeeder::class);
        $this->call(SemesterSeeder::class);

        $this->call(InactiveAccountsSeeder::class);
        $this->call(UnavailableMembersSeeder::class);

        $this->call(ZoneSeeder::class);
        $this->call(ResidenceSeeder::class);
        $this->call(CollegeSeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ProgramSeeder::class);

        $this->call(BiodataSeeder::class);
        // $this->call(ContactSeeder::class);
        $this->call(MeetingSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);

        $this->call(AccessorySeeder::class);

        $this->call(OfficiatingRolesSeeder::class);
        $this->call(SemesterProgramSeeder::class);
        $this->call(ProgramOfficiatorsSeeder::class);
        $this->call(ProgramOutlineSeeder::class);

        $this->call(AttendanceSeeder::class);
        $this->call(AttendanceUserSeeder::class);

        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
