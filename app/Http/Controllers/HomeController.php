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

        // 2. Ambil jadwal travel terbaru yang aktif (dibatasi maksimal 6 data)
        $schedules = TravelSchedule::where('aktif', true)
                        ->orderBy('tanggal_berangkat', 'asc')
                        ->take(6)
                        ->get();

        // 3. Kirim data ke file blade beranda
        return view('beranda', compact('kotaAsal', 'kotaTujuan', 'schedules'));
    }
}