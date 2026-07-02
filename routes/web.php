<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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

require __DIR__.'/auth.php';