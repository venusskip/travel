<?php

namespace App\Http\Controllers;

use App\Models\TravelSchedule;
use App\Models\Route; // Pastikan model Route kamu sudah ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalController extends Controller
{
    // Menampilkan halaman utama jadwal
    public function index()
    {
        $jadwals = TravelSchedule::latest()->get();
        $rutes = Route::all(); // Untuk pilihan dropdown rute di modal tambah/edit
        $totalJadwal = $jadwals->count();

        return view('admin.jadwal', compact('jadwals', 'rutes', 'totalJadwal'));
    }

    // Menyimpan data jadwal baru
    public function store(Request $request)
    {
      
        // 4.2 Validasi Input
        $request->validate([
            'id_rute' => 'required',
            'nama_travel' => 'required|string|max:255',
            'jenis_layanan' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'jam_berangkat' => 'required',
            'harga' => 'required|numeric',
            'total_kursi' => 'required|numeric',
            'foto_kendaraan' => 'nullable|image|mimes:jpeg,png,jpg|max:102048',
            'deskripsi' => 'nullable|string',
        ]);

        // Ambil data kota asal dan tujuan dari rute terpilih otomatis
        $rute = Route::findOrFail($request->id_rute);

        $data = $request->all();
        $data['kota_asal'] = $rute->kota_asal;
        $data['kota_tujuan'] = $rute->kota_tujuan;
        $data['kursi_terpesan'] = []; // default kosong awal pembuatan

        // 4.4 Fitur upload image jika ada berkas masuk
        if ($request->hasFile('foto_kendaraan')) {
            $data['foto_kendaraan'] = $request->file('foto_kendaraan')->store('kendaraan', 'public');
        }

        TravelSchedule::create($data);

        // 4.3 Notifikasi sukses
        return redirect()->back()->with('success', 'Jadwal travel berhasil ditambahkan!');
    }

    // Memperbarui data jadwal
    public function update(Request $request, $id)
    {
        $jadwal = TravelSchedule::findOrFail($id);

        $request->validate([
            'id_rute' => 'required',
            'nama_travel' => 'required|string|max:255',
            'jenis_layanan' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'jam_berangkat' => 'required',
            'harga' => 'required|numeric',
            'total_kursi' => 'required|numeric',
            'foto_kendaraan' => 'nullable|image|mimes:jpeg,png,jpg|max:102048',
            'deskripsi' => 'nullable|string',
        ]);

        $rute = Route::findOrFail($request->id_rute);
        $data = $request->all();
        $data['kota_asal'] = $rute->kota_asal;
        $data['kota_tujuan'] = $rute->kota_tujuan;

        if ($request->hasFile('foto_kendaraan')) {
            // Hapus foto lama jika ada
            if ($jadwal->foto_kendaraan) {
                Storage::disk('public')->delete($jadwal->foto_kendaraan);
            }
            $data['foto_kendaraan'] = $request->file('foto_kendaraan')->store('kendaraan', 'public');
        }

        $jadwal->update($data);

        return redirect()->back()->with('success', 'Jadwal travel berhasil diperbarui!');
    }

    // Menghapus data jadwal
    public function destroy($id)
    {
        $jadwal = TravelSchedule::findOrFail($id);
        
        if ($jadwal->foto_kendaraan) {
            Storage::disk('public')->delete($jadwal->foto_kendaraan);
        }
        
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal travel berhasil dihapus!');
    }
}