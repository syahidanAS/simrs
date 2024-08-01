<?php

use App\Http\Controllers\DiagnoseIcdxController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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



Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login-action', [LoginController::class, 'action'])->name('login-action')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'check.session'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('/master')->group(function () {
        Route::prefix('/diagnose')->group(function () {
            Route::get('icd_x', [DiagnoseIcdxController::class, 'index'])->name('master.diagnose.icd_x');
        });
        Route::get('/polyclinics', [PolyclinicController::class, 'index'])->name('master.polyclinics');
        Route::get('/polyclinics/create', [PolyclinicController::class, 'create'])->name('master.polyclinics.create');
        Route::post('/polyclinics/store', [PolyclinicController::class, 'store'])->name('master.polyclinics.store');
        Route::get('/polyclinics/edit/{id}', [PolyclinicController::class, 'edit'])->name('master.polyclinics.edit');
        Route::post('/polyclinics/update', [PolyclinicController::class, 'update'])->name('master.polyclinics.update');
        Route::get('/polyclinics/destroy/{id}', [PolyclinicController::class, 'destroy'])->name('master.polyclinics.destroy');

        Route::get('/doctors', [DoctorController::class, 'index'])->name('master.doctors');
        Route::get('/doctors/create', [DoctorController::class, 'create'])->name('master.doctors.create');
        Route::post('/doctors/store', [DoctorController::class, 'store'])->name('master.doctors.store');
        Route::get('/doctors/edit/{id}', [DoctorController::class, 'edit'])->name('master.doctors.edit');
        Route::get('/doctors/specialities-list', [DoctorController::class, 'specialitiesList'])->name('master.doctors.specialities-list');
        Route::post('/doctors/update', [DoctorController::class, 'update'])->name('master.doctors.update');
        Route::get('/doctors/destroy/{id}', [DoctorController::class, 'destroy'])->name('master.doctors.destroy');
    });
    Route::prefix('/setting')->group(function () {
        Route::get('/menus', [MenuController::class, 'index'])->name('setting.menus');
        Route::post('/menus', [MenuController::class, 'store'])->name('setting.menus.store');
        Route::get('/menus/{id}', [MenuController::class, 'edit'])->name('setting.menus.edit');
        Route::post('/menus/destroy', [MenuController::class, 'destroy'])->name('setting.menus.destroy');
        Route::get('/menus/parents/children', [MenuController::class, 'parentMenu'])->name('setting.menus.parents.children');
        Route::put('/menus/update', [MenuController::class, 'update'])->name('setting.menus.update');

        Route::get('/access-utilities/roles', [RoleController::class, 'index'])->name('setting.access-utilities.roles');
        Route::get('/access-utilities/roles/create', [RoleController::class, 'create'])->name('setting.access-utilities.roles.create');
        Route::post('/access-utilities/roles/store', [RoleController::class, 'store'])->name('setting.access-utilities.roles.store');
        Route::get('/access-utilities/roles/edit/{id}', [RoleController::class, 'edit'])->name('setting.access-utilities.roles.edit');
        Route::post('/access-utilities/roles/update', [RoleController::class, 'update'])->name('setting.access-utilities.roles.update');
        Route::get('/access-utilities/roles/destroy/{id}', [RoleController::class, 'destroy'])->name('setting.access-utilities.roles.destroy');

        Route::get('/access-utilities/permissions', [PermissionController::class, 'index'])->name('setting.access-utilities.permissions');
        Route::get('/access-utilities/permissions/create', [PermissionController::class, 'create'])->name('setting.access-utilities.permissions.create');
        Route::post('/access-utilities/permissions/store', [PermissionController::class, 'store'])->name('setting.access-utilities.permissions.store');
        Route::get('/access-utilities/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('setting.access-utilities.permissions.edit');
        Route::post('/access-utilities/permissions/update', [PermissionController::class, 'update'])->name('setting.access-utilities.permissions.update');
        Route::get('/access-utilities/permissions/destroy/{id}', [PermissionController::class, 'destroy'])->name('setting.access-utilities.permissions.destroy');


        Route::get('/users', [UserController::class, 'index'])->name('setting.users');
        Route::post('/users', [UserController::class, 'store'])->name('setting.users.store');
        Route::get('/users/roles', [UserController::class, 'getRoles'])->name('setting.users.roles');
        Route::put('/users/update', [UserController::class, 'update'])->name('setting.users.update');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('setting.users.edit');
        Route::get('/users/destroy/{id}', [UserController::class, 'destroy'])->name('setting.users.destroy');
    });
});
