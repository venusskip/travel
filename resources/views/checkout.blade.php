<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelKu - Checkout</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex flex-col min-h-screen font-sans">

    <!-- Memanggil Navbar -->
    @include('layouts.navbar') 

    <!-- KONTEN UTAMA CHECKOUT -->
    <main class="flex-grow max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#0f172a] tracking-tight">Checkout</h1>
        <p class="text-sm text-gray-500 mt-1">Lengkapi data untuk menyelesaikan pemesanan</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-600 text-xs p-3 rounded-xl font-medium">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-sm font-bold text-slate-800 tracking-wide mb-4">Data Pemesan</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-600">Nama Lengkap *</label>
                            <input type="text" name="nama_penumpang" value="{{ $user->name }}" required
                                class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-600">No HP *</label>
                            <input type="text" name="telepon_penumpang" placeholder="Contoh: 0812345678" required
                                class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-600">Email *</label>
                            <input type="email" name="email_penumpang" value="{{ $user->email }}" required
                                class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-600">Alamat</label>
                            <input type="text" name="alamat_penumpang" placeholder="Masukkan alamat lengkap"
                                class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-sm font-bold text-slate-800 tracking-wide mb-4">Metode Pembayaran *</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" value="Transfer Bank BRI" class="text-blue-600 focus:ring-blue-500" required>
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">🏛️ Transfer Bank BRI</span>
                        </label>
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" value="Transfer Bank BNI" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">🏛️ Transfer Bank BNI</span>
                        </label>
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" value="Transfer Bank Mandiri" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">🏛️ Transfer Bank Mandiri</span>
                        </label>
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" value="Transfer Bank BCA" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">🏛️ Transfer Bank BCA</span>
                        </label>
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" value="OVO" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">💳 OVO</span>
                        </label>
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" value="GoPay" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">💳 GoPay</span>
                        </label>
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" value="DANA" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">💳 DANA</span>
                        </label>
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" value="Bayar di Tempat" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">💵 Bayar di Tempat</span>
                        </label>
                    </div>
                </div>

            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm sticky top-24">
    <h3 class="text-sm font-bold text-slate-800 tracking-wide mb-4">Ringkasan Pesanan</h3>
    
    <div class="space-y-4 mb-6 max-h-60 overflow-y-auto divide-y divide-gray-50">
        @foreach($cartItems as $item)
        <div class="space-y-1 text-gray-500 pt-3 first:pt-0">
            <p class="text-xs font-bold text-slate-800">{{ $item->nama_travel }}</p>
            <p class="text-[11px] text-gray-400">{{ $item->kota_asal }} &rarr; {{ $item->kota_tujuan }}</p>
            <p class="text-[11px] text-gray-400">
                {{ $item->tanggal_berangkat->format('d M Y') }} &bull; {{ $item->jam_berangkat }} 
                <br>
                <span class="text-[10px] bg-gray-100 px-1.5 py-0.5 rounded text-gray-600">Kursi: {{ implode(', ', $item->kursi_dipilih) }}</span>
            </p>
            <div class="flex justify-between items-center text-xs pt-1">
                <span>{{ $item->jumlah_tiket }} tiket</span>
                <span class="font-medium text-slate-700">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <div class="border-t border-gray-100 pt-4 mb-6 flex justify-between items-center">
        <span class="text-sm font-bold text-slate-800">Total</span>
        <span class="text-base font-bold text-blue-600 tracking-wide">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
    </div>

    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-3.5 px-4 rounded-xl shadow-md shadow-orange-500/10 transition tracking-wide">
        Pesan Sekarang
    </button>
</div>

        </div>
    </form>
</main>

    <!-- Memanggil Footer -->
    @include('layouts.footer')

</body>
</html>