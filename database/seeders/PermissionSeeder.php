<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            // USER
            ['name' => 'Activate User Account' , 'slug' => 'activate_account'],
            ['name' => 'Update User', 'slug' => 'update_user'],
            ['name' => 'Delete User', 'slug' => 'delete_user'],
            ['name' => 'Grant User Request', 'slug' => 'grant_request'],

            // COLLEGE
            ['name' => 'Add College', 'slug' => 'add_college'],
            ['name' => 'Update College', 'slug' => 'update_college'],
            ['name' => 'Delete College', 'slug' => 'delete_college'],

            // PROGRAM
            ['name' => 'Add Program', 'slug' => 'add_program'],
            ['name' => 'Update Program', 'slug' => 'update_program'],
            ['name' => 'Delete Program', 'slug' => 'delete_program'],

            // ZONE
            ['name' => 'Add Zone', 'slug' => 'add_zone'],
            ['name' => 'Update Zone', 'slug' => 'update_zone'],
            ['name' => 'Delete Zone', 'slug' => 'delete_zone'],

            // RESIDENCE
            ['name' => 'Add Residence', 'slug' => 'add_residence'],
            ['name' => 'Update Residence', 'slug' => 'update_residence'],
            ['name' => 'Delete Residence', 'slug' => 'delete_residence'],

            // ACADEMIC YEAR
            ['name' => 'Add Academic Year', 'slug' => 'add_academic_year'],
            ['name' => 'Update Academic Year', 'slug' => 'update_academic_year'],
            ['name' => 'Delete Academic Year', 'slug' => 'delete_academic_year'],

            // SEMESTER
            ['name' => 'Add Semester', 'slug' => 'add_semester'],
            ['name' => 'Update Semester', 'slug' => 'update_semester'],
            ['name' => 'Delete Semester', 'slug' => 'delete_semester'],

            // ATTENDANCE
            ['name' => 'View Attendance Session', 'slug' => 'view_attendance'],
            ['name' => 'Create Attendance Session', 'slug' => 'create_attendance'],
            ['name' => 'Update Attendance Session', 'slug' => 'update_attendance'],
            ['name' => 'Reset Attendance Session', 'slug' => 'reset_attendance'],
            ['name' => 'Delete Attendance Session', 'slug' => 'delete_attendance'],
            ['name' => 'Check User', 'slug' => 'check_user'],

            //ROLE
            ['name' => 'Create Role', 'slug' => 'create_role'],
            ['name' => 'Assign Role', 'slug' => 'assign_role'],
            ['name' => 'Update Role', 'slug' => 'update_role'],
            ['name' => 'Remove Role', 'slug' => 'remove_role'],

            //PERMISSION
            ['name' => 'Create Permission', 'slug' => 'create_permission'],
            ['name' => 'Assign Permission', 'slug' => 'assign_permission'],
            ['name' => 'Update Permission', 'slug' => 'update_permission'],
            ['name' => 'Remove Permission', 'slug' => 'remove_permission'],

           
          
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
