<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - TravelKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] flex min-h-screen font-sans">

    @include('partials.sidebar')

    <main class="flex-1 p-8">
        <h1 class="text-xl font-semibold text-gray-800 mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-2">Total Jadwal</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalJadwal }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-xl text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-2">Total Pemesanan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPemesanan }}</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-xl text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-2">Total User</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalUser }}</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-xl text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-2">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-xl text-purple-600">
                    <span class="text-xl font-bold">$</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 md:col-span-5">
                <h2 class="text-base font-bold text-gray-800 mb-4">Status Pemesanan</h2>
                <div class="space-y-4 text-sm">
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500 w-1/3">Menunggu Pembayaran</span>
                        <div class="w-1/2 bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-blue-500 h-full" style="width: {{ $totalPemesanan > 0 ? ($statusMenunggu / $totalPemesanan) * 180 : 0 }}%"></div>
                        </div>
                        <span class="font-semibold text-gray-800 w-6 text-right">{{ $statusMenunggu }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-gray-500 w-1/3">Selesai</span>
                        <div class="w-1/2 bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-emerald-500 h-full" style="width: {{ $totalPemesanan > 0 ? ($statusSelesai / $totalPemesanan) * 180 : 0 }}%"></div>
                        </div>
                        <span class="font-semibold text-gray-800 w-6 text-right">{{ $statusSelesai }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-gray-500 w-1/3">Dibatalkan</span>
                        <div class="w-1/2 bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-red-500 h-full" style="width: {{ $totalPemesanan > 0 ? ($statusDibatalkan / $totalPemesanan) * 180 : 0 }}%"></div>
                        </div>
                        <span class="font-semibold text-gray-800 w-6 text-right">{{ $statusDibatalkan }}</span>
                    </div>

                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 md:col-span-7">
                <h2 class="text-base font-bold text-gray-800 mb-4">Pemesanan Terbaru</h2>
                <div class="space-y-4">
                    @forelse($pemesananTerbaru as $baru)
                    <div class="flex justify-between items-start border-b border-gray-50 pb-4 last:border-0 last:pb-0">
                        <div>
                            <h3 class="font-bold text-gray-800 text-sm">{{ $baru->nama_penumpang }}</h3>
                            <p class="text-xs text-gray-400 mt-1">{{ $baru->kota_asal }} → {{ $baru->kota_tujuan }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-blue-600 block">Rp {{ number_format($baru->total_harga, 0, ',', '.') }}</span>
                            <span class="text-xs @if($baru->status === 'Selesai') text-emerald-500 @elif($baru->status === 'Dibatalkan') text-red-500 @else text-gray-400 @endif">{{ $baru->status }}</span>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-400 text-center py-4">Belum ada riwayat transaksi pemesanan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

</body>
</html>