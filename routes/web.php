<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\VehicleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\frontend\RegisterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/login', [RegisterController::class, 'loginForm'])->name('admin.login.form');
Route::get('/', [RegisterController::class, 'index'])->name('admin.register.index');
Route::post('admin-register', [RegisterController::class, 'store'])->name('admin.register.post');
Route::get('reset/password', [RegisterController::class, 'reset'])->name('admin.reset.password');
Route::post('reset/password-post', [RegisterController::class, 'reset_post'])->name('admin.reset.post');



Route::middleware(['auth', 'user-access'])->group(function () {
Route::prefix('admin')->group(function () {
    
Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [RegisterController::class, 'logout'])->name('admin.logout');
Route::get('/dashboard/setting', [SettingController::class, 'index'])->name('admin.setting.index');
Route::post('/dashboard/change-password', [SettingController::class, 'password_update'])->name('admin.password.update');
Route::post('/dashboard/info-update', [SettingController::class, 'update'])->name('admin.profileinfo.update');

Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('admin.category.index');
Route::post('/dashboard/categories-store', [CategoryController::class, 'store'])->name('admin.category.store');
Route::post('/dashboard/categories-update', [CategoryController::class, 'update'])->name('admin.category.update');
Route::post('/dashboard/categories-delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');

Route::get('/dashboard/vehicle', [VehicleController::class, 'index'])->name('admin.vehicle.index');
Route::post('/dashboard/vehicle-store', [VehicleController::class, 'store'])->name('admin.vehicle.store');
Route::post('/dashboard/vehicle-update', [VehicleController::class, 'update'])->name('admin.vehicle.update');
Route::post('/dashboard/vehicle-delete/{id}', [VehicleController::class, 'destroy'])->name('admin.vehicle.delete');
});
});