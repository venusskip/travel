<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelSchedule;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung data statistik utama card
        $totalJadwal = TravelSchedule::count();
        $totalPemesanan = Booking::count();
        $totalUser = User::where('role', 'user')->count(); // Menghitung user biasa saja
        
        // 2. Menghitung total pendapatan dari transaksi yang statusnya 'Selesai'
        $totalPendapatan = Booking::where('status', 'Selesai')->sum('total_harga');

        // 3. Menghitung jumlah per status (Menunggu Pembayaran, Selesai, Dibatalkan)
        $statusMenunggu = Booking::where('status', 'Menunggu Pembayaran')->count();
        $statusSelesai = Booking::where('status', 'Selesai')->count();
        $statusDibatalkan = Booking::where('status', 'Dibatalkan')->count();

        // 4. Mengambil 5 pemesanan terbaru untuk list sebelah kanan
        $pemesananTerbaru = Booking::latest()->take(5)->get();

        // Oper semua variabel ke view admin.dashboard
        return view('admin.dashboard', compact(
            'totalJadwal', 
            'totalPemesanan', 
            'totalUser', 
            'totalPendapatan',
            'statusMenunggu',
            'statusSelesai',
            'statusDibatalkan',
            'pemesananTerbaru'
        ));
    }
}