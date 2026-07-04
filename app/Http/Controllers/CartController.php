<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilan halaman keranjang
    public function index()
    {
        // Mengambil data keranjang milik user yang sedang login (Breeze Auth)
        $cartItems = CartItem::where('created_by_id', Auth::id())->latest()->get();
        
        // Menghitung total harga keseluruhan di keranjang
        $grandTotal = $cartItems->sum('total_harga');

        return view('keranjang', compact('cartItems', 'grandTotal'));
    }

    // Aksi menekan tombol "Tambah ke Keranjang" dari detailtravel
    // app/Http/Controllers/CartController.php

public function store(Request $request)
{
    $request->validate([
        'id_jadwal' => 'required',
        'kursi_dipilih' => 'required|array|min:1',
    ], [
        'kursi_dipilih.required' => 'Anda harus memilih minimal 1 kursi sebelum menambahkan ke keranjang.',
    ]);

    $jadwal = TravelSchedule::findOrFail($request->id_jadwal);
    
    // --- VALIDASI TAMBAHAN: Cek apakah ada kursi pilihan yang sudah terisi di database ---
    $kursiTerpesan = $jadwal->kursi_terpesan ?? [];
    foreach ($request->kursi_dipilih as $kursi) {
        if (in_array($kursi, $kursiTerpesan)) {
            return redirect()->back()->withErrors(['kursi_error' => "Kursi nomor $kursi sudah dipesan oleh orang lain. Silakan pilih kursi lain!"]);
        }
    }
    // -----------------------------------------------------------------------------------

    $jumlahTiket = count($request->kursi_dipilih);
    $totalHarga = $jadwal->harga * $jumlahTiket;

    CartItem::create([
        'created_by_id' => Auth::id(),
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

    return redirect()->route('cart.index')->with('success', 'Jadwal travel berhasil ditambahkan ke keranjang belanja Anda!');
}

    // Aksi menghapus item dari keranjang
    public function destroy($id)
    {
        $cartItem = CartItem::where('created_by_id', Auth::id())->where('id', $id)->firstOrFail();
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}