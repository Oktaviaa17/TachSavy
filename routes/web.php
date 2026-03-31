<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\PenjagaController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('landing'))->name('landing');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);

Route::get('/register', [AuthController::class,'showRegister'])->name('register');
Route::post('/register', [AuthController::class,'register'])->name('register.post');

Route::post('/logout', [AuthController::class,'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| SEMUA USER LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class,'index'])->name('home');

    /*
    |--------------------------------------------------------------------------
    | BUKU (SEMUA ROUTE SEKALI SAJA)
    |--------------------------------------------------------------------------
    */
    Route::resource('buku', BukuController::class);

    /*
    |--------------------------------------------------------------------------
    | KATEGORI
    |--------------------------------------------------------------------------
    */
    Route::resource('kategori', KategoriController::class);

    /*
    |--------------------------------------------------------------------------
    | PEMINJAMAN
    |--------------------------------------------------------------------------
    */
    Route::resource('peminjaman', PeminjamanController::class)
        ->except(['show','edit','update']);

    // Riwayat
    Route::get('/peminjaman/riwayat', [PeminjamanController::class,'riwayat'])
        ->name('peminjaman.riwayat');

    // Cetak
    Route::get('/peminjaman/{id}/cetak', [PeminjamanController::class,'cetak'])
        ->name('peminjaman.cetak');

    // ACC / Tolak
    Route::post('/peminjaman/{id}/acc', [PeminjamanController::class,'acc'])
        ->name('peminjaman.acc');

    Route::post('/peminjaman/{id}/tolak', [PeminjamanController::class,'tolak'])
        ->name('peminjaman.tolak');

    // Pengembalian
    Route::post('/peminjaman/{id}/ajukan', [PeminjamanController::class,'ajukanKembali'])
        ->name('peminjaman.ajukan');

    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class,'kembalikan'])
        ->name('peminjaman.kembalikan');

    /*
    |--------------------------------------------------------------------------
    | ULASAN
    |--------------------------------------------------------------------------
    */
    Route::resource('ulasans', UlasanController::class);

    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */
    Route::get('/laporan/peminjaman', [LaporanController::class,'peminjamanBulanan'])
        ->name('laporan.peminjaman.bulanan');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])->group(function () {

    Route::resource('admin/penjaga', PenjagaController::class);
    Route::resource('admin2/user', UserController::class);

});