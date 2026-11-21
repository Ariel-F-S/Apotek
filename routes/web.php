<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// Halaman awal langsung diarahkan ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Semua user yang sudah login (Pimpinan, Apoteker, Kasir) bisa akses /home
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Khusus Role: Apoteker (Kelola Data Obat & Kategori Obat)
Route::middleware(['auth', 'apoteker'])->group(function () {
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

// Khusus Role: Kasir (Transaksi Penjualan)
Route::middleware(['auth', 'kasir'])->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
});

// Khusus Role: Pimpinan (Laporan Penjualan & Stok)
Route::middleware(['auth', 'pimpinan'])->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});