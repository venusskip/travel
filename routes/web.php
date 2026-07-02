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

require __DIR__.'/auth.php';