<?php

use App\Models\User;
use App\Models\Zone;
use App\Models\College;
use App\Models\Residence;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BiodataController;

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
    return view('homepage');
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

Route::get('/hello',function(){
    return College::find(2)->pg_programs();
});