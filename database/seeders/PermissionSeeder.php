<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

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
            ['name' => 'Activate User Account', 'slug' => 'activate_account'],
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
            // Reps
            ['name' => 'Assign Zonal Rep', 'slug' => 'assign_zonal_rep'],
            ['name' => 'Change Zonal Rep', 'slug' => 'change_zonal_rep'],
            ['name' => 'Remove Zonal Rep', 'slug' => 'remove_zonal_rep'],

            // RESIDENCE
            ['name' => 'Add Residence', 'slug' => 'add_residence'],
            ['name' => 'Update Residence', 'slug' => 'update_residence'],
            ['name' => 'Delete Residence', 'slug' => 'delete_residence'],
            // Reps
            ['name' => 'Assign Residence Rep', 'slug' => 'assign_residence_rep'],
            ['name' => 'Change Residence Rep', 'slug' => 'change_residence_rep'],
            ['name' => 'Remove Residence Rep', 'slug' => 'remove_residence_rep'],

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
            ['name' => 'Print Absentees', 'slug' => 'print_absentees'],

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

            // GUESTS
            ['name' => 'Add Guest', 'slug' => 'add_guest'],
            ['name' => 'Update Guest', 'slug' => 'update_guest'],
            ['name' => 'Remove Guest', 'slug' => 'remove_guest'],

            // SEMESTER PROGRAMS
            ['name' => 'Add Semester Program', 'slug' => 'add_semester_program'],
            ['name' => 'Update Semester Program', 'slug' => 'update_semester_program'],
            ['name' => 'Delete Semester Program', 'slug' => 'delete_semester_program'],

            // OFFICIATORS
            ['name' => 'Add Officiator', 'slug' => 'add_officiator'],
            ['name' => 'Update Officiator', 'slug' => 'update_officiator'],
            ['name' => 'Delete Officiator', 'slug' => 'delete_officiator'],

            // PROGRAM OUTLINE
            ['name' => 'Add Program Outline', 'slug' => 'add_program_outline'],
            ['name' => 'Update Program Outline', 'slug' => 'update_program_outline'],
            ['name' => 'Delete Program Outline', 'slug' => 'delete_program_outline'],
            
            // DOOR TO DOOR


            // FISHING OUT
            ['name' => 'Access Fishing Out', 'slug' => 'access_fishing_out'],
            ['name' => 'Create Fishing Out', 'slug' => 'create_fishing_out'],
            ['name' => 'Update Fishing Out', 'slug' => 'update_fishing_out'],
            ['name' => 'Delete Fishing Out', 'slug' => 'delete_fishing_out'],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
