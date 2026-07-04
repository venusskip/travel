<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Travel - TravelKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#f8fafc] text-gray-900 antialiased">

    @include('layouts.navbar')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" 
          x-data="{ 
              selectedSeats: [], 
              ticketPrice: {{ $jadwal->harga }},
              toggleSeat(seatNumber) {
                  if (this.selectedSeats.includes(seatNumber)) {
                      this.selectedSeats = this.selectedSeats.filter(s => s !== seatNumber);
                  } else {
                      this.selectedSeats.push(seatNumber);
                  }
              }
          }">
        
        <div class="mb-6">
            <a href="/jadwal" class="inline-flex items-center space-x-2 text-xs font-medium text-gray-400 hover:text-blue-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Kembali ke Jadwal</span>
            </a>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                @foreach($errors->all() as $error)
                    <p class="font-medium">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('cart.store') }}" method="POST" class="block lg:table w-full border-separate border-spacing-x-0 lg:border-spacing-x-6">
            @csrf
            <input type="hidden" name="id_jadwal" value="{{ $jadwal->id }}">

            <div class="block lg:table-cell w-full lg:w-[65%] vertical-align-top space-y-6">
                
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <div class="bg-blue-50 h-52 rounded-xl flex items-center justify-center text-blue-200 relative mb-6 overflow-hidden">
                        <span class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] font-bold px-3 py-1.5 rounded-full shadow-sm z-10">{{ $jadwal->jenis_layanan }}</span>
                        @if($jadwal->foto_kendaraan)
                            <img src="{{ asset('storage/' . $jadwal->foto_kendaraan) }}" class="w-full h-full object-cover" alt="Foto {{ $jadwal->nama_travel }}">
                        @else
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        @endif
                    </div>

                    <h1 class="text-2xl font-bold text-slate-800 mb-6">{{ $jadwal->nama_travel }}</h1>

                    <div class="grid grid-cols-2 gap-y-5 gap-x-4 border-b border-gray-100 pb-6 mb-5">
                        <div class="flex items-start space-x-3">
                            <div class="bg-blue-50 p-2 rounded-lg text-blue-500 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Rute</div>
                                <div class="text-xs font-semibold text-gray-700">{{ $jadwal->kota_asal }} — {{ $jadwal->kota_tujuan }}</div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="bg-blue-50 p-2 rounded-lg text-blue-500 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <div class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Tanggal</div>
                                <div class="text-xs font-semibold text-gray-700">{{ $jadwal->tanggal_berangkat ? \Carbon\Carbon::parse($jadwal->tanggal_berangkat)->format('d F Y') : '-' }}</div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="bg-blue-50 p-2 rounded-lg text-blue-500 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Jam Berangkat</div>
                                <div class="text-xs font-semibold text-gray-700">{{ $jadwal->jam_berangkat }} WITA</div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="bg-blue-50 p-2 rounded-lg text-blue-500 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Kursi Tersedia</div>
                                <div class="text-xs font-semibold text-gray-700">{{ $jadwal->total_kursi - $jadwal->kursi_terisi }} dari {{ $jadwal->total_kursi }}</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center space-x-2 text-xs font-bold text-slate-800 mb-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Deskripsi Layanan</span>
                        </div>
                        <p class="text-gray-400 text-xs leading-relaxed">
                            {{ $jadwal->deskripsi ?? 'Tidak ada deskripsi tambahan mengenai layanan armada travel ini.' }}
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h2 class="text-sm font-bold text-slate-800 mb-4">Pilih Kursi (Opsional)</h2>
                    
                    <div class="flex space-x-4 text-xs font-medium text-gray-400 mb-6">
                        <div class="flex items-center space-x-1.5">
                            <span class="w-4 h-4 bg-gray-200 rounded"></span>
                            <span>Terisi</span>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <span class="w-4 h-4 border border-blue-500 bg-blue-50 rounded"></span>
                            <span>Dipilih</span>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <span class="w-4 h-4 border border-gray-200 rounded"></span>
                            <span>Tersedia</span>
                        </div>
                    </div>

                    <div class="max-w-xs grid grid-cols-4 gap-3">
                        @for($i = 1; $i <= $jadwal->total_kursi; $i++)
                            @php
                                $isTerpesan = is_array($jadwal->kursi_terpesan) && in_array($i, $jadwal->kursi_terpesan);
                            @endphp

                            @if($isTerpesan)
                                <button type="button" class="h-12 bg-gray-200 text-gray-400 font-bold text-xs rounded-lg flex items-center justify-center cursor-not-allowed" disabled>{{ $i }}</button>
                            @else
                                <label class="relative cursor-pointer select-none">
                                    <input type="checkbox" name="kursi_dipilih[]" value="{{ $i }}" x-model="selectedSeats" class="sr-only">
                                    
                                    <div class="h-12 w-full text-xs font-semibold rounded-lg flex items-center justify-center transition border"
                                         :class="selectedSeats.includes({{ $i }}) ? 'bg-blue-50 border-blue-500 text-blue-600 font-bold' : 'border-gray-200 text-gray-700 hover:border-blue-500'">
                                        {{ $i }}
                                    </div>
                                </label>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>

            <div class="block lg:table-cell w-full lg:w-[35%] vertical-align-top mt-6 lg:mt-0">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm sticky top-24">
                    <h2 class="text-sm font-bold text-slate-800 mb-6">Pesan Tiket</h2>

                    <div class="mb-4">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Harga Per Tiket</div>
                        <div class="text-2xl font-bold text-blue-600">Rp {{ number_format($jadwal->harga, 0, ',', '.') }}</div>
                    </div>

                    <div class="mb-5">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Jumlah Tiket</div>
                        <div class="inline-flex items-center border border-gray-200 rounded-xl bg-gray-50 p-1">
                            <button type="button" @click="selectedSeats.pop()" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-gray-100 font-bold text-gray-500 shadow-sm hover:bg-gray-50">-</button>
                            <span class="px-5 font-bold text-xs text-gray-700" x-text="selectedSeats.length || 1">1</span>
                            <button type="button" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-gray-100 font-bold text-gray-300 shadow-sm cursor-not-allowed" disabled>+</button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Kursi Dipilih</div>
                        <div class="text-xs font-semibold text-gray-700" x-text="selectedSeats.join(', ') || '-'">-</div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-2 mb-6">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400 font-medium"><span x-text="selectedSeats.length || 1">1</span>x tiket</span>
                            <span class="text-gray-600 font-semibold">Rp {{ number_format($jadwal->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm pt-2">
                            <span class="font-bold text-slate-800">Total</span>
                            <span class="font-bold text-blue-600">Rp <span x-text="new International.NumberFormat('id-ID').format((selectedSeats.length || 1) * ticketPrice)"></span></span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl text-xs flex items-center justify-center space-x-2 transition shadow-md shadow-blue-600/10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span>Tambah ke Keranjang</span>
                    </button>
                </div>
            </div>

        </form>
    </main>

    @include('layouts.footer')

</body>
</html>