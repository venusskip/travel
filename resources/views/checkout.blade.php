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
        
        <!-- Judul Halaman -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#0f172a] tracking-tight">Checkout</h1>
            <p class="text-sm text-gray-500 mt-1">Lengkapi data untuk menyelesaikan pemesanan</p>
        </div>

        <!-- Grid Layout: Kiri (Data & Metode), Kanan (Ringkasan) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- SISI KIRI: DATA PEMESAN & METODE PEMBAYARAN -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- 1. KARTU DATA PEMESAN -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-sm font-bold text-slate-800 tracking-wide mb-4">Data Pemesan</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama Lengkap -->
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-600">Nama Lengkap *</label>
                            <input type="text" value="Rahmat Dhani" disabled
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none">
                        </div>
                        <!-- No HP -->
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-600">No HP *</label>
                            <input type="text" placeholder="" disabled
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none">
                        </div>
                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-600">Email *</label>
                            <input type="email" value="rahmatdhaniii38@gmail.com" disabled
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none">
                        </div>
                        <!-- Alamat -->
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-600">Alamat</label>
                            <input type="text" placeholder="" disabled
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- 2. KARTU METODE PEMBAYARAN -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-sm font-bold text-slate-800 tracking-wide mb-4">Metode Pembayaran *</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <!-- Transfer Bank BRI -->
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                🏛️ Transfer Bank BRI
                            </span>
                        </label>
                        <!-- Transfer Bank BNI -->
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                🏛️ Transfer Bank BNI
                            </span>
                        </label>
                        <!-- Transfer Bank Mandiri -->
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                🏛️ Transfer Bank Mandiri
                            </span>
                        </label>
                        <!-- Transfer Bank BCA -->
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                🏛️ Transfer Bank BCA
                            </span>
                        </label>
                        <!-- OVO -->
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                💳 OVO
                            </span>
                        </label>
                        <!-- GoPay -->
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                💳 GoPay
                            </span>
                        </label>
                        <!-- DANA -->
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                💳 DANA
                            </span>
                        </label>
                        <!-- Bayar di Tempat -->
                        <label class="flex items-center gap-3 border border-gray-200 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                💵 Bayar di Tempat
                            </span>
                        </label>
                    </div>
                </div>

            </div>

            <!-- SISI KANAN: RINGKASAN PESANAN -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-slate-800 tracking-wide mb-4">Ringkasan Pesanan</h3>
                
                <!-- Detail Item Perjalanan -->
                <div class="space-y-1 text-gray-500 mb-6">
                    <p class="text-xs font-bold text-slate-800">Buton bus</p>
                    <p class="text-[11px] text-gray-400">Baubau &rarr; Kendari</p>
                    <p class="text-[11px] text-gray-400">2026-07-02 &bull; 22:59</p>
                    <div class="flex justify-between items-center text-xs pt-1">
                        <span>1 tiket</span>
                        <span class="font-medium text-slate-700">Rp 50.000</span>
                    </div>
                </div>

                <!-- Total Harga -->
                <div class="border-t border-gray-100 pt-4 mb-6 flex justify-between items-center">
                    <span class="text-sm font-bold text-slate-800">Total</span>
                    <span class="text-base font-bold text-blue-600 tracking-wide">Rp 50.000</span>
                </div>

                <!-- Tombol Pesan Sekarang -->
                <button class="w-full bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-3.5 px-4 rounded-xl shadow-md shadow-orange-500/10 transition tracking-wide">
                    Pesan Sekarang
                </button>
            </div>

        </div>
    </main>

    <!-- Memanggil Footer -->
    @include('layouts.footer')

</body>
</html>