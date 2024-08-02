<?php

use App\Http\Controllers\DiagnoseIcdxController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicalProductController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductGroupController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
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
        Route::get('/polyclinics', [PolyclinicController::class, 'index'])->name('master.polyclinics')->middleware('permission:Show Master Poliklinik');
        Route::get('/polyclinics/create', [PolyclinicController::class, 'create'])->name('master.polyclinics.create');
        Route::post('/polyclinics/store', [PolyclinicController::class, 'store'])->name('master.polyclinics.store');
        Route::get('/polyclinics/edit/{id}', [PolyclinicController::class, 'edit'])->name('master.polyclinics.edit')->middleware('permission:Edit Master Poliklinik');
        Route::post('/polyclinics/update', [PolyclinicController::class, 'update'])->name('master.polyclinics.update');
        Route::get('/polyclinics/destroy/{id}', [PolyclinicController::class, 'destroy'])->name('master.polyclinics.destroy');

        Route::get('/doctors', [DoctorController::class, 'index'])->name('master.doctors');
        Route::get('/doctors/create', [DoctorController::class, 'create'])->name('master.doctors.create');
        Route::post('/doctors/store', [DoctorController::class, 'store'])->name('master.doctors.store');
        Route::get('/doctors/edit/{id}', [DoctorController::class, 'edit'])->name('master.doctors.edit');
        Route::get('/doctors/specialities-list', [DoctorController::class, 'specialitiesList'])->name('master.doctors.specialities-list');
        Route::post('/doctors/update', [DoctorController::class, 'update'])->name('master.doctors.update');
        Route::get('/doctors/destroy/{id}', [DoctorController::class, 'destroy'])->name('master.doctors.destroy');

        Route::get('/cost/product-prices', [MedicalProductController::class, 'index'])->name('master.cost.product-prices');
        Route::get('/cost/product-prices/industries', [MedicalProductController::class, 'industries'])->name('master.cost.product-prices.industries');
        Route::get('/cost/product-prices/units', [MedicalProductController::class, 'units'])->name('master.cost.product-prices.units');
        Route::get('/cost/product-prices/types', [MedicalProductController::class, 'types'])->name('master.cost.product-prices.types');
        Route::get('/cost/product-prices/categories', [MedicalProductController::class, 'categories'])->name('master.cost.product-prices.categories');
        Route::get('/cost/product-prices/groups', [MedicalProductController::class, 'groups'])->name('master.cost.product-prices.groups');
        Route::post('/cost/product-prices', [MedicalProductController::class, 'store'])->name('master.cost.product-prices.store');
        Route::get('/cost/product-prices/detail/{id}', [MedicalProductController::class, 'detail'])->name('master.cost.product-prices.detail');
        Route::get('/cost/products/create', [MedicalProductController::class, 'create'])->name('master.cost.products.create');

        Route::get('/units', [UnitController::class, 'index'])->name('master.units');
        Route::get('/units/create', [UnitController::class, 'create'])->name('master.units.create');
        Route::post('/units/store', [UnitController::class, 'store'])->name('master.units.store');
        Route::post('/units/update', [UnitController::class, 'update'])->name('master.units.update');
        Route::get('/units/edit/{id}', [UnitController::class, 'edit'])->name('master.units.edit')->middleware('permission:Edit Master Satuan Produk');
        Route::get('/units/destroy/{id}', [UnitController::class, 'destroy'])->name('master.units.destroy');

        Route::get('/types', [ProductTypeController::class, 'index'])->name('master.types');
        Route::get('/types/create', [ProductTypeController::class, 'create'])->name('master.types.create');
        Route::post('/types/store', [ProductTypeController::class, 'store'])->name('master.types.store');
        Route::post('/types/update', [ProductTypeController::class, 'update'])->name('master.types.update');
        Route::get('/types/edit/{id}', [ProductTypeController::class, 'edit'])->name('master.types.edit');
        Route::get('/types/destroy/{id}', [ProductTypeController::class, 'destroy'])->name('master.types.destroy');

        Route::get('/categories', [ProductCategoryController::class, 'index'])->name('master.categories');
        Route::get('/categories/create', [ProductCategoryController::class, 'create'])->name('master.categories.create');
        Route::post('/categories/store', [ProductCategoryController::class, 'store'])->name('master.categories.store');
        Route::post('/categories/update', [ProductCategoryController::class, 'update'])->name('master.categories.update');
        Route::get('/categories/edit/{id}', [ProductCategoryController::class, 'edit'])->name('master.categories.edit');
        Route::get('/categories/destroy/{id}', [ProductCategoryController::class, 'destroy'])->name('master.categories.destroy');

        Route::get('/groups', [ProductGroupController::class, 'index'])->name('master.groups');
        Route::get('/groups/create', [ProductGroupController::class, 'create'])->name('master.groups.create');
        Route::post('/groups/store', [ProductGroupController::class, 'store'])->name('master.groups.store');
        Route::post('/groups/update', [ProductGroupController::class, 'update'])->name('master.groups.update');
        Route::get('/groups/edit/{id}', [ProductGroupController::class, 'edit'])->name('master.groups.edit');
        Route::get('/groups/destroy/{id}', [ProductGroupController::class, 'destroy'])->name('master.groups.destroy');
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
