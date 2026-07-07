<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
// 🔴 MEMASTIKAN EVENT REGISTERED SUDAH TERINPORT DI SINI
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Memproses Login Pengguna
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Proteksi: Jika dia admin, arahkan ke dashboard admin, jika user ke beranda
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('beranda'));
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    } // 🔴 PERBAIKAN: Kurung penutup fungsi login dipindahkan ke sini agar tidak menelan fungsi Google

    // ==========================================
    // 🔴 FITUR LOGIN GOOGLE (SOCIALITE)
    // ==========================================

    // 1. Mengarahkan user ke Google
    // 1. Mengarahkan user ke Google dan MEMAKSA muncul layar pilih akun
public function redirectToGoogle()
{
    return Socialite::driver('google')
        ->with(['prompt' => 'select_account']) // 🔴 Baris ini yang memaksa layar pilihan akun muncul
        ->redirect();
}

    // 2. Memproses data dari Google
  public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();
        
        // 1. Cari pengguna di TablePlus berdasarkan google_id terlebih dahulu
        $user = User::where('google_id', $googleUser->getId())->first();
        
        if ($user) {
            // JIKA SUDAH PERNAH LOGIN GOOGLE SEBELUMNYA:
            // Selalu perbarui nama di profil mengikuti nama akun Google terbaru
            $user->update([
                'name' => $googleUser->getName(),
            ]);
        } else {
            // JIKA BELUM PERNAH LOGIN GOOGLE DENGAN ID INI:
            // Cek apakah ada akun manual yang menggunakan email yang sama
            $existingUser = User::where('email', $googleUser->getEmail())->first();
            
            if ($existingUser) {
                // Skenario yang kamu maksud: Email sama tapi google_id masih kosong (NULL)
                // Kita "stempel" google_id-nya ke TablePlus dan update namanya dari Google
                $existingUser->update([
                    'google_id' => $googleUser->getId(),
                    'name' => $googleUser->getName(), // Mengambil nama dari akun Google
                ]);
                
                $user = $existingUser;
            } else {
                // Jika benar-benar email baru, buat baris data baru di TablePlus
                $user = User::create([
                    'name' => $googleUser->getName(), // Mengambil nama dari akun Google
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(), // Mengisi kolom google_id di TablePlus
                    'password' => null, // Dikosongkan karena login via Google
                    'role' => 'user', 
                    'email_verified_at' => now(), // Otomatis terverifikasi karena akun Google valid
                ]);
            }
        }
        
        // Login akun ke dalam sistem sistem TravelKu
        Auth::login($user);
        return redirect()->route('beranda')->with('success', 'Berhasil login menggunakan Google!');
        
    } catch (\Exception $e) {
        return redirect()->route('login')->with('error', 'Gagal login menggunakan Google, silakan coba lagi.');
    }
}
    // ==========================================
    // 🔴 FITUR REGISTER & LOGOUT MANUAL
    // ==========================================

    // Memproses Registrasi Pengguna Baru
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Berdasarkan struktur tabel database Anda, kolom nama adalah 'name'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role pendaftaran awal
        ]);

        // 🔴 PERBAIKAN 1: Memicu Laravel untuk otomatis mengirim link verifikasi ke Gmail user
        event(new Registered($user));

        // Otomatis login setelah berhasil mendaftar
        Auth::login($user);

        // 🔴 PERBAIKAN 2: Diarahkan langsung ke rute pemberitahuan verifikasi (verification.notice)
        return redirect()->route('verification.notice');
    }

    // Memproses Logout Pengguna
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda');
    }
}