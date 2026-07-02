<div class="w-64 bg-[#0B132B] text-gray-400 min-h-screen flex flex-col justify-between p-4">
    <div>
        <div class="flex items-center gap-3 px-2 py-4 text-white font-bold text-lg border-b border-gray-700/50 mb-6">
            <span class="bg-blue-600 p-2 rounded-lg text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </span>
            TravelKu Admin
        </div>

        <nav class="space-y-1">
            <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition
            {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                Dashboard
            </a>

            <a href="{{ route('admin.jadwal') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition
            {{ request()->routeIs('admin.jadwal') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                Jadwal Travel
            </a>

            <a href="{{ route('admin.rute') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('admin.rute') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                Rute
            </a>

             <a href="{{ route('admin.booking.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition
            {{ request()->routeIs('admin.booking.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                Pemesanan
            </a>

            <a href="{{ route('admin.user.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('admin.user.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                User
            </a>

            <a href="{{ route('admin.laporan') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('admin.laporan') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                Laporan
            </a>
        </nav>
    </div>

    <div class="space-y-1 text-sm border-t border-gray-700/50 pt-4">
        <a href="#" class="flex items-center gap-2 px-4 py-2 hover:text-white transition">
            <span>&lt;</span> Kembali ke Website
        </a>
        <a href="#" class="flex items-center gap-2 px-4 py-2 text-red-400 hover:text-red-300 transition">
            <span>↳</span> Keluar
        </a>
    </div>
</div>