<?php

namespace App\Http\Controllers;

use App\Models\TravelSchedule;
use App\Models\Booking;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

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

    // Tambahkan Method Baru Ini di dalam BookingController
public function directCheckout(Request $request)
{
    $request->validate([
        'id_jadwal' => 'required',
        'kursi_dipilih' => 'required|array|min:1',
    ], [
        'kursi_dipilih.required' => 'Anda harus memilih minimal 1 kursi sebelum melakukan pembelian langsung.',
    ]);

    $userId = Auth::id();
    $jadwal = TravelSchedule::findOrFail($request->id_jadwal);
    
    // --- VALIDASI: Cek apakah ada kursi pilihan yang sudah terisi di database ---
    $kursiTerpesan = $jadwal->kursi_terpesan ?? [];
    foreach ($request->kursi_dipilih as $kursi) {
        if (in_array($kursi, $kursiTerpesan)) {
            return redirect()->back()->withErrors(['kursi_error' => "Kursi nomor $kursi sudah dipesan oleh orang lain. Silakan pilih kursi lain!"]);
        }
    }

    // --- PROSES KERANJANG DI BALIK LAYAR ---
    // Cek dulu apakah item dengan jadwal ini sudah ada di keranjang user
    $existingCart = CartItem::where('created_by_id', $userId)
                            ->where('id_jadwal', $jadwal->id)
                            ->first();

    $jumlahTiket = count($request->kursi_dipilih);
    $totalHarga = $jadwal->harga * $jumlahTiket;

    if ($existingCart) {
        // Jika sudah ada, timpa data kursi lama dengan data kursi pilihan baru
        $existingCart->update([
            'kursi_dipilih' => $request->kursi_dipilih,
            'jumlah_tiket' => $jumlahTiket,
            'total_harga' => $totalHarga,
        ]);
    } else {
        // Jika belum ada, buat item keranjang baru
        CartItem::create([
            'created_by_id' => $userId,
            'id_jadwal' => $jadwal->id,
            'nama_travel' => $jadwal->nama_travel,
            'kota_asal' => $jadwal->kota_asal,
            'kota_tujuan' => $jadwal->kota_tujuan,
            'tanggal_berangkat' => $jadwal->tanggal_berangkat,
            'jam_berangkat' => $jadwal->jam_berangkat,
            'jumlah_tiket' => $jumlahTiket,
            'kursi_dipilih' => $request->kursi_dipilih,
            'harga_per_tiket' => $jadwal->harga,
            'total_harga' => $totalHarga,
            'jenis_layanan' => $jadwal->jenis_layanan,
        ]);
    }

    // Alihkan langsung ke halaman checkout asli milikmu
    return redirect()->route('checkout')->with('success', 'Silakan lengkapi data pemesanan Anda.');
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

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->withErrors(['cart_empty' => 'Keranjang Anda kosong!']);
    }

    $statusAwal = ($request->payment_method === 'Bayar di Tempat') ? 'Menunggu Pembayaran' : 'Selesai';

    // Gunakan Database Transaction agar data konsisten jika terjadi error di tengah jalan
    try {
        DB::beginTransaction();

        foreach ($cartItems as $item) {
            // Gunakan lockForUpdate() agar record jadwal ini dikunci sementara sampai proses verifikasi selesai
            $jadwal = TravelSchedule::where('id', $item->id_jadwal)->lockForUpdate()->first();
            
            if ($jadwal) {
                // 1. AMBIL KURSI YANG SUDAH TERPESAN DI DATABASE
                $kursiTerpesan = $jadwal->kursi_terpesan ?? [];
                
                // 2. CEK APAKAH ADA KURSI DI KERANJANG USER YANG SUDAH TERISI
                $kursiBentrokan = array_intersect($item->kursi_dipilih, $kursiTerpesan);
                
                if (!empty($kursiBentrokan)) {
                    // Batalkan transaksi dan kembalikan ke keranjang dengan pesan error
                    DB::rollBack();
                    $nomorBentrokan = implode(', ', $kursiBentrokan);
                    return redirect()->route('cart.index')->withErrors([
                        'kursi_habis' => "Gagal Checkout! Kursi nomor ($nomorBentrokan) pada perjalanan {$jadwal->nama_travel} baru saja dipesan oleh orang lain beberapa saat yang lalu. Silakan hapus item tersebut atau pilih kursi lain."
                    ]);
                }

                // 3. JIKA AMAN, GABUNGKAN SEPERTI BIASA
                $updatedSeats = array_merge($kursiTerpesan, $item->kursi_dipilih);
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
                'id_jadwal'         => $item->id_jadwal,
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

        DB::commit();
        return redirect()->route('riwayat')->with('success', 'Pemesanan tiket Anda berhasil diproses!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('cart.index')->withErrors(['system_error' => 'Terjadi kesalahan sistem saat memproses pesanan Anda: ' . $e->getMessage()]);
    }
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

    // Fungsi untuk cetak PDF Tiket
public function cetakTiket($id)
{
    $booking = Booking::findOrFail($id);

    if ($booking->status !== 'Selesai') {
        return redirect()->back()->with('errors', 'Tiket belum lunas atau tidak dapat dicetak.');
    }

    // URL unik untuk di-scan supir
    $scanUrl = route('booking.scan', $booking->id);
    
    // QR Code menggunakan Google API (Aman dijalankan di browser)
    $qrcodeUrl = "https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=" . urlencode($scanUrl) . "&choe=UTF-8";

    // Kita return sebagai view HTML biasa, bukan PDF!
    return view('ticket_print', compact('booking', 'qrcodeUrl'));
}
// Fungsi untuk Validasi Scan QR Code oleh Supir
public function scanTiket($id)
{
    $booking = Booking::findOrFail($id);

    // Cek jika status tiket belum lunas
    if ($booking->status !== 'Selesai') {
        $pesan = "Tiket Gagal Validasi! Pembayaran belum lunas.";
        $tipe = "error";
    } 
    // Cek jika sudah pernah di-scan sebelumnya
    elseif ($booking->is_checked_in) {
        $pesan = "PERINGATAN! Tiket dengan kode #{$booking->kode_pemesanan} SUDAH PERNAH DIGUNAKAN sebelumnya.";
        $tipe = "warning";
    } 
    // Jika valid dan baru pertama kali scan
    else {
        $booking->update(['is_checked_in' => true]);
        $pesan = "Tiket BERHASIL Diverifikasi! Penumpang atas nama {$booking->nama_penumpang} silahkan naik ke mobil.";
        $tipe = "success";
    }

    return view('scan_result', compact('booking', 'pesan', 'tipe'));
}
}