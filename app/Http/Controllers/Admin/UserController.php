<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 1. Menampilkan seluruh data user ke halaman blade kamu
    public function index()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    // 2. Memproses perubahan role (Ketentuan Tugas 2.4 & 4.2)
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'role' => 'required|in:admin,user',
        ], [
            'role.in' => 'Role harus berupa admin atau user saja!'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'role' => $request->role
        ]);

        // Berikan notifikasi sukses (Ketentuan Tugas 4.3)
        return redirect()->back()->with('success', 'Role user ' . $user->name . ' berhasil diperbarui!');
    }
}