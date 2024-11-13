<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportsController;
use App\Http\Controllers\ProgressUnduhanRaporController;
use App\Http\Controllers\DetailUserAktifController;

use App\Http\Controllers\UsersController;
// use App\Http\Controllers\admin\RolesController;
// use App\Http\Controllers\admin\PermissionsController;

use App\Http\Controllers\Api\ApiController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('login', [AuthController::class, 'showLoginForm'])
    ->middleware(\App\Http\Middleware\RedirectIfAuthenticated::class)
    ->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group([
    'middleware' => 'auth'
], function ($router) {

    $router->get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group([
        'prefix' => 'imports',
    ], function ($router) {
        $router->get('/', [ImportsController::class, 'index'])->name('import.index');
        $router->get('progress-unduhan-rapor', [ProgressUnduhanRaporController::class, 'index'])->name('pur.index');
        $router->post('progress-unduhan-rapor', [ProgressUnduhanRaporController::class, 'importExcel'])->name('pur.excel');
        $router->get('detail-user-aktif', [DetailUserAktifController::class, 'index'])->name('dua.index');
        $router->post('detail-user-aktif', [DetailUserAktifController::class, 'importExcel'])->name('dua.excel');
    });

    Route::group([
        'prefix' => 'data',
    ], function ($router) {
        // $router->get('/pur', [PurController::class, 'index'])->name('put.index');
        // $router->get('/pur/data', [PurController::class, 'getData'])->name('put.data');
        // $router->get('/dua', [DuaController::class, 'index'])->name('dua.index');
        // $router->get('/dua/data', [DuaController::class, 'getData'])->name('dua.data');
    });

    Route::group([
        'prefix' => 'users',
    ], function ($router) {
        $router->get('/', [UsersController::class, 'index'])->name('users.index');
        $router->get('data', [UsersController::class, 'getData'])->name('users.data');
        $router->get('new', [UsersController::class, 'create'])->name('users.create');
        $router->post('store', [UsersController::class, 'store'])->name('pusers.store');
        $router->get('edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        $router->get('delete/{id}', [UsersController::class, 'destroy'])->name('users.delete');
    });

    // Route::group([
    //     'prefix' => 'roles',
    // ], function ($router) {
    //     $router->get('/', [RolesController::class, 'index'])->name('roles.index');
    //     $router->get('data', [RolesController::class, 'getData'])->name('roles.data');
    //     $router->get('new', [RolesController::class, 'create'])->name('roles.create');
    //     $router->post('store', [RolesController::class, 'store'])->name('roles.store');
    //     $router->get('edit/{id}', [RolesController::class, 'edit'])->name('roles.edit');
    //     $router->get('delete/{id}', [RolesController::class, 'destroy'])->name('roles.delete');
    // });
    // Route::group([
    //     'prefix' => 'permissions',
    // ], function ($router) {
    //     $router->get('/', [PermissionsController::class, 'index'])->name('permissions.index');
    //     $router->get('data', [PermissionsController::class, 'getData'])->name('permissions.data');
    //     $router->get('new', [PermissionsController::class, 'create'])->name('permissions.create');
    //     $router->post('store', [PermissionsController::class, 'store'])->name('permissions.store');
    //     $router->get('edit/{id}', [PermissionsController::class, 'edit'])->name('permissions.edit');
    //     $router->get('delete/{id}', [PermissionsController::class, 'destroy'])->name('permissions.delete');
    // });
});



