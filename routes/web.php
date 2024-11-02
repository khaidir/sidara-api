<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportsController;
use App\Http\Controllers\ProgressUnduhanRaporController;
use App\Http\Controllers\DetailUserAktifController;

use App\Http\Controllers\Api\ApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])
    ->middleware(\App\Http\Middleware\RedirectIfAuthenticated::class)
    ->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group([
    'middleware' => 'auth'
], function ($router) {

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
});



