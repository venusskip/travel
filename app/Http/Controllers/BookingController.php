<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Halaman List Pemesanan Admin
    public function index(Request $request)
    {
        $query = Booking::latest();

        // Fitur Filter Status dari Dropdown Admin
        if ($request->has('filter_status') && $request->filter_status != 'semua') {
            $query->where('status', $request->filter_status);
        }

        $bookings = $query->get();
        $totalJadwal = $bookings->count(); // Mengikuti variabel hitung di desainmu

        return view('admin.pemesanan', compact('bookings', 'totalJadwal'));
    }

    // Logika Sisi User: Proses Menyimpan Form Checkout Temanmu
    public function storeCheckout(Request $request)
    {
        // Validasi input (Aturan 4.2 Tugas Besar)
        $request->validate([
            'payment_method' => 'required'
        ], [
            'payment_method.required' => 'Silakan pilih metode pembayaran terlebih dahulu!'
        ]);

        // Logika Status Otomatis sesuai permintaanmu
        // Jika memilih selain 'Bayar di Tempat' (artinya memilih Bank/E-Wallet), status langsung 'Selesai'
        $statusAwal = ($request->payment_method === 'Bayar di Tempat') ? 'Menunggu Pembayaran' : 'Selesai';

        Booking::create([
            'created_by_id'     => Auth::id() ?? 1, // Menggunakan ID user login, default ke 1 jika belum auth
            'id_jadwal'         => 'SCH-SAMPLE', // Sementara dummy, nanti integrasikan dengan ID jadwal asli
            'nama_travel'       => 'Buton bus',
            'kota_asal'         => 'Baubau',
            'kota_tujuan'       => 'Kendari',
            'tanggal_berangkat' => '2026-07-02',
            'jam_berangkat'     => '22:59',
            'jumlah_tiket'      => 1,
            'kursi_dipilih'     => [12],
            'harga_per_tiket'   => 50000,
            'total_harga'       => 50000,
            'nama_penumpang'    => 'Rahmat Dhani',
            'telepon_penumpang' => '02190190193',
            'email_penumpang'   => 'rahmatdhaniii38@gmail.com',
            'alamat_penumpang'  => 'Jl. Alamat Rumah',
            'metode_pembayaran' => $request->payment_method,
            'status'            => $statusAwal,
        ]);

        return redirect()->back()->with('success', 'Pemesanan berhasil diproses!');
    }

    // Logika Sisi Admin: Update Status Instan Lewat Dropdown Tabel (AJAX/Form)
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Status berhasil diperbarui!']);
    }
}