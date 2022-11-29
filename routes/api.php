<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\VehicleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::prefix('admin')->group(function () {
 // -----------******Auth route*********---------
    Route::post('/sign-up', [AuthController::class, 'signup']);
    Route::post('/sign-in', [AuthController::class, 'signIn']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
/*
|--------------------------------------------------------------------------
| middleware
|--------------------------------------------------------------------------
*/
    Route::middleware(['adminApi'])->group(function () {

    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    Route::post('/update-password', [AuthController::class, 'updatePassword']);

    // -----------******Category route*********---------
    Route::get('/category-list', [CategoryController::class, 'categryList']);
    Route::post('/create-category', [CategoryController::class, 'store']);
    Route::post('/update-category', [CategoryController::class, 'update']);
    Route::delete('/delete-category', [CategoryController::class, 'destroy']);
 // -----------******vehicle route*********---------
    Route::get('/list-vehicle', [VehicleController::class, 'vehicleList']);
    Route::post('/store-vehicle', [VehicleController::class, 'store']);
    Route::post('/update-vehicle', [VehicleController::class, 'update']);
    Route::delete('/delete-vehicle', [VehicleController::class, 'destroy']);

});
});
