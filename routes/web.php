<?php

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\LaporanGaji;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanAbsen;
use App\Http\Controllers\SPKController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanSlipGaji;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PotongGajiController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\RekeningKaryawanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::middleware(['auth', 'web'])->group(function () {
    //dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //karyawan
    Route::resource('karyawan', KaryawanController::class);

    //jabatan
    Route::resource('jabatan', JabatanController::class);

    //absensi
    // Route::resource('absensi', AbsensiController::class);

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/{id}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
    Route::put('/absensi/{id}', [AbsensiController::class, 'update'])->name('absensi.update');
    Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');
    Route::post('/absensi/cari', [AbsensiController::class, 'cariAbsensi'])->name('absensi.cari');
    Route::post('/absensi/cari-lembur', [AbsensiController::class, 'cariAbsensiLembur'])->name('absensi.cari.lembur');

    // Route untuk import/export
    Route::get('/absensi/import/form', [AbsensiController::class, 'showImportForm'])->name('absensi.import.form');
    Route::post('/absensi/import/process', [AbsensiController::class, 'import'])->name('absensi.import.process');
    Route::get('/absensi/export', [AbsensiController::class, 'export'])->name('absensi.export');
    Route::get('/absensi/import/template', [AbsensiController::class, 'downloadTemplate'])->name('absensi.import.template');

    //lembur
    Route::resource('lembur', LemburController::class);

    //setting potong gaji
    Route::resource('potong-gaji', PotongGajiController::class);

    //user
    Route::resource('user', UserController::class);

    //gaji
    Route::resource('gaji', GajiController::class);
    Route::put('gaji/{gaji}/approve', [GajiController::class, 'approve'])->name('gaji.approve');
    Route::put('gaji/{gaji}/decline', [GajiController::class, 'decline'])->name('gaji.decline');
    Route::put('gaji/{gaji}/cancel', [GajiController::class, 'cancel'])->name('gaji.cancel');
    Route::put('gaji/{gaji}/pay', [GajiController::class, 'bayar'])->name('gaji.bayar');
    // Tambahkan route ini di web.php
    Route::post('/gaji/hitung-otomatis', [GajiController::class, 'hitungGajiOtomatis'])->name('gaji.hitung.otomatis');
    // Tambahkan route ini di web.php
    Route::post('/gaji/cek-data', [GajiController::class, 'cekDataGaji'])->name('gaji.cek.data');

    //laporan
    Route::get('laporan-gaji', [LaporanGaji::class, 'index'])->name('laporan.gaji');
    Route::post('laporan-gaji', [LaporanGaji::class, 'print'])->name('laporan.gaji.print');
    Route::get('laporan-absen', [LaporanAbsen::class, 'index'])->name('laporan.absen');
    Route::post('laporan-absen', [LaporanAbsen::class, 'print'])->name('laporan.absen.print');
    Route::get('slip-gaji', [LaporanSlipGaji::class, 'index'])->name('slip.gaji');
    Route::post('slip-gaji', [LaporanSlipGaji::class, 'print'])->name('slip.gaji.print');

    // Route::get('/mail', function () {
    //     $name = 'Test Gaji';

    //     Mail::to('innakabard@gmail.com')->send(new WelcomeMail($name));
    // });

    // Route::get('/mail', function () {
    //     // Pastikan data ini ada di database
    //     $karyawanId = 1;
    //     $gajiId = 9;

    //     $karyawan = Karyawan::find($karyawanId);
    //     $gaji = Gaji::find($gajiId);

    //     if (!$karyawan) {
    //         return response('Karyawan tidak ditemukan', 404);
    //     }

    //     if (!$gaji) {
    //         return response('Gaji tidak ditemukan', 404);
    //     }

    //     // Jika data ditemukan, kirim email
    //     Mail::to('mutiadian45@gmail.com')->send(new WelcomeMail($karyawanId, $gajiId));

    //     return 'Email telah dikirim!';
    // });


    Route::post('/gaji/{gaji}/bayar', [GajiController::class, 'kirimEmail'])->name('gaji.kirimEmail');

    // CRUD Rekening Karyawan
    Route::resource('rekenings', RekeningKaryawanController::class);

    // CRUD Transaksi
    Route::resource('transaksi', TransaksiController::class);

    //ubah password
    Route::get('profile', [ProfileController::class, 'index'])->name('ubah-profile');
    Route::put('ubah-profile', [ProfileController::class, 'ubah_profile'])->name('profile.update');
    Route::put('ubah-avatar', [ProfileController::class, 'ubah_avatar'])->name('avatar.update');
    Route::put('ubah-password', [ProfileController::class, 'ubah_password'])->name('password.update');

    //spk
    Route::get('/performance-evaluation', [SPKController::class, 'index']);
});
