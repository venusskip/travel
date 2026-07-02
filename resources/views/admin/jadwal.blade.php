<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Travel Admin - TravelKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8F9FA] flex min-h-screen font-sans" x-data="{ openTambah: false, openEdit: false, editData: {} }">

    @include('partials.sidebar') 

    <main class="flex-1 p-8">
        
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Jadwal Travel</h1>
        </div>

        <!-- 4.3 Notifikasi Sukses / Gagal -->
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
        @endif

       @if($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Manajemen Jadwal Travel</h2>
                    <!-- Dashboard ringkasan relevan (ketentuan 5.3) -->
                    <p class="text-sm text-gray-400 mt-1">{{ $totalJadwal }} jadwal terdaftar</p>
                </div>
                <button @click="openTambah = true" class="bg-[#2563EB] hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium flex items-center gap-2 shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Jadwal
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 text-sm font-medium">
                            <th class="pb-4 font-medium w-1/4">Travel</th>
                            <th class="pb-4 font-medium">Rute</th>
                            <th class="pb-4 font-medium">Tanggal</th>
                            <th class="pb-4 font-medium">Jam</th>
                            <th class="pb-4 font-medium">Harga</th>
                            <th class="pb-4 font-medium">Kursi Sisa</th>
                            <th class="pb-4 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-600 divide-y divide-gray-50">
                        
                        @forelse($jadwals as $jadwal)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4">
                                <span class="font-bold text-gray-800 block">{{ $jadwal->nama_travel }}</span>
                                <span class="text-xs text-gray-400">{{ $jadwal->jenis_layanan }}</span>
                            </td>
                            <td class="py-4 text-gray-500">{{ $jadwal->kota_asal }} &rarr; {{ $jadwal->kota_tujuan }}</td>
                            <td class="py-4 text-gray-500">{{ optional($jadwal->tanggal_berangkat)->format('d M Y') }}</td>
                            <td class="py-4 text-gray-500">{{ $jadwal->jam_berangkat }}</td>
                            <td class="py-4 font-bold text-blue-600">Rp {{ number_format($jadwal->harga, 0, ',', '.') }}</td>
                            <td class="py-4 text-gray-500">{{ $jadwal->total_kursi - $jadwal->kursi_terisi }}/{{ $jadwal->total_kursi }}</td>
                            <td class="py-4">
                                <div class="flex justify-center items-center gap-4">
                                    <!-- Tombol Edit Mengisi Data Alpine.js -->
                                    <button @click="editData = {
                                        id: '{{ $jadwal->id }}',
                                        id_rute: '{{ $jadwal->id_rute }}',
                                        nama_travel: '{{ $jadwal->nama_travel }}',
                                        jenis_layanan: '{{ $jadwal->jenis_layanan }}',
                                        tanggal_berangkat: '{{ $jadwal->tanggal_berangkat->format('Y-m-d') }}',
                                        jam_berangkat: '{{ $jadwal->jam_berangkat }}',
                                        harga: '{{ $jadwal->harga }}',
                                        total_kursi: '{{ $jadwal->total_kursi }}',
                                        deskripsi: '{{ $jadwal->deskripsi }}'
                                    }; openEdit = true" class="text-blue-500 hover:text-blue-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-gray-400">Belum ada jadwal travel tersedia.</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- MODAL TAMBAH JADWAL -->
    <div x-show="openTambah" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4" x-cloak>
        <div @click.away="openTambah = false" class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-base font-bold text-gray-800">Tambah Jadwal</h3>
                <button @click="openTambah = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('admin.jadwal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Travel *</label>
                        <input type="text" name="nama_travel" required placeholder="Masukkan nama travel" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jenis Layanan *</label>
                        <select name="jenis_layanan" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-600">
                            <option>Travel Antar Kota</option>
                            <option>Travel Eksekutif</option>
                            <option>Travel Wisata</option>
                        </select>
                    </div>
                </div>

                <!-- Dropdown Rute Relasi Utama -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Pilih Jalur Rute *</label>
                    <select name="id_rute" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-600">
                        <option value="" disabled selected>Pilih Hubungan Rute Asal -> Tujuan</option>
                        @foreach($rutes as $rute)
                            <option value="{{ $rute->id }}">{{ $rute->kota_asal }} - {{ $rute->kota_tujuan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Tanggal Berangkat *</label>
                        <input type="date" name="tanggal_berangkat" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-600">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jam Berangkat *</label>
                        <input type="time" name="jam_berangkat" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Harga Tiket (Rp) *</label>
                        <input type="number" name="harga" required placeholder="Masukkan harga tiket" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Total Kursi *</label>
                        <input type="number" name="total_kursi" value="12" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Foto Kendaraan</label>
                    <input type="file" name="foto_kendaraan" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border file:border-gray-200 file:text-sm file:bg-white hover:file:bg-gray-50 file:cursor-pointer">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 resize-none"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" @click="openTambah = false" class="px-5 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition w-32">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-[#2563EB] hover:bg-blue-700 text-white rounded-xl text-sm font-medium shadow-sm transition w-32">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- MODAL EDIT JADWAL -->
    <div x-show="openEdit" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4" x-cloak>
        <div @click.away="openEdit = false" class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-base font-bold text-gray-800">Edit Jadwal</h3>
                <button @click="openEdit = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Action Form otomatis berganti id berkat penggabungan Alpine.js -->
            <form :action="'/admin/jadwal/' + editData.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Travel *</label>
                        <input type="text" name="nama_travel" x-model="editData.nama_travel" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jenis Layanan *</label>
                        <select name="jenis_layanan" x-model="editData.jenis_layanan" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-700">
                            <option value="Travel Antar Kota">Travel Antar Kota</option>
                            <option value="Travel Eksekutif">Travel Eksekutif</option>
                            <option value="Travel Wisata">Travel Wisata</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Pilih Jalur Rute *</label>
                    <select name="id_rute" x-model="editData.id_rute" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-700">
                        @foreach($rutes as $rute)
                            <option value="{{ $rute->id }}">{{ $rute->kota_asal }} - {{ $rute->kota_tujuan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Tanggal Berangkat *</label>
                        <input type="date" name="tanggal_berangkat" x-model="editData.tanggal_berangkat" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jam Berangkat *</label>
                        <input type="time" name="jam_berangkat" x-model="editData.jam_berangkat" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Harga Tiket (Rp) *</label>
                        <input type="number" name="harga" x-model="editData.harga" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Total Kursi *</label>
                        <input type="number" name="total_kursi" x-model="editData.total_kursi" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 text-gray-700">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Foto Kendaraan</label>
                    <input type="file" name="foto_kendaraan" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border file:border-gray-200 file:text-sm file:bg-white hover:file:bg-gray-50 file:cursor-pointer">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" x-model="editData.deskripsi" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none bg-gray-50/50 resize-none text-gray-700"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" @click="openEdit = false" class="px-5 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition w-32">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-[#2563EB] hover:bg-blue-700 text-white rounded-xl text-sm font-medium shadow-sm transition w-32">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <style> [x-cloak] { display: none !important; } </style>
</body>
</html>