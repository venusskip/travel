<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <a href="/" class="flex items-center space-x-2 cursor-pointer">
                <div class="bg-blue-600 text-white p-1.5 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <span class="font-bold text-xl text-blue-900 tracking-tight">Travel<span class="text-blue-600">Ku</span></span>
            </a>

            <div class="hidden md:flex space-x-4 text-sm font-medium">
                <a href="{{ route('beranda') }}" class="{{ request()->is('/') ? 'text-blue-600 bg-blue-50' : 'text-gray-500 hover:text-blue-600' }} px-4 py-2 rounded-lg transition">Beranda</a>
                <a href="/jadwal" class="{{ request()->is('jadwal') ? 'text-blue-600 bg-blue-50' : 'text-gray-500 hover:text-blue-600' }} px-4 py-2 rounded-lg transition">Jadwal Travel</a>
                <a href="/riwayat" class="text-gray-500 hover:text-blue-600 px-4 py-2 rounded-lg transition">Riwayat</a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="/keranjang" class="text-gray-400 hover:text-blue-600 p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </a>

                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="/admin/dashboard" class="flex items-center space-x-1.5 bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-gray-200 transition">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        <span>Admin</span>
                    </a>
                @endif

                @if(Auth::check())
                    <a href="/profil" class="flex items-center space-x-2 pl-2 border-l border-gray-200">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold text-xs uppercase select-none">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <span class="text-xs font-semibold text-gray-700 hidden sm:inline">{{ Auth::user()->name }}</span>
                    </a>
                @else
                    <a href="/login" class="text-xs font-semibold text-blue-600 hover:text-blue-700 pl-2 border-l border-gray-200">
                        Masuk
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>