<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Tampilkan halaman profil dengan data user yang sedang login
    public function show()
    {
        $user = Auth::user();
        return view('profil', compact('user')); // Pastikan nama file blade Anda adalah profile.blade.php
    }

    // Proses simpan pembaruan data No HP dan Alamat
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        // Update data khusus yang diizinkan diubah oleh user
        $user->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui!');
    }

    // Proses Logout Akun
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda')->with('success', 'Anda telah berhasil keluar.');
    }
}