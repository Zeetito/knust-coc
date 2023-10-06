<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Helper;
use App\Models\College;
use App\Models\Meeting;
use App\Models\Semester;
use App\Models\Residence;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\Route;
use Diglactic\Breadcrumbs\Breadcrumbs;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\AttendanceController;

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
Route::get('/attendance/{attendance}',[AttendanceController::class,"show"])
->middleware('auth')
->name('show_attendance')
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
Route::get("/search_user/{attendance}",[AttendanceController::class, "search_user_checked"])
->middleware("auth")
->name("search_user_checked")
;

// Search User on Attendance table
Route::get('/search_attendance_user/{attendance}',[UserController::class,"search_attendance_user"])
->middleware('auth')
->name('search_attendance_user')
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

// User Login Action 
Route::get('/logout',[UserController::class,"logout"])
->middleware('auth')
->name('logout');

Route::get('/', function(){
    $breadcrumbs = Breadcrumbs::render('home');
    return view('homepage',compact('breadcrumbs'));
})
->middleware('auth')
->name('home');

// USER PROFILE

// Show User Profile
Route::get('/profile/{user}',[BiodataController::class,"show"])
->middleware('auth')
->name('view_profile');

// create User Profile form
Route::get('/profile',[BiodataController::class,"create"])
->middleware('auth')
->name('create_user_profile_form')
;

// Create/store user profile
Route::post('/profile',[BiodataController::class,"store"])
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
Route::get('/avatar/{user}/reset',[UserController::class,"reset_avatar"])
->middleware('auth')
->name('reset_avatar')
;


// VIEWS
Route::get('/users',[UserController::class,"view_users"])
->middleware('auth')
->name('view_users')
;


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


Route::get('/hello',function(){
    return secure_url('path/to/route');
    return User::find(14)->fullname();
    // return Role::find(3)->non_permissions()->get();
});