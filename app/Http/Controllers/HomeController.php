<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil data kota unik untuk dropdown pencarian agar tidak duplikat
        $kotaAsal = Route::distinct()->pluck('kota_asal');
        $kotaTujuan = Route::distinct()->pluck('kota_tujuan');

        // 2. AMBIL SEMUA DATA RUTE UTUH (Untuk bagian Rute Populer)
        // Kita ambil semua rute yang statusnya aktif (jika ada kolom 'aktif' di tabel routes Anda)
        $popularRoutes = Route::all(); 
        // Catatan: Jika Anda memiliki kolom 'aktif' di tabel routes, gunakan:
        // $popularRoutes = Route::where('aktif', true)->get();

        // 3. Ambil jadwal travel terbaru yang aktif (dibatasi maksimal 6 data)
        $schedules = TravelSchedule::where('aktif', true)
                        ->orderBy('tanggal_berangkat', 'asc')
                        ->take(6)
                        ->get();

        // 4. Kirim semua data (termasuk $popularRoutes) ke file blade beranda
        return view('beranda', compact('kotaAsal', 'kotaTujuan', 'schedules', 'popularRoutes'));
    }
}