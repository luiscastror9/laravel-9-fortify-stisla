<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguangeController;
use App\Http\Controllers\PermissionController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register/lang', [LanguangeController::class, 'change'])->name('changeLang');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [HomeController::Class, 'index'])->name('dashboard');
    //Change User Password
    Route::put('user/change-password', [UserController::Class, 'changePassword'])->name('user.change_password');

    //Role and Permission Changes
    Route::get('role/{id}/assign-permission',[RoleController::class,'assignPermission'])->name('role.assign.permission');
    Route::put('role/{id}/permission',[RoleController::class,'updatePermission'])->name('update.role.permission');

    //User Route Resources
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);

    //User Profile
    Route::get('profile/edit', [ProfileController::Class, 'index'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::Class, 'update'])->name('profile.update');
});
