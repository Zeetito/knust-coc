<?php

use App\Http\Controllers\Api\V1\Admin;
use App\Http\Controllers\api\v1\AttendanceController;
use App\Http\Controllers\api\v1\Auth\LoginController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Users
Route::get('/users', [UserController::class, 'index']);

// Attendance
// Route::get('attendances',[AttendanceController::class,'index']);

// ADMIN ROUTES
Route::prefix('admin')->middleware('auth:sanctum', 'role:ministry_members_level')->group(function () {
    // Route::prefix('admin')->group(function (){

    // USERS
    Route::get('/users/{user}', [Admin\UserController::class, 'show']);

    Route::get('/users', [Admin\UserController::class, 'index']);
    Route::post('/users', [Admin\UserController::class, 'store']);

    // ATTENDANCE
    Route::get('/attendance', [Admin\AttendanceController::class, 'index']);
    Route::post('/attendance', [Admin\AttendanceController::class, 'store']);

});

// Login Controller
// Route::post('/login', [LoginController::class]);
Route::post('/login', [LoginController::class, 'login']);
