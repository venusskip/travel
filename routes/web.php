<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\TravelScheduleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\LaporanController;
// TAMBAHAN UNTUK PROSES REQUEST VERIFIKASI EMAIL
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ==========================================
// 1. HALAMAN YANG BISA DIAKSES TANPA LOGIN
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/jadwal', [TravelScheduleController::class, 'index'])->name('jadwal.travel');
Route::get('/detail-travel/{id}', [TravelScheduleController::class, 'show'])->name('jadwal.detail');

// Rute Tamu (Hanya bisa diakses jika BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () { return view('login'); })->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', function () { return view('register'); })->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ==========================================
// 🔴 RUTE VERIFIKASI EMAIL (TETAP DIPERTAHANKAN UNTUK ALUR SETELAH REGISTER)
// ==========================================
// 1. Tampilan halaman pemberitahuan "Silahkan Cek Email Anda" setelah sukses register
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 2. Memproses link verifikasi saat pengguna mengklik tombol di dalam Gmail mereka
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('beranda')->with('success', 'Email berhasil diverifikasi!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// 3. Aksi ketika pengguna menekan tombol "Kirim Ulang Email"
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// ==========================================
// 2. HALAMAN YANG WAJIB LOGIN (TIDAK DIKUNCI VERIFIKASI EMAIL)
// ==========================================
// 🔴 MODIFIKASI: Middleware 'verified' dihapus total dari sini. 
// User biasa maupun baru bebas mengakses semua fitur ini asal sudah login.
Route::middleware(['auth'])->group(function () {
    // Proses Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman Keranjang Belanja
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/keranjang/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Halaman Transaksi & Data Diri Pengguna
    Route::get('/checkout', [BookingController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [BookingController::class, 'storeCheckout'])->name('checkout.store');
    Route::get('/riwayat', [BookingController::class, 'riwayatUser'])->name('riwayat');

    // Manajemen Profil
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profil/update', [ProfileController::class, 'update'])->name('profile.update');
});


// ==========================================
// 3. HALAMAN POLA PROTEKSI ADMIN (PREFIX)
// ==========================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    
   Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Jadwal Travel Sisi Admin
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
    
    // Manajemen Rute Sisi Admin
    Route::get('/rute', [RouteController::class, 'index'])->name('rute');
    Route::post('/rute', [RouteController::class, 'store'])->name('rute.store');
    Route::put('/rute/{id}', [RouteController::class, 'update'])->name('rute.update');
    Route::delete('/rute/{id}', [RouteController::class, 'destroy'])->name('rute.destroy');

    // Manajemen Pemesanan Sisi Admin
    Route::get('/pemesanan', [BookingController::class, 'index'])->name('booking.index');
    Route::patch('/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
    
    // Menangani penghapusan data transaksi dan pengosongan kursi via Admin
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    
    // Manajemen User
    Route::resource('user', UserController::class)->only(['index', 'update']);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
});
    

// Menjaga kompatibilitas jika ada file auth bawaan lama
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}