<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::all();
        $totalRoute = $routes->count();
        return view('admin.rute', compact('routes', 'totalRoute'));
    }

    public function store(Request $request)
    {
        // Validasi input dengan pesan error informatif
        $validated = $request->validate([
            'kota_asal' => 'required|string|max:255',
            'kota_tujuan' => 'required|string|max:255',
            'jarak_km' => 'nullable|numeric',
            'estimasi_durasi' => 'nullable|string|max:255',
        ]);

        Route::create($validated);

        return redirect()->back()->with('success', 'Rute berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'kota_asal' => 'required|string|max:255',
            'kota_tujuan' => 'required|string|max:255',
            'jarak_km' => 'nullable|numeric',
            'estimasi_durasi' => 'nullable|string|max:255',
        ]);

        $route = Route::findOrFail($id);
        $route->update($validated);

        return redirect()->back()->with('success', 'Rute berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $route = Route::findOrFail($id);
        $route->delete();

        return redirect()->back()->with('success', 'Rute berhasil dihapus!');
    }
}