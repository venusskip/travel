<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelKu - Profil Saya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex flex-col min-h-screen font-sans">

    @include('layouts.navbar') 

    <main class="flex-grow max-w-4xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="max-w-2xl mx-auto">
            
            <h1 class="text-3xl font-bold text-left text-[#0f172a] tracking-tight mb-8">Profil Saya</h1>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden w-full">
                
                <div class="bg-blue-600 pt-10 pb-8 flex flex-col items-center justify-center text-white">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center text-white font-semibold text-3xl mb-3 border border-white/30">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h2 class="text-xl font-bold tracking-wide">{{ $user->name }}</h2>
                    <p class="text-xs text-blue-100 font-light mt-0.5">{{ $user->email }}</p>
                    <span class="mt-2 bg-white/20 text-white text-[10px] font-medium px-3 py-0.5 rounded-full border border-white/20 uppercase">
                        {{ $user->role }}
                    </span>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Nama
                        </label>
                        <input type="text" value="{{ $user->name }}" disabled
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-400 focus:outline-none cursor-not-allowed">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email
                        </label>
                        <input type="email" value="{{ $user->email }}" disabled
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-400 focus:outline-none cursor-not-allowed">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            No HP
                        </label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Masukkan No HP"
                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Alamat
                        </label>
                        <textarea name="address" placeholder="Masukkan alamat" rows="3"
                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 placeholder-gray-400 resize-none focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400">{{ old('address', $user->address) }}</textarea>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="flex-grow bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-3 px-6 rounded-xl flex items-center justify-center gap-2 shadow-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            Simpan
                        </button>
                        
                        <button type="button" onclick="document.getElementById('logout-form').submit();" class="bg-white hover:bg-red-50 text-red-500 border border-red-200 text-sm font-semibold py-3 px-5 rounded-xl flex items-center justify-center gap-2 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Keluar
                        </button>
                    </div>

                </form>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>

            </div>

            <div class="text-center mt-6">
                <a href="/riwayat" class="text-xs font-semibold text-blue-600 hover:underline inline-flex items-center gap-1">
                    Lihat Riwayat Pemesanan &rarr;
                </a>
            </div>

        </div>
    </main>

    @include('layouts.footer')

</body>
</html>