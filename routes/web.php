<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Guest;
use App\Models\Image;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Attendance;
use App\Models\Permission;
use App\Http\Controllers\Admin;
use App\Models\SemesterProgram;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use Diglactic\Breadcrumbs\Breadcrumbs;
use App\Http\Resources\BiodataResource;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProgramOutlineController;
use App\Http\Controllers\SemesterProgramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// -------------------ADMIN PAGES GROUPS ROUTES--------------
Route::prefix('admin')->middleware('auth:sanctum', 'role:ministry_members_level')->group(function () {

    // USER RELATED

    // USER REQUESTS
    // View all user request
    Route::get('user_requests',[Admin\UserRequestController::class, 'show_user_requests'])
        ->name('show_user_requests')
        ;

    // Search User request
    Route::get('search_user_requests',[Admin\UserRequestController::class, 'search_user_requests'])
    ->name('search_user_requests')
    ;
    // Filter User Requests
    Route::get('filter_user_requests', [Admin\UserRequestController::class, 'filter_user_requests'])
        ->name('filter_user_requests');

    // Edit Guest Request - modal 
    Route::get('edit_user_request/{user_request}',[Admin\UserRequestController::class, 'edit_user_request'])
        ->name('edit_user_request')
        ;
    
    // Handle User request - Deny or Grant
    Route::post('handle_user_request/{user_request}',[Admin\UserRequestController::class, 'handle_user_request'])
        ->name('handle_user_request')
        ;


    // GUEST REQUESTS
    // View all guest requests
    Route::get('guest_requests',[Admin\GuestController::class, 'show_guest_requests'])
        ->name('show_guest_requests')
        ;  
    
    // Search Guest request
    Route::get('search_guest_requests',[Admin\GuestController::class, 'search_guest_requests'])
    ->name('search_guest_requests')
    ;

    // Filter Guest Requests
    Route::get('filter_guest_requests', [Admin\GuestController::class, 'filter_guest_requests'])
        ->name('filter_guest_requests')
        ;

    // Edit Guest Request - modal 
    Route::get('edit_guest_request/{guest_request}',[Admin\GuestController::class, 'edit_guest_request'])
        ->name('edit_guest_request')
        ;

    // Handle Guest request - Deny or Grant
    Route::post('handle_guest_request/{guest_request}',[Admin\GuestController::class, 'handle_guest_request'])
        ->name('handle_guest_request')
        ;

        
    // UNAVAILABLE MEMBERS
    // Show All Unavailable Members
    Route::get('unavailable_members', [Admin\UserController::class, 'show_unavailable_members'])
        ->name('show_unavailable_members');

    // Search Unavailable members
    Route::get('search_unavailable_members', [Admin\UserController::class, 'search_unavailable_members'])
        ->name('search_unavailable_members');

    // Filter Unavailable Members
    Route::get('filter_unavailable_members', [Admin\UserController::class, 'filter_unavailable_members'])
        ->name('filter_unavailable_members');

    // Edit Unavailable Members Status - returns Modal
    Route::get('edit_unavailable_members_status/{user}', [Admin\UserController::class, 'edit_unavailable_members_status'])
        ->name('edit_unavailable_members_status');

    // Update Unavailable Members Status
    Route::put('update_unavailable_members_status/{user}', [Admin\UserController::class, 'update_unavailable_members_status'])
        ->name('update_unavailable_members_status');

    // INACTIVE USERS
    // Show All Inactive Accounts
    Route::get('inactive_accounts', [Admin\UserController::class, 'show_inactive_accounts'])
        ->name('show_inactive_accounts');
    // Search Inactive Accounts
    Route::get('search_inactive_accounts', [Admin\UserController::class, 'search_inactive_user'])
        ->name('search_inactive_user');

    // Filter Inactive Accounts
    Route::get('filter_inactive_users', [Admin\UserController::class, 'filter_inactive_users'])
        ->name('filter_inactive_users');

    // Edit Inactive Account Status - returns Modal
    Route::get('edit_inactive_account_status/{user}', [Admin\UserController::class, 'edit_inactive_account_status'])
        ->name('edit_inactive_account_status');

    // Update Inactive Account Status
    Route::put('update_inactive_account_status/{user}', [Admin\UserController::class, 'update_inactive_account_status'])
        ->name('update_inactive_account_status');

    // HOME
    Route::get('home', [Admin\UserController::class, 'home'])
        ->name('admin_home');



});

