<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Travel - TravelKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

    @include('layouts.navbar')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-slate-800 mb-2 tracking-tight">Jadwal Travel</h1>
            <p class="text-gray-400 text-sm">Temukan jadwal travel sesuai kebutuhan Anda</p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm mb-12 grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <select class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-blue-500 font-medium text-gray-500 appearance-none">
                    <option>Semua Kota Asal</option>
                </select>
            </div>
            <div>
                <select class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-blue-500 font-medium text-gray-500 appearance-none">
                    <option>Semua Kota Tujuan</option>
                </select>
            </div>
            <div>
                <select class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-blue-500 font-medium text-gray-500 appearance-none">
                    <option>Semua Layanan</option>
                </select>
            </div>
            <div>
                <input type="date" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-blue-500 font-medium text-gray-400">
            </div>
            <div>
                <input type="text" placeholder="Harga maks (Rp)" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-blue-500 font-medium text-gray-400">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            @php
                $jadwals = [
                    ['nama' => 'Buton Trans', 'rute' => 'Bau-bau — Pasarwajo', 'tgl' => '25 Jul 2026', 'jam' => '09:00', 'harga' => '50.000', 'kursi' => '5'],
                    ['nama' => 'Airport Shuttle', 'rute' => 'Bau-bau — Batauga', 'tgl' => '24 Jul 2026', 'jam' => '04:30', 'harga' => '75.000', 'kursi' => '11'],
                    ['nama' => 'VIP Executive', 'rute' => 'Bau-bau — Kendari', 'tgl' => '23 Jul 2026', 'jam' => '08:00', 'harga' => '400.000', 'kursi' => '6'],
                    ['nama' => 'Wakatobi Jaya', 'rute' => 'Bau-bau — Wangi-Wangi', 'tgl' => '22 Jul 2026', 'jam' => '05:00', 'harga' => '180.000', 'kursi' => '12'],
                    ['nama' => 'Nusantara Travel', 'rute' => 'Bau-bau — Raha', 'tgl' => '21 Jul 2026', 'jam' => '07:30', 'harga' => '120.000', 'kursi' => '10'],
                    ['nama' => 'Express Sultra', 'rute' => 'Bau-bau — Kendari', 'tgl' => '20 Jul 2026', 'jam' => '06:00', 'harga' => '250.000', 'kursi' => '8']
                ];
            @endphp

            @foreach($jadwals as $j)
            <a href="/detail-travel" class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition group cursor-pointer block">
                <div class="bg-blue-50 h-32 flex items-center justify-center text-blue-200 group-hover:bg-blue-100 transition">
                    <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-sm text-slate-800 mb-3">{{ $j['nama'] }}</h3>
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-[11px] text-gray-400 space-x-2">
                            <svg class="w-3.5 h-3.5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <span>{{ $j['rute'] }}</span>
                        </div>
                        <div class="flex items-center text-[11px] text-gray-400 space-x-2">
                            <svg class="w-3.5 h-3.5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ $j['tgl'] }} &nbsp;•&nbsp; {{ $j['jam'] }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                        <span class="text-blue-600 font-bold text-base">Rp {{ $j['harga'] }}</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] px-2.5 py-1 rounded-md font-semibold">{{ $j['kursi'] }} kursi tersisa</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </main>

    @include('layouts.footer')

</body>
</html>