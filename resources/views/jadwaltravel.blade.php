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

        <form action="{{ url()->current() }}" method="GET" class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm mb-12 grid grid-cols-1 md:grid-cols-5 gap-4">
            
            <div>
                <select name="asal" onchange="this.form.submit()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-blue-500 font-medium text-gray-500 appearance-none">
                    <option value="">Semua Kota Asal</option>
                    @foreach($kotaAsal as $asal)
                        <option value="{{ $asal }}" {{ request('asal') == $asal ? 'selected' : '' }}>{{ $asal }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name="tujuan" onchange="this.form.submit()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-blue-500 font-medium text-gray-500 appearance-none">
                    <option value="">Semua Kota Tujuan</option>
                    @foreach($kotaTujuan as $tujuan)
                        <option value="{{ $tujuan }}" {{ request('tujuan') == $tujuan ? 'selected' : '' }}>{{ $tujuan }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name="layanan" onchange="this.form.submit()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-blue-500 font-medium text-gray-500 appearance-none">
                    <option value="">Semua Layanan</option>
                    @foreach($layanan as $l)
                        <option value="{{ $l }}" {{ request('layanan') == $l ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" onchange="this.form.submit()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-blue-500 font-medium text-gray-400">
            </div>

            <div>
                <input type="number" 
                       name="harga_maks" 
                       id="harga_maks"
                       value="{{ request('harga_maks') }}" 
                       oninput="autoSubmitHarga()"
                       placeholder="Harga maks (Rp)" 
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-blue-500 font-medium text-gray-400">
            </div>
            
        </form>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            @if($jadwals->isEmpty())
                <div class="col-span-1 md:col-span-3 text-center py-12 text-gray-400 text-sm bg-gray-50 rounded-2xl border border-gray-100">
                    Belum ada jadwal travel yang tersedia saat ini atau filter tidak cocok.
                </div>
            @else
                @foreach($jadwals as $j)
                <a href="/detail-travel/{{ $j->id }}" class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition group cursor-pointer block">
                    
                    <div class="bg-blue-50 h-32 flex items-center justify-center text-blue-200 group-hover:bg-blue-100 transition relative overflow-hidden">
                        @if($j->foto_kendaraan)
                            <img src="{{ asset('storage/' . $j->foto_kendaraan) }}" class="w-full h-full object-cover" alt="Foto {{ $j->nama_travel }}">
                        @else
                            <svg class="w-14 h-14 text-blue-300 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-sm text-slate-800">{{ $j->nama_travel }}</h3>
                            <span class="bg-blue-50 text-blue-600 text-[9px] px-2 py-0.5 rounded font-semibold uppercase tracking-wider">{{ $j->jenis_layanan }}</span>
                        </div>
                        
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center text-[11px] text-gray-400 space-x-2">
                                <svg class="w-3.5 h-3.5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                <span class="font-medium text-gray-600">{{ $j->kota_asal }} — {{ $j->kota_tujuan }}</span>
                            </div>
                            <div class="flex items-center text-[11px] text-gray-400 space-x-2">
                                <svg class="w-3.5 h-3.5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>{{ $j->tanggal_berangkat ? \Carbon\Carbon::parse($j->tanggal_berangkat)->format('d M Y') : '-' }} &nbsp;•&nbsp; {{ $j->jam_berangkat }}</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                            <span class="text-blue-600 font-bold text-base">Rp {{ number_format($j->harga, 0, ',', '.') }}</span>
                            
                            @php
                                $sisaKursi = $j->total_kursi - $j->kursi_terisi;
                            @endphp

                            @if($sisaKursi > 0)
                                <span class="bg-emerald-50 text-emerald-600 text-[10px] px-2.5 py-1 rounded-md font-semibold">{{ $sisaKursi }} kursi tersisa</span>
                            @else
                                <span class="bg-red-50 text-red-600 text-[10px] px-2.5 py-1 rounded-md font-semibold">Habis</span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            @endif
        </div>
    </main>

    @include('layouts.footer')

    <script>
        let timer;
        function autoSubmitHarga() {
            // Hapus timer sebelumnya jika user masih aktif mengetik
            clearTimeout(timer);
            
            // Atur ulang timer: Form akan disubmit setelah 800 milidetik berhenti mengetik
            timer = setTimeout(() => {
                document.getElementById('harga_maks').form.submit();
            }, 800); 
        }

        // Trik kenyamanan: Kembalikan fokus kursor ke kotak harga setelah halaman reload
        window.onload = function() {
            const inputHarga = document.getElementById('harga_maks');
            if (inputHarga && inputHarga.value !== '') {
                inputHarga.focus();
                
                // Pindahkan posisi kursor ketikan ke karakter paling belakang
                const val = inputHarga.value;
                inputHarga.value = '';
                inputHarga.value = val;
            }
        }
    </script>
    </body>
</html>