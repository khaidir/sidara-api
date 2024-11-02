<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProgressUnduhanRaporApiController;
use App\Http\Controllers\Api\DetailUserAktifApiController;

Route::post('progress-unduhan-rapor', [ProgressUnduhanRaporApiController::class, 'index'])->name('api-pur.index');
Route::post('progress-unduhan-rapor-bulk', [ProgressUnduhanRaporApiController::class, 'bulk'])->name('api-pur-bulk.index');
Route::get('progress-unduhan-rapor-grafik', [ProgressUnduhanRaporApiController::class, 'grafik'])->name('api-pur-grafik.index');

Route::post('detail-user-aktif-bulk', [DetailUserAktifApiController::class, 'bulk'])->name('api-dua-bulk.index');
