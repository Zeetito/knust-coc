<?php

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin;

use App\Http\Resources\UserCollection;
use App\Http\Controllers\Api\V1\UserController;

use App\Http\Controllers\api\v1\AttendanceController;
use App\Http\Controllers\api\v1\Auth\LoginController;

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
Route::get('/users',[UserController::class, 'index']);


// Attendance
Route::get('attendances',[AttendanceController::class,'index']);

// ADMIN ROUTES
Route::prefix('admin')->middleware('auth:sanctum')->group(function (){
    // USERS
    Route::get('/users',[Admin\UserController::class, "index"]);
    Route::post('/users', [Admin\UserController::class,"store"]);

    // ATTENDANCE
    Route::get('/attendance',[Admin\AttendanceController::class,"index"]);
    Route::post('/attendance',[Admin\AttendanceController::class,"store"]);

});

    // Login Controller
    // Route::post('/login', [LoginController::class]);
    Route::post('/login', [LoginController::class, "login"]);