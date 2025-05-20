<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('cari-absensi', [AbsensiController::class, 'cariAbsensi'])->name('absen.cari');
Route::post('cari-absensi-lembur', [AbsensiController::class, 'cariAbsensiLembur'])->name('absen.lembur.cari');

Route::get('karyawans', [KaryawanController::class, 'index'])->name('api.karyawan');
