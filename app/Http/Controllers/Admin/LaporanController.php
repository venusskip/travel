<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil input filter tanggal (jika ada)
        $dariTanggal = $request->input('dari_tanggal');
        $sampaiTanggal = $request->input('sampai_tanggal');

        // Base query dari data Booking
        $query = Booking::query();

        // Terapkan filter jika user memilih tanggal
        if ($dariTanggal) {
            $query->whereDate('tanggal_berangkat', '>=', $dariTanggal);
        }
        if ($sampaiTanggal) {
            $query->whereDate('tanggal_berangkat', '<=', $sampaiTanggal);
        }

        // Ambil semua data sesuai filter
        $bookings = $query->latest()->get();

        // 2. Kalkulasi statistik untuk Card Atas
        $totalPemesanan = $bookings->count();
        $totalPendapatan = $bookings->where('status', 'Selesai')->sum('total_harga'); // Hanya status 'Selesai' yang dihitung pendapatan nyata
        $totalPenumpang = $bookings->sum('jumlah_tiket');

            // 3. Logika Grafik Pendapatan per Bulan (Chart Batang)
        // Mengelompokkan pendapatan berdasarkan bulan dalam rentang filter / tahun ini
        $grafikPendapatan = Booking::select(
            DB::raw("DATE_FORMAT(tanggal_berangkat, '%b %y') as bulan"),
            DB::raw("SUM(total_harga) as total")
        )
        ->where('status', 'Selesai')
        ->when($dariTanggal, function($q) use ($dariTanggal) {
            return $q->whereDate('tanggal_berangkat', '>=', $dariTanggal);
        })
        ->when($sampaiTanggal, function($q) use ($sampaiTanggal) {
            return $q->whereDate('tanggal_berangkat', '<=', $sampaiTanggal);
        })
        ->groupBy(DB::raw("DATE_FORMAT(tanggal_berangkat, '%b %y')")) // Disesuaikan agar full group by aman
        ->orderBy(DB::raw("MIN(tanggal_berangkat)"), 'asc') // Menggunakan MIN() agar lolos validasi MySQL
        ->get();

        

        $chartLabels = $grafikPendapatan->pluck('bulan')->toArray();
        $chartData = $grafikPendapatan->pluck('total')->toArray();

        // Jika data kosong, berikan default agar chart tidak error
        if (empty($chartLabels)) {
            $chartLabels = [Carbon::now()->format('M y')];
            $chartData = [0];
        }

        // 4. Logika Grafik Distribusi Status (Chart Pie)
        $distribusiStatus = $bookings->groupBy('status')->map(function ($item) {
            return $item->count();
        });

        $pieLabels = [];
        $pieData = [];
        $totalStatus = $distribusiStatus->sum();

        foreach ($distribusiStatus as $status => $count) {
            $persentase = $totalStatus > 0 ? round(($count / $totalStatus) * 100) : 0;
            $pieLabels[] = $status . " " . $persentase . "%";
            $pieData[] = $count;
        }

        // Tampilan default jika pie kosong
        if (empty($pieData)) {
            $pieLabels = ['Tidak Ada Data'];
            $pieData = [1];
        }

        return view('admin.laporan', compact(
            'bookings', 
            'totalPemesanan', 
            'totalPendapatan', 
            'totalPenumpang',
            'chartLabels',
            'chartData',
            'pieLabels',
            'pieData',
            'dariTanggal',
            'sampaiTanggal'
        ));
    }
}