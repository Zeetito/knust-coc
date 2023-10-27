<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Helper;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Meeting;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Residence;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Permission;
use App\Models\AcademicYear;
use App\Models\SemesterProgram;

use Illuminate\Support\Facades\Route;
use Diglactic\Breadcrumbs\Breadcrumbs;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
use App\Http\Resources\AttendanceResource;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\AttendanceController;
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


// ---------------
// SEMESTER-PROGRAMS
// View All semester Programs
Route::get('/semester_programs',[SemesterProgramController::class,'index'])
->middleware('auth')
->name('semester_programs')
;

// Create Semester Program
Route::post('/create_semester_program',[SemesterProgramController::class,'store'])
->middleware('auth')
->name('create_semester_program')
;

// Filter Semester Programs
Route::get('/filter_semester_programs',[SemesterProgramController::class,'filter_semester_programs'])
->middleware('auth')
->name('filter_semester_programs')
;

// Show A Semester Program
Route::get('/semester_program/{semesterProgram}',[SemesterProgramController::class,'show'])
->middleware('auth')
->name('show_semester_program')
;

// Add Officiator
Route::get('/add_officiator_form/{semesterProgram}',[SemesterProgramController::class,'add_officiator_form'])
->middleware('auth')
->name('add_officiator_form')
;

// Store Officiator Instance
Route::post('/officiator_store/{semesterProgram}',[SemesterProgramController::class,'store_officiator'])
->middleware('auth')
->name('store_officiator')
;

// Search User for officiating
Route::get('/search_user_officiator',[SemesterProgramController::class,'search_user_officiator'])
->middleware('auth')
->name('search_user_officiator')
;

// Confirm Remove Officiator


// Remove an Officiator Instance
Route::delete('/remove_officiator/{semesterProgram}/{officiator}/{status}/{role}',[SemesterProgramController::class,"remove_officiator"])
->middleware('auth')
->name('remove_officiator')
;

// Edit form for officiator
Route::get('/edit_officiator/{semesterProgram}/{officiator}/{status}/{role}',[SemesterProgramController::class,"edit_officiator"])
->middleware('auth')
->name('edit_officiator')
;

// Confirm officiator delete
Route::get('/officiator_delete/{semesterProgram}/{officiator}/{status}/{role}/confirm',[SemesterProgramController::class,"confirm_officiator_delete"])
->middleware('auth')
->name('confirm_officiator_delete')
;

// Update an officiator Instance?
Route::put('/update_officiator/{semesterProgram}/{officiator}/{status}/{role}',[SemesterProgramController::class,"update_officiator"])
->middleware('auth')
->name('update_officiator')
;


// -------------
// ACADEMIA

// COLLEGES

// View All Colleges
Route::get('/colleges',[CollegeController::class,'index'])
->middleware('auth')
->name('colleges')
;

// Show A single College
Route::get('/colleges/{college}',[CollegeController::class,'show'])
->middleware('auth')
->name('show_college')
;

// Search User in a College On Users table
Route::get('/search_college_user/{college}',[CollegeController::class,"search_college_user"])
->middleware('auth')
->name('search_college_user')
;

// Search Programs in a Faculty On Programs table
Route::get('/search_college_program/{college}',[CollegeController::class,"search_college_program"])
->middleware('auth')
->name('search_college_program')
;


// FACULTIES
// View all faculties
Route::get('/faculties',[FacultyController::class,'index'])
->middleware('auth')
->name('faculties')
;

// Show A single College
Route::get('/faculties/{faculty}',[FacultyController::class,'show'])
->middleware('auth')
->name('show_faculty')
;


// Search User in a Faculty On Users table
Route::get('/search_faculty_user/{faculty}',[FacultyController::class,"search_faculty_user"])
->middleware('auth')
->name('search_faculty_user')
;

// Search Programs in a Faculty On Programs table
Route::get('/search_faculty_program/{faculty}',[FacultyController::class,"search_faculty_program"])
->middleware('auth')
->name('search_faculty_program')
;



// -----------------
// HOUSING
// ZONES

// View all Zones
Route::get('/zones',[ZoneController::class,'index'])
->middleware('auth')
->name('zones')
;


// ---------------

// ROLES

// View All Roles 
Route::get('/roles',[RoleController::class,"index"])
->middleware('auth')
->name('roles')
;

// Edit Role Page
Route::get('/roles/{role}/edit',[RoleController::class,"edit"])
->middleware('auth')
->name('edit_role')
;

// Add User Roles Instance
Route::get('/create_users_roles/{role}',[RoleController::class,"create_users_roles"])
->middleware('auth')
->name("create_users_roles")
;

// Fetch Role Permissions
// Route::get('/roles/{role}/permissions',[RoleController::class,"fetch_role_permissions"])
// ->middleware('auth')
// ->name('fetch_role_permissions')
// ;

// Search User Modal
Route::get('/fetch_role_users_modal/{role}',[RoleController::class, "fetch_role_users_modal"])
->middleware('auth')
->name('fetch_role_users_modal')
;

// Search User among the users who do not have a particular role
Route::get('/search_non_user_roles/{role}',[RoleController::class, "search_non_user_roles"])
->middleware('auth')
->name('search_non_user_roles')
;

// Give a user role
Route::get('/role/{role}/{user}/assign',[RoleController::class,"give_user_role"])
->middleware('auth')
->name('give_user_role')
;

// Remove a user's role
Route::get('/role/{role}/{user}/remove',[RoleController::class,"remove_user_role"])
->middleware('auth')
->name('remove_user_role')
;

Route::get('/role/{role}/permissions',[RoleController::class,"create_roles_permissions"])
->middleware('auth')
->name('create_roles_permissions')
;

