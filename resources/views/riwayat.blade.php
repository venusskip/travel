<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelKu - Riwayat Pemesanan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex flex-col min-h-screen font-sans">

    @include('layouts.navbar') 

    <main class="flex-grow max-w-4xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#0f172a] tracking-tight">Riwayat Pemesanan</h1>
        <p class="text-sm text-gray-500 mt-1">Daftar semua pemesanan tiket Anda</p>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm w-full">
        <div class="flex flex-col gap-4">
            
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3">
                <div class="space-y-1.5">
                    <div class="flex items-center gap-3">
                        <h3 class="text-lg font-bold text-slate-800 tracking-wide">Express Sultra</h3>
                        <span class="bg-blue-50 text-blue-600 text-[10px] font-semibold px-2.5 py-0.5 rounded-md border border-blue-100">
                            Travel Antar Kota
                        </span>
                    </div>
                    <p class="text-[11px] text-gray-400 font-mono tracking-wider">#TRVMQXH2Y7ANVX</p>
                </div>
                
                <div class="flex sm:justify-end items-start min-w-[150px]">
                <span class="bg-[#fefce8] text-[#a16207] text-[11px] font-medium px-3 py-1 rounded-full border border-[#fef08a] whitespace-nowrap">
                    Menunggu Pembayaran
                </span>
            </div>
            </div>

            

            <div class="flex flex-row justify-between items-center gap-4 text-xs text-slate-500 pt-2 w-full flex-wrap sm:flex-nowrap">
                
                <div class="flex items-center gap-2 flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-gray-500 font-medium">Baubau &rarr; Kendari</span>
                </div>
                
                <div class="flex items-center gap-2 flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-gray-500 font-medium">20 Jul 2025</span>
                </div>
                
                <div class="flex items-center gap-2 flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-gray-500 font-medium">06:00</span>
                </div>
                
                <div class="flex items-center gap-2 flex-shrink-0 min-w-[150px] sm:justify-end">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                    <span class="text-gray-500 font-medium">1 tiket</span>
                </div>
            </div>

            <div class="pt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-t border-gray-100 mt-2">
                <div class="flex items-center gap-2 text-xs text-gray-400">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    <span>Transfer Bank BRI</span>
                </div>

                <span class="text-xl font-bold text-blue-600 tracking-wide">
                    Rp 250.000
                </span>
            </div>

        </div>
    </div>
</main>

    @include('layouts.footer')

</body>
</html>