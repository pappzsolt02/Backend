<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\UserInfoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// api/
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::any('have-to-login', function () {
    // return response()->json('Bejelentkezés szükséges',401);
    $bc = new BaseController();
    return $bc->sendError('Bejelentkezés szükséges', '', 401);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user/{id}', [UserInfoController::class, 'show']);
    Route::post('update-user-info', [UserInfoController::class, 'update']);
});