// ------------------END ADMIN PAGES GROUPS ROUTES------------------


// IMAGES
// Store Image - PolyMorphs
Route::post('/store_image',[ImageController::class,"store"])
    ->middleware('auth')
    ->name('store_image')
    ;


// ---------------
// SEMESTER-PROGRAMS
// View All semester Programs
Route::get('/semester_programs', [SemesterProgramController::class, 'index'])
    ->middleware('auth')
    ->name('semester_programs');

// Create Semester Program
Route::post('/create_semester_program', [SemesterProgramController::class, 'store'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('create_semester_program');

// Filter Semester Programs
Route::get('/filter_semester_programs', [SemesterProgramController::class, 'filter_semester_programs'])
    ->middleware('auth')
    ->name('filter_semester_programs');

// Show A Semester Program
Route::get('/semester_program/{semesterProgram}', [SemesterProgramController::class, 'show'])
    ->middleware('auth')
    ->name('show_semester_program');

// OFFICIATOR
// Add Officiator
Route::get('/add_officiator_form/{semesterProgram}', [SemesterProgramController::class, 'add_officiator_form'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('add_officiator_form');

// Store Officiator Instance
Route::post('/officiator_store/{semesterProgram}', [SemesterProgramController::class, 'store_officiator'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('store_officiator');

// Search User for officiating
Route::get('/search_user_officiator', [SemesterProgramController::class, 'search_user_officiator'])
    ->middleware('auth')
    ->name('search_user_officiator');

// Remove an Officiator Instance
Route::delete('/remove_officiator/{semesterProgram}/{officiator}/{status}/{role}', [SemesterProgramController::class, 'remove_officiator'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('remove_officiator');

// Edit form for officiator
Route::get('/edit_officiator/{semesterProgram}/{officiator}/{status}/{role}', [SemesterProgramController::class, 'edit_officiator'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('edit_officiator');

// Confirm officiator delete
Route::get('/officiator_delete/{semesterProgram}/{officiator}/{status}/{role}/confirm', [SemesterProgramController::class, 'confirm_officiator_delete'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('confirm_officiator_delete');

// Update an officiator Instance?
Route::put('/update_officiator/{semesterProgram}/{officiator}/{status}/{role}', [SemesterProgramController::class, 'update_officiator'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('update_officiator');

// PROGRAM OUTLINE
// Show Program Outline
Route::get('/program_outline/{semesterProgram}/create', [ProgramOutlineController::class, 'create'])
    ->middleware('auth')
    ->name('create_program_outline');

// Save/Store Program Outline / Session
Route::post('/program_outline/{semesterProgram}/store', [ProgramOutlineController::class, 'store'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('store_program_outline');

// Edit Program outline/session
Route::get('/program_outline/{semesterProgram}/{programOutline}/edit', [ProgramOutlineController::class, 'edit'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('edit_program_outline');

// Update Program Outline/Session
Route::put('/program_outline/{semesterProgram}/{programOutline}/update', [ProgramOutlineController::class, 'update'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('update_program_outline');

// Confirm Update Program Outline
Route::get('/confirm_program_outline/{semesterProgram}/{programOutline}/update', [ProgramOutlineController::class, 'confirm_update'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('confirm_program_outline_update');

// Confirm Delete Program Outline
Route::get('/confirm_program_outline/{semesterProgram}/{programOutline}/delete', [ProgramOutlineController::class, 'confirm_delete'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('confirm_program_outline_delete');

// Delete Program Outline
Route::delete('/program_outline/{semesterProgram}/{programOutline}/delete', [ProgramOutlineController::class, 'delete'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('delete_program_outline');
// -------------
// ACADEMIA

// COLLEGES

// View All Colleges
Route::get('/colleges', [CollegeController::class, 'index'])
    ->middleware('auth')
    ->name('colleges');

// Show A single College
Route::get('/colleges/{college}', [CollegeController::class, 'show'])
    ->middleware('auth')
    ->name('show_college');

// Search User in a College On Users table
Route::get('/search_college_user/{college}', [CollegeController::class, 'search_college_user'])
    ->middleware('auth')
    ->name('search_college_user');

// Search Programs in a Faculty On Programs table
Route::get('/search_college_program/{college}', [CollegeController::class, 'search_college_program'])
    ->middleware('auth')
    ->name('search_college_program');

// FACULTIES
// View all faculties
Route::get('/faculties', [FacultyController::class, 'index'])
    ->middleware('auth')
    ->name('faculties');

// Show A single College
Route::get('/faculties/{faculty}', [FacultyController::class, 'show'])
    ->middleware('auth')
    ->name('show_faculty');

// Search User in a Faculty On Users table
Route::get('/search_faculty_user/{faculty}', [FacultyController::class, 'search_faculty_user'])
    ->middleware('auth')
    ->name('search_faculty_user');

// Search Programs in a Faculty On Programs table
Route::get('/search_faculty_program/{faculty}', [FacultyController::class, 'search_faculty_program'])
    ->middleware('auth')
    ->name('search_faculty_program');

// -----------------
// HOUSING

// ZONES

// View all Zones
Route::get('/zones', [ZoneController::class, 'index'])
    ->middleware('auth')
    ->name('zones');

// Show A particular Zone
Route::get('/zone/{zone}', [ZoneController::class, 'show'])
    ->middleware('auth')
    ->name('show_zone');

// RESIDENCES

// ---------------

// ----------------
// ROLES

// View All Roles
Route::get('/roles', [RoleController::class, 'index'])
    ->middleware('auth')
    ->name('roles');

// Edit Role Page
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
    ->middleware('auth')
    ->name('edit_role');

// Add User Roles Instance
Route::get('/create_users_roles/{role}', [RoleController::class, 'create_users_roles'])
    ->middleware('auth')
    ->name('create_users_roles');

// Search User Modal
Route::get('/fetch_role_users_modal/{role}', [RoleController::class, 'fetch_role_users_modal'])
    ->middleware('auth')
    ->name('fetch_role_users_modal');

// Search User among the users who do not have a particular role
Route::get('/search_non_user_roles/{role}', [RoleController::class, 'search_non_user_roles'])
    ->middleware('auth')
    ->name('search_non_user_roles');

// Give a user role
Route::get('/role/{role}/{user}/assign', [RoleController::class, 'give_user_role'])
    ->middleware('auth')
    ->name('give_user_role');

// Remove a user's role
Route::delete('/role/{role}/{user}/remove', [RoleController::class, 'remove_user_role'])
    ->middleware('auth')
    ->name('remove_user_role');
// confirm_role_user_remove
Route::get('/confirm_role_user_remove/{role}/{user}', [RoleController::class, 'confirm_role_user_remove'])
    ->middleware('auth')
    ->name('confirm_role_user_remove');

// Create role premissions form
Route::get('/role/{role}/permissions', [RoleController::class, 'create_roles_permissions'])
    ->middleware('auth')
    ->name('create_roles_permissions');

// Assign permission to role
Route::get('/roles/{role}/{permission}/assign', [RoleController::class, 'assign_role_permission'])
    ->middleware('auth')
    ->name('assign_role_permission');

// Remove a role's permission
Route::delete('/permission/{role}/{permission}/remove', [RoleController::class, 'remove_role_permission'])
    ->middleware('auth')
    ->name('remove_role_permission');

// Confirm A Role removal from permission
Route::get('/confirm_role_permission_remove/{role}/{permission}', [RoleController::class, 'confirm_role_permission_remove'])
    ->middleware('auth')
    ->name('confirm_role_permission_remove');

// Search Role Non-Permissions
Route::get('search_role_non_permissions/{role}', [RoleController::class, 'search_role_non_permissions'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('search_role_non_permissions');
// --------------------------

// ------------------------
// ATTENDANCE

// Index page to view the various attendance sessions
Route::get('/attendance', [AttendanceController::class, 'index'])
    ->middleware('auth')
    ->name('attendance');

// Show Attendance Session. See who's marked or not
Route::get('/attendance_users/{attendance}', [AttendanceController::class, 'show_attendance_users'])
    ->middleware('auth', 'role:residence_reps_level')
    ->name('show_attendance_users');

// Create New Attendance Session
Route::post('/attendance', [AttendanceController::class, 'store'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('create_attendance');

// Reset Attendance Session
Route::post('/attendance/{attendance}/reset', [AttendanceController::class, 'reset_attendance'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('reset_attendance');

// Confrim Attendance Reset
Route::get('/confirm_attendance_reset/{attendance}', [AttendanceController::class, 'confirm_attendance_reset'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('confirm_attendance_reset');

// Confrim Attendance Session Delete
Route::get('/confirm_attendance_delete/{attendance}', [AttendanceController::class, 'confirm_attendance_delete'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('confirm_attendance_delete');

// Delete Attendance Session
Route::delete('/attendance/{attendance}/delete', [AttendanceController::class, 'delete_attendance'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('delete_attendance');

// Access Attendance session to mark
Route::get('/attendance/{attendance}/access', [AttendanceController::class, 'access_attendance_session'])
    ->middleware('auth')
    ->name('access_attendance_session');

// Confirm Attendance Toogle/switch
Route::get('/confirm_attendance_switch/{attendance}', [AttendanceController::class, 'confirm_attendance_switch'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('confirm_attendance_switch');

// Switch Attendance Session
Route::post('/attendance/{attendance}/switch', [AttendanceController::class, 'switch_attendance_session'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('switch_attendance_session');

// Check
Route::get('/attendance/{attendance}/{user}', [AttendanceController::class, 'check_user'])
    ->middleware('auth')
    ->name('check_user');

// Uncheck User
Route::delete('/uncheck_user/{attendance}/{user}', [AttendanceController::class, 'uncheck_user'])
    ->middleware('auth')
    ->name('uncheck_user');

// Uncheck Guest
Route::delete('/uncheck_guest/{attendance}/{guest}', [AttendanceController::class, 'uncheck_guest'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('uncheck_guest');

// Confrim Uncheck Guest
Route::get('/confirm_guest/{attendance}/{guest}', [AttendanceController::class, 'confirm_uncheck_guest'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('confirm_uncheck_guest');

// Confirmation for uncheck user
Route::get('/confirm_user/{attendance}/{user}', [AttendanceController::class, 'confirm_uncheck_user'])
    ->middleware('auth')
    ->name('confirm_uncheck_user');

// Search Attendance Session
Route::get('/search_attendance', [AttendanceController::class, 'search_attendance'])
    ->middleware('auth')
    ->name('search_attendance');

// Search User who's been checked for a particular attendance
Route::get('/search_attendance_checked_users/{attendance}', [AttendanceController::class, 'search_attendance_checked_users'])
    ->middleware('auth')
    ->name('search_attendance_checked_users');

// Search User on Attendance table
Route::get('/search_attendance_users/{attendance}', [AttendanceController::class, 'search_attendance_users'])
    ->middleware('auth')
    ->name('search_attendance_users');

// Register User Visitor
Route::post('/register_user_visitor/{attendance}', [AttendanceController::class, 'register_user_visitor'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('register_user_visitor');

// Register Guest Visitor
Route::post('/register_guest_visitor/{attendance}', [AttendanceController::class, 'register_guest_visitor'])
    ->middleware('auth', 'role:ministry_members_level')
    ->name('register_guest_visitor');
// ------------------------------

// --------------------------------
// ACCOUNT

// Guest Register
Route::get('/register', function () {
    return view('account.register');
})
    ->name('register')
    ->middleware('guest');

// Guest store
Route::Post('/register', [UserController::class, 'store'])
    ->middleware('guest')
    ->name('register_user');

// Guest/ Fresher register page
Route::get('/register_fresher',[UserController::class, 'create_fresher'])
    ->middleware('guest')
    ->name('create_fresher')
    ;

// Guest/ Fresher Login page
Route::get('/login_page_fresher',[UserController::class, 'login_page_fresher'])
    ->middleware('guest')
    ->name('login_page_fresher')
    ;

// STUDENT
// Student Register
Route::get('/register_student',[UserController::class, 'register_student'])
    ->middleware('guest')
    ->name('register_student')
    ;

// User Login
Route::get('/login', function () {
    return view('account.login');
})
    ->middleware('guest')
    ->name('login');

// User Login Action
Route::Post('/login', [UserController::class, 'login'])
    ->middleware('guest')
    ->name('log_user_in');

// User Logout Action
Route::get('/logout', [UserController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/', function () {
    // $breadcrumbs = Breadcrumbs::render('home');

    return view('homepage');
})
    ->middleware('auth')
    ->name('home');

//  PROFILE / BIODATA

// Search residences
Route::get('/profile_search_residences', [BiodataController::class, 'profile_search_residences'])
    ->middleware('auth')
    ->name('profile_search_residences');
// Search Programs
Route::get('/profile_search_programs', [BiodataController::class, 'profile_search_programs'])
    ->middleware('auth')
    ->name('profile_search_programs');

// Show User Profile
Route::get('/profile/{user}', [BiodataController::class, 'show'])
    ->middleware('auth')
    ->name('view_profile');

// create User Profile form
Route::get('/profile/{user}/new', [BiodataController::class, 'create'])
    ->middleware('auth')
    ->name('create_user_profile_form');

// /store user profile
Route::post('/profile/{user}/create', [BiodataController::class, 'store'])
    ->middleware('auth')
    ->name('create_profile');

// edit user profile
Route::get('/profile/{user}/edit', [BiodataController::class, 'edit'])
    ->middleware('auth', 'can:update,user')
    ->name('edit_user_profile_form');

// Update User profile
Route::put('/profile/{user}/update', [BiodataController::class, 'update'])
    ->middleware('auth', 'can:update,user')
    ->name('update_profile');

// IMAGES
// Create User Image Form
Route::get('/upload_user_image/{user}',[UserController::class,'upload_user_image'])
    ->middleware('auth')
    ->name('upload_user_image');
;

// USER AVATAR

// View avatar change form
Route::get('/avatar/{user}', [UserController::class, 'edit_avatar'])
    ->middleware('auth')
    ->name('edit_avatar_form');
// Update Avatar action
Route::post('/avatar/{user}', [UserController::class, 'store_avatar'])
    ->middleware('auth')
    ->name('update_avatar', 'can:update,user');

// Reset User Avatar
Route::get('/avatar/{user}/reset', [UserController::class, 'reset_avatar'])
    ->middleware('auth')
    ->name('reset_avatar');

// VIEWS
Route::get('/users', [UserController::class, 'view_users'])
    ->middleware('auth')
    ->name('view_users');

// -------------------------------------------------

// MODAL VIEWS

// modal view user profile info
Route::get('/info/{user}', [BiodataController::class, 'show_modal_info'])
    ->middleware('auth')
    ->name('show_modal_info');

// Search User on Users table
Route::get('/search_user', [UserController::class, 'search_user'])
    ->middleware('auth')
    ->name('search_user');

Route::get('/hello', function () {
    // DB::table('alumini_biodatas')->where('academic_year_id',2)
    //     ->update(['created_at'=>'2022-09-08', 'updated_at'=>'2023-09-08']);
    //     return "heat";
    // return User::find(1)->biodata();
    return User::find(1)->photos;
    return Image::find(1)->imageable;

    return new BiodataResource(User::find(1)->biodata());
    return Semester::active_semester()->semester_programs;
    return Semester::findByDate('2023-12-31');
    return Semester::find(3)->semester_programs();

    return now()->diffInHours('2023-09-08');

    return strtotime('last week').'<br>';

    return date_diff(User::find(4)->created_at, now());

    return User::get_all_inactive_accounts();

    return SemesterProgram::find(15)->user_officiators()->get()->random()->officiator_id;

    return DB::table('officiating_roles')->get()->random();

    return fake()->firstname();

    $minDate = '2022-01-20'; // Set your desired minimum date
    $maxDate = '2023-12-31'; // Set your desired maximum date

    return fake()->dateTimeBetween($minDate, $maxDate)->format('Y-m-d');
})->middleware('auth');
