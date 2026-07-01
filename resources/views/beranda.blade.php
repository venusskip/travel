<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelKu - Pesan Tiket Travel Mudah & Cepat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

    @include('layouts.navbar')

    <section class="bg-gradient-to-b from-[#1e50da] via-[#1b49c4] to-[#153794] text-white pt-24 pb-56 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="inline-flex items-center space-x-1.5 bg-white/10 text-white text-xs px-3 py-1.5 rounded-full mb-8 backdrop-blur-sm border border-white/10">
                <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span class="font-normal opacity-90 text-[11px] tracking-wide">Layanan Travel Terpercaya</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold mb-5 tracking-tight leading-none text-left">
                Pesan Tiket Travel<br>
                <span class="text-[#ff922b]">Mudah & Cepat</span>
            </h1>
            
            <p class="text-blue-100/80 max-w-xl text-left text-sm font-normal leading-relaxed mb-14">
                Nikmati perjalanan nyaman antar kota dengan harga terjangkau. Pesan tiket travel online sekarang!
            </p>

            <div class="absolute -bottom-28 left-4 right-4 md:left-8 md:right-8 max-w-4xl bg-white p-4 rounded-[20px] shadow-[0_15px_30px_rgba(0,0,0,0.08)] text-gray-700 flex flex-col md:flex-row gap-4 items-center">
                
                <div class="w-full md:flex-1 text-left">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5 px-1">Kota Asal</label>
                    <div class="relative">
                        <select class="w-full bg-gray-50 border border-gray-100 rounded-xl pl-4 pr-10 py-3 text-sm focus:outline-none focus:border-blue-500 focus:bg-white font-medium text-gray-600 appearance-none transition-all">
                            <option>Semua kota asal</option>
                            <option>Bau-bau</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                            <svg class="fill-current h-4 w-4 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="w-full md:flex-1 text-left">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5 px-1">Kota Tujuan</label>
                    <div class="relative">
                        <select class="w-full bg-gray-50 border border-gray-100 rounded-xl pl-4 pr-10 py-3 text-sm focus:outline-none focus:border-blue-500 focus:bg-white font-medium text-gray-600 appearance-none transition-all">
                            <option>Semua kota tujuan</option>
                            <option>Kendari</option>
                            <option>Raha</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                            <svg class="fill-current h-4 w-4 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="w-full md:w-auto pt-5 md:pt-0">
                    <button class="w-full md:w-auto bg-[#2260ff] hover:bg-blue-700 text-white font-medium py-3.5 px-8 rounded-xl text-sm flex items-center justify-center space-x-2 transition shadow-md shadow-blue-600/10 whitespace-nowrap">
                        <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>Cari Travel</span>
                    </button>
                </div>

            </div>
        </div>
    </section>

    <!-- SPACING: Batas agar teks Layanan Kami tidak tertutup -->
    <div class="h-40"></div>

    <!-- SECTION LAYANAN KAMI (BUNGKUS TAG <a>) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-20 mb-20">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-slate-800">Layanan Kami</h2>
            <p class="text-gray-400 text-xs mt-1">Berbagai pilihan layanan travel untuk kebutuhan perjalanan Anda</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <a href="/detail-travel" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition block">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 flex items-center justify-center rounded-xl mb-4 font-bold text-sm">1/3</div>
                <h3 class="font-bold text-sm text-slate-800 mb-1.5">Travel Antar Kota</h3>
                <p class="text-gray-400 text-xs leading-relaxed">Perjalanan reguler antar kota dengan jadwal tetap</p>
            </a>

            <a href="/detail-travel" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition block">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 flex items-center justify-center rounded-xl mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                </div>
                <h3 class="font-bold text-sm text-slate-800 mb-1.5">Travel Bandara</h3>
                <p class="text-gray-400 text-xs leading-relaxed">Antar jemput bandara dengan tepat waktu</p>
            </a>

            <a href="/detail-travel" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition block">
                <div class="w-10 h-10 bg-purple-50 text-purple-600 flex items-center justify-center rounded-xl mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                </div>
                <h3 class="font-bold text-sm text-slate-800 mb-1.5">Travel Wisata</h3>
                <p class="text-gray-400 text-xs leading-relaxed">Paket wisata ke destinasi menarik</p>
            </a>

            <a href="/detail-travel" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition block">
                <div class="w-10 h-10 bg-amber-50 text-amber-600 flex items-center justify-center rounded-xl mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="font-bold text-sm text-slate-800 mb-1.5">Travel Eksekutif</h3>
                <p class="text-gray-400 text-xs leading-relaxed">Layanan premium dengan kenyamanan ekstra</p>
            </a>

        </div>
    </section>

    <!-- SECTION RUTE POPULER (SUDAH DI-LOOP & BUNGKUS TAG <a>) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Rute Populer</h2>
            <p class="text-gray-400 text-xs mt-1">Pilihan rute travel favorit pelanggan kami</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $rute = [
                    ['dari' => 'Bau-bau', 'ke' => 'Kendari'], ['dari' => 'Bau-bau', 'ke' => 'Raha'],
                    ['dari' => 'Bau-bau', 'ke' => 'Pasarwajo'], ['dari' => 'Bau-bau', 'ke' => 'Wangi-Wangi (Wakatobi)'],
                    ['dari' => 'Bau-bau', 'ke' => 'Batauga'], ['dari' => 'Bau-bau', 'ke' => 'Lombe'],
                    ['dari' => 'Bau-bau', 'ke' => 'Mawasangka'], ['dari' => 'Bau-bau', 'ke' => 'Labuan']
                ];
            @endphp

            @foreach($rute as $r)
            <a href="/detail-travel" class="bg-white p-4 rounded-xl border border-gray-100 flex items-center justify-between shadow-sm hover:shadow-md hover:border-blue-200 transition block">
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-50 text-blue-600 p-2 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800">{{ $r['dari'] }}</div>
                            <div class="text-[10px] text-gray-400 flex items-center">
                                <svg class="w-2.5 h-2.5 mx-0.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                {{ $r['ke'] }}
                            </div>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <!-- SECTION JADWAL TERBARU -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Jadwal Terbaru</h2>
                <p class="text-gray-400 text-xs mt-1">Jadwal travel terbaru yang tersedia</p>
            </div>
            <a href="#" class="text-xs font-semibold text-gray-600 border border-gray-200 rounded-lg px-3 py-2 hover:bg-gray-50 transition flex items-center space-x-1">
                <span>Lihat Semua</span>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Kartu 1: Express Sultra -->
            <a href="/detail-travel" class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition group block">
                <div class="bg-blue-50 h-28 flex items-center justify-center text-blue-300 group-hover:bg-blue-100 transition">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-sm text-slate-800 mb-2">Express Sultra</h3>
                    <div class="text-xs text-gray-400 space-y-1.5 mb-5">
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <span>Bau-bau — Kendari</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>25 Jul 2026  •  06:00</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                        <span class="text-blue-600 font-bold text-sm">Rp 250.000</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] px-2 py-1 rounded font-medium">8 kursi tersisa</span>
                    </div>
                </div>
            </a>

            <!-- Kartu 2: Nusantara Travel -->
            <a href="/detail-travel" class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition group block">
                <div class="bg-blue-50 h-28 flex items-center justify-center text-blue-300 group-hover:bg-blue-100 transition">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-sm text-slate-800 mb-2">Nusantara Travel</h3>
                    <div class="text-xs text-gray-400 space-y-1.5 mb-5">
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <span>Bau-bau — Raha</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>25 Jul 2026  •  07:00</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                        <span class="text-blue-600 font-bold text-sm">Rp 120.000</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] px-2 py-1 rounded font-medium">10 kursi tersisa</span>
                    </div>
                </div>
            </a>

            <!-- Kartu 3: Wakatobi Jaya -->
            <a href="/detail-travel" class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition group block">
                <div class="bg-blue-50 h-28 flex items-center justify-center text-blue-300 group-hover:bg-blue-100 transition">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-sm text-slate-800 mb-2">Wakatobi Jaya</h3>
                    <div class="text-xs text-gray-400 space-y-1.5 mb-5">
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <span>Bau-bau — Wangi-Wangi</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>25 Jul 2026  •  09:00</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                        <span class="text-blue-600 font-bold text-sm">Rp 180.000</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] px-2 py-1 rounded font-medium">12 kursi tersisa</span>
                    </div>
                </div>
            </a>

            <!-- Kartu 4: VIP Executive -->
            <a href="/detail-travel" class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition group block">
                <div class="bg-blue-50 h-28 flex items-center justify-center text-blue-300 group-hover:bg-blue-100 transition">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-sm text-slate-800 mb-2">VIP Executive</h3>
                    <div class="text-xs text-gray-400 space-y-1.5 mb-5">
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <span>Bau-bau — Kendari</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>25 Jul 2026  •  08:00</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                        <span class="text-blue-600 font-bold text-sm">Rp 400.000</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] px-2 py-1 rounded font-medium">6 kursi tersisa</span>
                    </div>
                </div>
            </a>

            <!-- Kartu 5: Airport Shuttle -->
            <a href="/detail-travel" class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition group block">
                <div class="bg-blue-50 h-28 flex items-center justify-center text-blue-300 group-hover:bg-blue-100 transition">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-sm text-slate-800 mb-2">Airport Shuttle</h3>
                    <div class="text-xs text-gray-400 space-y-1.5 mb-5">
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <span>Bau-bau — Batauga</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>24 Jul 2026  •  04:30</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                        <span class="text-blue-600 font-bold text-sm">Rp 75.000</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] px-2 py-1 rounded font-medium">11 kursi tersisa</span>
                    </div>
                </div>
            </a>

            <!-- Kartu 6: Buton Trans -->
            <a href="/detail-travel" class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition group block">
                <div class="bg-blue-50 h-28 flex items-center justify-center text-blue-300 group-hover:bg-blue-100 transition">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-sm text-slate-800 mb-2">Buton Trans</h3>
                    <div class="text-xs text-gray-400 space-y-1.5 mb-5">
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <span>Bau-bau — Pasarwajo</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>25 Jul 2026  •  09:00</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                        <span class="text-blue-600 font-bold text-sm">Rp 50.000</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] px-2 py-1 rounded font-medium">5 kursi tersisa</span>
                    </div>
                </div>
            </a>

        </div>
    </section>

    <!-- SECTION WHY CHOOSE US -->
    <section class="bg-blue-600 text-white py-16 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-2">Mengapa Memilih TravelKu?</h2>
            <p class="text-blue-100 text-xs mb-12 opacity-80">Keunggulan layanan kami untuk perjalanan Anda</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center mb-4 text-amber-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="font-bold text-sm mb-1">Aman & Terpercaya</h3>
                    <p class="text-blue-100 text-[11px] max-w-[200px] opacity-75">Armada terawat dengan sopir berpengalaman</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center mb-4 text-amber-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-sm mb-1">Harga Terjangkau</h3>
                    <p class="text-blue-100 text-[11px] max-w-[200px] opacity-75">Harga kompetitif dengan kualitas terbaik</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center mb-4 text-amber-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-sm mb-1">Tepat Waktu</h3>
                    <p class="text-blue-100 text-[11px] max-w-[200px] opacity-75">Jadwal keberangkatan yang selalu tepat waktu</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center mb-4 text-amber-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-sm mb-1">Layanan 24 Jam</h3>
                    <p class="text-blue-100 text-[11px] max-w-[200px] opacity-75">Customer service siap membantu kapan saja</p>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

</body>
</html>