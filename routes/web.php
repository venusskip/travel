<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\UserController;
// Route untuk checkout user

Route::get('/', function () {
    return view('welcome');
});

// Bungkus rute admin dalam group prefix
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Ganti rute jadwal lama kamu dengan ini:
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
    
    // PERBAIKAN: Mengarahkan halaman rute ke RouteController fungsi index
    Route::get('/rute', [RouteController::class, 'index'])->name('rute');
    
    // Tambahkan ini juga agar fungsi Simpan, Update, dan Hapus di dalam admin berjalan lancar
    Route::post('/rute', [RouteController::class, 'store'])->name('rute.store');
    Route::put('/rute/{id}', [RouteController::class, 'update'])->name('rute.update');
    Route::delete('/rute/{id}', [RouteController::class, 'destroy'])->name('rute.destroy');

   // 2. MODIFIKASI RUTE PEMESANAN ADMIN DI SINI
    // Mengarahkan ke BookingController fungsi index & updateStatus, otomatis bernama admin.booking.index dan admin.booking.updateStatus
    Route::get('/pemesanan', [BookingController::class, 'index'])->name('booking.index');
    Route::patch('/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
    

    // Rute resource untuk manajemen user
    Route::resource('user', UserController::class)->only(['index', 'update']);

    Route::get('/laporan', function () {
        return view('admin.laporan');
    })->name('laporan');

});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/jadwal', function () {
    return view('jadwaltravel');
});

Route::get('/detail-travel', function () {
    return view('detailtravel');
});

// Rute Halaman Login
Route::get('/login', function () {
    return view('login');
});

// Rute Halaman Register
Route::get('/register', function () {
    return view('register');
});

Route::get('/riwayat', function () {
    return view('riwayat'); // mengarah ke file riwayat.blade.php
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/keranjang', function () {
    return view('keranjang');
});

Route::get('/checkout', function () {
    return view('checkout');
});

require __DIR__.'/auth.php';

