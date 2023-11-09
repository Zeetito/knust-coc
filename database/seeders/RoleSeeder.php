<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Semester;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $roles = [
            ['name' => 'Preacher', 'slug' => 'preacher'],
            ['name' => 'Edification Ministry Member', 'slug' => 'edification_ministry_member'],
            ['name' => 'Evangelism Ministry Member', 'slug' => 'evangelism_ministry_member'],
            ['name' => 'Finance Ministry Member', 'slug' => 'finance_ministry_member'],
            ['name' => 'Organising And Assets Ministry Member', 'slug' => 'organising_ministry_member'],
            ['name' => 'Welfare And Benvolence Ministry Member', 'slug' => 'welfare_ministry_member'],
            ['name' => 'Zonal Rep', 'slug' => 'zone_rep'],
            ['name' => 'Residence Rep', 'slug' => 'residence_rep'],

        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Give Preacher all permissions
        $role = Role::where('slug', 'preacher')->first();
        $role->assignAllPermissions();

        // Assign Preacher Role to this First User
        DB::table('role_users')->insert(
            [
                'user_id' => 1,
                'role_id' => 1,
                'academic_year_id' => Semester::active_semester()->academicYear->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

    }
}
