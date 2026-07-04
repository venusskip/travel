<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;

class TravelScheduleController extends Controller
{
    // Fungsi index untuk menampilkan semua daftar jadwal (Sudah Anda buat sebelumnya)
    public function index(Request $request)
    {
        $kotaAsal = Route::distinct()->pluck('kota_asal');
        $kotaTujuan = Route::distinct()->pluck('kota_tujuan');
        $layanan = TravelSchedule::distinct()->pluck('jenis_layanan');

        $query = TravelSchedule::where('aktif', true);

        if ($request->has('asal') && $request->asal != '') {
            $query->where('kota_asal', $request->asal);
        }

        if ($request->has('tujuan') && $request->tujuan != '') {
            $query->where('kota_tujuan', $request->tujuan);
        }

        if ($request->has('layanan') && $request->layanan != '') {
            $query->where('jenis_layanan', $request->layanan);
        }

        // PERBAIKAN BARU: Filter Berdasarkan Tanggal Berangkat
    if ($request->has('tanggal') && $request->tanggal != '') {
        $query->whereDate('tanggal_berangkat', $request->tanggal);
    }

    // PERBAIKAN BARU: Filter Berdasarkan Harga Maksimal (Mencari yang di bawah atau sama dengan harga input)
    if ($request->has('harga_maks') && $request->harga_maks != '') {
        $query->where('harga', '<=', $request->harga_maks);
    }

        $jadwals = $query->latest()->get();

        return view('jadwaltravel', compact('kotaAsal', 'kotaTujuan', 'layanan', 'jadwals'));
    }

    // ========================================================
    // PERBAIKAN: Tambahkan Fungsi show() ini di bawah fungsi index
    // ========================================================
    public function show($id)
    {
        // Mencari jadwal berdasarkan ID, jika tidak ada akan otomatis melempar error 404
        $jadwal = TravelSchedule::findOrFail($id);

        // Mengembalikan halaman detailtravel sambil mengirimkan data jadwal tunggal
        return view('detailtravel', compact('jadwal'));
    }
}