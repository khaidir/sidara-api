<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProgressUnduhanRaporApiController;
use App\Http\Controllers\Api\DetailUserAktifApiController;
use App\Http\Controllers\Api\MenusController;

Route::post('progress-unduhan-rapor', [ProgressUnduhanRaporApiController::class, 'index'])->name('api-pur.index');
Route::post('progress-unduhan-rapor-bulk', [ProgressUnduhanRaporApiController::class, 'bulk'])->name('api-pur-bulk.index');
Route::get('progress-unduhan-rapor-grafik', [ProgressUnduhanRaporApiController::class, 'grafik'])->name('api-pur-grafik.index');

Route::post('detail-user-aktif-bulk', [DetailUserAktifApiController::class, 'bulk'])->name('api-dua-bulk.index');

Route::group([
    'prefix' => 'auth',
], function ($router) {
    $router->post('/', [Auth::class, 'login'])->name('api.login');
    $router->post('logout', [Auth::class, 'logout'])->name('api.logout');
});

Route::apiResource('menus', MenusController::class);
// Route::group([
//     'prefix' => 'menus',
// ], function ($router) {
//     $router->get('/', [MenusController::class, 'index'])->name('api.menus.index');
//     $router->get('new', [MenusController::class, 'create'])->name('api.menus.create');
//     $router->post('store', [MenusController::class, 'store'])->name('api.menus.store');
//     $router->get('edit/{id}', [MenusController::class, 'edit'])->name('api.menus.edit');
//     $router->get('delete/{id}', [MenusController::class, 'destroy'])->name('api.menus.delete');
// });
