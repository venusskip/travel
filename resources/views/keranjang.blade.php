<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelKu - Keranjang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex flex-col min-h-screen font-sans">

    @include('layouts.navbar') 

    <main class="flex-grow max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#0f172a] tracking-tight">Keranjang</h1>
            <p class="text-sm text-gray-500 mt-1">1 item di keranjang Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <div class="flex flex-col space-y-4">
                    
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-base font-bold text-slate-800 tracking-wide">Airport Shuttle</h3>
                            <span class="inline-block bg-blue-50 text-blue-600 text-[10px] font-semibold px-2 py-0.5 rounded-md border border-blue-100 mt-1">
                                Travel Bandara
                            </span>
                        </div>
                        <button class="text-red-400 hover:text-red-500 p-1 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-16v4M4 7h16"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex flex-wrap items-center gap-x-8 gap-y-2 text-xs text-slate-500 pt-1">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Baubau &rarr; Batauga</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>2025-07-24</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>04:30</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 mt-2 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <button class="w-7 h-7 bg-gray-50 border border-gray-200 text-gray-500 rounded-lg flex items-center justify-center hover:bg-gray-100 font-medium text-sm">-</button>
                            <span class="text-sm font-bold text-slate-800 font-mono">1</span>
                            <button class="w-7 h-7 bg-gray-50 border border-gray-200 text-gray-500 rounded-lg flex items-center justify-center hover:bg-gray-100 font-medium text-sm">+</button>
                            <span class="text-xs text-gray-400 ml-1">tiket</span>
                        </div>
                        <div class="text-lg font-bold text-blue-600 tracking-wide">
                            Rp 75.000
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-slate-800 tracking-wide mb-4">Ringkasan Pesanan</h3>
                
                <div class="flex justify-between items-center text-xs text-gray-500 mb-6">
                    <span>Airport Shuttle x1</span>
                    <span class="font-medium text-slate-700">Rp 75.000</span>
                </div>

                <div class="border-t border-gray-100 pt-4 mb-6 flex justify-between items-center">
                    <span class="text-sm font-bold text-slate-800">Total</span>
                    <span class="text-base font-bold text-blue-600 tracking-wide">Rp 75.000</span>
                </div>

                <a href="/checkout" class="w-full bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-3.5 px-4 rounded-xl flex items-center justify-center gap-1.5 shadow-sm shadow-orange-500/10 transition">
                    <span>Checkout</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    </a>
            </div>

        </div>
    </main>

    @include('layouts.footer')

</body>
</html>