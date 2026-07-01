<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/jadwal', function () {
        return view('admin.jadwal');
    })->name('jadwal');

    Route::get('/rute', function () {
        return view('admin.rute');
    })->name('rute');

     Route::get('/pemesanan', function () {
        return view('admin.pemesanan');
    })->name('pemesanan');

    Route::get('/user', function () {
        return view('admin.user');
    })->name('user');

    Route::get('/laporan', function () {
        return view('admin.laporan');
    })->name('laporan');

});