Route::get('/roles/{role}/{permission}/assign',[RoleController::class,"assign_role_permission"])
->middleware('auth')
->name('assign_role_permission')
;

// Remove a role's permission
Route::get('/permission/{role}/{permission}/remove',[RoleController::class,"remove_role_permission"])
->middleware('auth')
->name('remove_role_permission')
;


// ATTENDANCE

// Index page to view the various attendance sessions
Route::get('/attendance',[AttendanceController::class,"index"])
->middleware('auth')
->name('attendance')
;

// View Attendance Session. See who's marked or not
Route::get('/attendance_users/{attendance}',[AttendanceController::class,"show_attendance_users"])
->middleware('auth')
->name('show_attendance_users')
;

// Create New Attendance Session
Route::post('/attendance',[AttendanceController::class,"store"])
->middleware('auth')
->name('create_attendance')
;

// Reset Attendance Session
Route::get("/attendance/{attendance}/reset",[AttendanceController::class,"reset_attendance"])
->middleware("auth")
->name("reset_attendance")
;


// Access Attendance session to mark 
Route::get('/attendance/{attendance}/access',[AttendanceController::class,"access_attendance_session"])
->middleware('auth')
->name('access_attendance_session')
;

// Switch Attendance Session
Route::get('/attendance/{attendance}/switch',[AttendanceController::class,"switch_attendance_session"])
->middleware('auth')
->name('switch_attendance_session')
;

// Check Or Uncheck User
Route::get('/attendance/{attendance}/{user}',[AttendanceController::class,"check_user"])
->middleware('auth')
->name('check_user')
;

// Confirmation for uncheck user
Route::get('/attendance/{attendance}/{user}/confirm',[AttendanceController::class,"confirm_uncheck_user"])
->middleware('auth')
->name("confirm_uncheck_user")
;

// Search Attendance Session
Route::get("/search_attendance",[AttendanceController::class, "search_attendance"])
->middleware("auth")
->name("search_attendance")
;

// Search User who's been checked for a particular attendance
Route::get("/search_attendance_checked_users/{attendance}",[AttendanceController::class, "search_attendance_checked_users"])
->middleware("auth")
->name("search_attendance_checked_users")
;

// Search User on Attendance table
Route::get('/search_attendance_users/{attendance}',[AttendanceController::class,"search_attendance_users"])
->middleware('auth')
->name('search_attendance_users')
;

// Register User Visitor
Route::post('/register_user_visitor/{attendance}',[AttendanceController::class,"register_user_visitor"])
->middleware('auth')
->name("register_user_visitor")
;

// Register Guest Visitor
Route::post('/register_guest_visitor/{attendance}',[AttendanceController::class,"register_guest_visitor"])
->middleware('auth')
->name("register_guest_visitor")
;


// ACCOUNT

// Guest Register
Route::get('/register', function(){
    return view('account.register');
})
->name('register')
->middleware('guest');

// Guest Register Action
Route::Post('/register',[UserController::class,"register"])
->middleware('guest')
->name('register_user')
;

// User Login
Route::get('/login', function(){
    return view('account.login');
})
->middleware('guest')
->name('login');


// User Login Action 
Route::Post('/login',[UserController::class,"login"])
->middleware('guest')
->name('log_user_in');

// User Logout Action 
Route::get('/logout',[UserController::class,"logout"])
->middleware('auth')
->name('logout');

Route::get('/', function(){
    $breadcrumbs = Breadcrumbs::render('home');
    return view('homepage',compact('breadcrumbs'));
})
->middleware('auth')
->name('home');

// ----------------------------
// USER PROFILE

// Search residences
Route::get('/profile_search_residences',[BiodataController::class,"profile_search_residences"])
->middleware('auth')
->name('profile_search_residences')
;
// Search Programs
Route::get('/profile_search_programs',[BiodataController::class,"profile_search_programs"])
->middleware('auth')
->name('profile_search_programs')
;

// Show User Profile
Route::get('/profile/{user}',[BiodataController::class,"show"])
->middleware('auth')
->name('view_profile');

// create User Profile form
Route::get('/profile/{user}/new',[BiodataController::class,"create"])
->middleware('auth')
->name('create_user_profile_form')
;

// /store user profile
Route::post('/profile/{user}',[BiodataController::class,"store"])
->middleware('auth')
->name('create_profile');

// edit user profile
Route::get('/profile/{user}/edit',[BiodataController::class,"edit"])
->middleware('auth','can:update,user')
->name('edit_user_profile_form')
;

// Update User profile
Route::put('/profile/{biodata}',[BiodataController::class,"update"])
->middleware('auth','can:update,biodata')
->name('update_profile')
;

// USER AVATAR

// View avatar change form
Route::get('/avatar/{user}',[UserController::class,"edit_avatar"])
->middleware('auth')
->name('edit_avatar_form')
;
// Update Avatar action
Route::post('/avatar/{user}',[UserController::class,"store_avatar"])
->middleware('auth')
->name('update_avatar','can:update,user')
;

// Reset User Avatar
Route::get('/avatar/{user}/reset',[UserController::class,"reset_avatar"])
->middleware('auth')
->name('reset_avatar')
;


// VIEWS
Route::get('/users',[UserController::class,"view_users"])
->middleware('auth')
->name('view_users')
;

// -------------------------------------------------


// MODAL VIEWS

// modal view user profile info
Route::get('/info/{user}',[BiodataController::class,"show_modal_info"])
->middleware('auth')
->name('show_modal_info');

// Search User on Users table
Route::get('/search_user',[UserController::class,"search_user"])
->middleware('auth')
->name('search_user')
;

Route::get('/hello', function(){
    return new AttendanceResource(Attendance::find(1));
    // return SemesterProgram::find(1)->officiator_role(User::find(1));
    return SemesterProgram::find(1)->officiator_roles(1);
});