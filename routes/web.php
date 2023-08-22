<?php

use App\Models\User;
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

Route::get('/', function(){
    return view('homepage');
})
->middleware('auth')
->name('home');

// SHOW USER PROFILE
Route::get('/profile',[UserController::class,"profile"])
->middleware('auth')
->name('view_profile')
;

// EDIT USER PROFILE
Route::get('/edit-profile', function(){
    $user = auth()->user();
    $profile = $user->biodata;
    return view('profile.edit',['user'=>$user , 'profile'=>$profile]);
    // return view('profile.edit',['user'=>auth()->user()]);
})
->middleware('auth')
->name('edit_user_profile_form')
;

// Route::resource('/profile',BiodataController::class)
// ->middleware('auth')
// ->name('profile')


