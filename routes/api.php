<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\UserWeeklyFoodsController;
use App\Http\Controllers\UserWeeklyWorkoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// User registration and login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Foods routes
Route::get('foods', [FoodController::class, 'foods']);
Route::get('foods/{type}', [FoodController::class, 'food']);

// Workouts routes
Route::get('workouts', [WorkoutController::class, 'workouts']);
Route::get('workout/{musclegroup}', [WorkoutController::class, 'workout']);

// Need to be logged in
Route::any('have-to-login', function () {
    $bc = new BaseController();
    return $bc->sendError('Bejelentkezés szükséges', '', 401);
});

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout']);

    // User info (only the update and show routes)
    Route::resource('user-info', UserInfoController::class)->except('index');
    Route::put('/user-info/{id}', [UserInfoController::class, 'update']);

    // User weekly foods
    Route::resource('user-weekly-foods', UserWeeklyFoodsController::class);
    Route::delete('user-weekly-foods-delete/{id}', [UserWeeklyFoodsController::class, 'destroy']);

    // User weekly workouts
    Route::resource('user-weekly-workouts', UserWeeklyWorkoutController::class);
    Route::delete('user-weekly-workouts-delete/{id}', [UserWeeklyWorkoutController::class, 'destroy']);
});
