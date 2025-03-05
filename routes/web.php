<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;


Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai/data', [PegawaiController::class, 'data'])->name('pegawai.data');
Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::get('/api/pegawai', [PegawaiController::class, 'getPegawaiData'])->name('pegawai.api');
