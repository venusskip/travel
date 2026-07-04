<?php

namespace App\Http\Controllers;

use App\Models\TravelSchedule;
use App\Models\Booking;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // 1. Tampilkan Halaman Checkout dengan data Pengguna DAN data Keranjang asli
    public function showCheckout()
    {
        $user = Auth::user();
        
        // Ambil semua item yang ada di keranjang user saat ini
        $cartItems = CartItem::where('created_by_id', $user->id)->latest()->get();
        
        // Jika keranjang kosong, kembalikan ke halaman keranjang dengan peringatan
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('errors', 'Keranjang Anda kosong, silakan pilih jadwal terlebih dahulu.');
        }

        // Hitung total harga keseluruhan dari keranjang belanja
        $grandTotal = $cartItems->sum('total_harga');

        return view('checkout', compact('user', 'cartItems', 'grandTotal'));
    }

    // 2. Proses Menyimpan Form Checkout Dinamis
    public function storeCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'nama_penumpang' => 'required|string|max:255',
            'telepon_penumpang' => 'required|string',
            'email_penumpang' => 'required|email'
        ], [
            'payment_method.required' => 'Silakan pilih metode pembayaran terlebih dahulu!',
        ]);

        $user = Auth::user();
        $cartItems = CartItem::where('created_by_id', $user->id)->get();

        $statusAwal = ($request->payment_method === 'Bayar di Tempat') ? 'Menunggu Pembayaran' : 'Selesai';

        foreach ($cartItems as $item) {
            // Cari data jadwal aslinya
            $jadwal = TravelSchedule::find($item->id_jadwal);
            
            if ($jadwal) {
                // Ambil data kursi terpesan saat ini (default array kosong jika null)
                $currentSeats = $jadwal->kursi_terpesan ?? [];
                
                // Gabungkan kursi lama dengan kursi baru dari keranjang belanja
                $updatedSeats = array_merge($currentSeats, $item->kursi_dipilih);
                
                // Hilangkan duplikasi angka jika ada, lalu urutkan nomornya
                $updatedSeats = array_unique($updatedSeats);
                sort($updatedSeats);

                // Update data ke tabel travel_schedules
                $jadwal->update([
                    'kursi_terpesan' => $updatedSeats,
                    'kursi_terisi' => count($updatedSeats)
                ]);
            }

            // Simpan data transaksi booking
            Booking::create([
                'created_by_id'     => $user->id, 
                'id_jadwal'         => $item->id_jadwal, // Kolom relasi jadwal Anda adalah id_jadwal
                'nama_travel'       => $item->nama_travel,
                'kota_asal'         => $item->kota_asal,
                'kota_tujuan'       => $item->kota_tujuan,
                'tanggal_berangkat' => $item->tanggal_berangkat,
                'jam_berangkat'     => $item->jam_berangkat,
                'jumlah_tiket'      => $item->jumlah_tiket,
                'kursi_dipilih'     => $item->kursi_dipilih,
                'harga_per_tiket'   => $item->harga_per_tiket,
                'total_harga'       => $item->total_harga,
                'nama_penumpang'    => $request->nama_penumpang,
                'telepon_penumpang' => $request->telepon_penumpang,
                'email_penumpang'   => $request->email_penumpang,
                'alamat_penumpang'  => $request->alamat_penumpang,
                'metode_pembayaran' => $request->payment_method,
                'status'            => $statusAwal,
                'jenis_layanan'     => $item->jenis_layanan
            ]);
            
            // Hapus item dari keranjang belanja
            $item->delete();
        }

        return redirect()->route('riwayat')->with('success', 'Pemesanan tiket Anda berhasil diproses!');
    }

    // 3. Tampilan Manajemen Pemesanan Sisi Admin
    public function index(Request $request)
    {
        $statusFilter = $request->query('filter_status', 'semua');
        $query = Booking::query();

        if ($statusFilter !== 'semua') {
            $query->where('status', $statusFilter);
        }

        $bookings = $query->latest()->get();
        $totalJadwal = $bookings->count();

        return view('admin.pemesanan', compact('bookings', 'totalJadwal'));
    }

    // 4. Update Status Pemesanan via Fetch API Admin
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Pembayaran,Selesai,Dibatalkan'
        ]);

        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Data pemesanan tidak ditemukan.'], 404);
        }

        $booking->status = $request->status;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Status pemesanan berhasil diperbarui menjadi ' . $request->status
        ], 200);
    }

    // 5. Riwayat Pemesanan Sisi User
    public function riwayatUser()
    {
        $bookings = Booking::where('created_by_id', Auth::id())->latest()->get();
        return view('riwayat', compact('bookings'));
    }

    // 6. FUNGSI BARU: Hapus Transaksi Admin & Kosongkan Kursi Kembali
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        // Cari jadwal travel menggunakan kolom 'id_jadwal' (disesuaikan dengan skema Anda)
        $jadwal = TravelSchedule::find($booking->id_jadwal);

        if ($jadwal) {
            // Ambil array nomor kursi dari pesanan yang mau dihapus ini
            $kursiDipilih = is_array($booking->kursi_dipilih) ? $booking->kursi_dipilih : json_decode($booking->kursi_dipilih, true) ?? [];
            
            // Ambil array seluruh kursi terpesan yang ada di jadwal saat ini
            $kursiTerpesanSekarang = is_array($jadwal->kursi_terpesan) ? $jadwal->kursi_terpesan : json_decode($jadwal->kursi_terpesan, true) ?? [];

            if (!empty($kursiDipilih)) {
                // Buang nomor kursi yang dibatalkan/dihapus dari daftar kursi terpesan
                $kursiTerupdate = array_diff($kursiTerpesanSekarang, $kursiDipilih);
                $kursiTerupdate = array_values($kursiTerupdate); // Reset index array

                // Simpan perubahan ke database jadwal travel
                $jadwal->update([
                    'kursi_terpesan' => $kursiTerupdate,
                    'kursi_terisi' => max(0, count($kursiTerupdate))
                ]);
            }
        }

        // Hapus data booking (Otomatis menghilangkan riwayat di user)
        $booking->delete();

        return redirect()->back()->with('success', 'Pemesanan berhasil dihapus dan status kursi telah dikosongkan kembali!');
    }
}