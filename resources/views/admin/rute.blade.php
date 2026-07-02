<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Rute - TravelKu Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] flex min-h-screen font-sans">

    @include('partials.sidebar')

    <main class="flex-1 p-8">
        
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Rute</h1>
        </div>

        <!-- Bagian Notifikasi Sukses / Gagal (Sesuai Ketentuan 4.3) -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 text-emerald-600 rounded-xl text-sm border border-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-xl text-sm border border-red-200">
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
                    <h2 class="text-xl font-bold text-gray-800">Manajemen Rute</h2>
                    <p class="text-sm text-gray-400 mt-1">{{ $totalRoute }} rute</p>
                </div>
                <button onclick="openModal('modal-tambah')" class="bg-[#2563EB] hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium flex items-center gap-2 shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Rute
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 text-xs font-medium uppercase tracking-wider">
                            <th class="pb-4 font-semibold">Kota Asal</th>
                            <th class="pb-4 font-semibold">Kota Tujuan</th>
                            <th class="pb-4 font-semibold">Jarak (km)</th>
                            <th class="pb-4 font-semibold">Estimasi Waktu</th>
                            <th class="pb-4 font-semibold">Status</th>
                            <th class="pb-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-600 divide-y divide-gray-50">
                        
                        @foreach($routes as $route)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 font-bold text-gray-800">{{ $route->kota_asal }}</td>
                            <td class="py-4 text-gray-500">{{ $route->kota_tujuan }}</td>
                            <td class="py-4 text-gray-500">{{ $route->jarak_km ?? '-' }}</td>
                            <td class="py-4 text-gray-500">{{ $route->estimasi_durasi ?? '-' }}</td>
                            <td class="py-4">
                                @if($route->aktif)
                                    <span class="bg-emerald-50 text-emerald-600 px-2.5 py-1 rounded-full text-xs font-medium">Aktif</span>
                                @else
                                    <span class="bg-gray-100 text-gray-500 px-2.5 py-1 rounded-full text-xs font-medium">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center items-center gap-4">
                                    <!-- Tombol Edit melempar ID rute juga ke javascript -->
                                    <button onclick="openEditModal('{{ $route->id }}', '{{ $route->kota_asal }}', '{{ $route->kota_tujuan }}', '{{ $route->jarak_km }}', '{{ $route->estimasi_durasi }}')" class="text-blue-500 hover:text-blue-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    
                                    <!-- Form Hapus Data -->
                                        <form action="{{ route('admin.rute.destroy', $route->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rute ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal Tambah -->
    <div id="modal-tambah" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 transition-opacity duration-300">
        <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-xl relative m-4">
            <button onclick="closeModal('modal-tambah')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18"></path></svg>
            </button>
            
            <h3 class="text-lg font-bold text-gray-800 mb-6">Tambah Rute</h3>


            <form action="{{ route('admin.rute.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota Asal *</label>
                    <input type="text" name="kota_asal" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota Tujuan *</label>
                    <input type="text" name="kota_tujuan" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jarak (km)</label>
                        <input type="number" name="jarak_km" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estimasi Waktu</label>
                        <input type="text" name="estimasi_durasi" placeholder="Misal: 5 jam" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm">
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal('modal-tambah')" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 font-medium rounded-xl text-sm bg-gray-50 hover:bg-gray-100 transition text-center">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl text-sm transition shadow-sm text-center">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Edit -->
    <div id="modal-edit" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 transition-opacity duration-300">
        <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-xl relative m-4">
            <button onclick="closeModal('modal-edit')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18"></path></svg>
            </button>
            
            <h3 class="text-lg font-bold text-gray-800 mb-6">Edit Rute</h3>
            
            <!-- Action Form Edit diisi dinamis via Javascript -->
            <form id="form-edit" action="#" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota Asal *</label>
                    <input type="text" id="edit_kota_asal" name="kota_asal" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota Tujuan *</label>
                    <input type="text" id="edit_kota_tujuan" name="kota_tujuan" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jarak (km)</label>
                        <input type="number" id="edit_jarak" name="jarak_km" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estimasi Waktu</label>
                        <input type="text" id="edit_estimasi" name="estimasi_durasi" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition text-sm">
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal('modal-edit')" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 font-medium rounded-xl text-sm bg-gray-50 hover:bg-gray-100 transition text-center">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl text-sm transition shadow-sm text-center">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Penyesuaian fungsi agar URL Form mengarah ke ID rute yang tepat saat mengupdate data
        function openEditModal(id, asal, tujuan, jarak, estimasi) {
            document.getElementById('edit_kota_asal').value = asal;
            document.getElementById('edit_kota_tujuan').value = tujuan;
            document.getElementById('edit_jarak').value = jarak;
            document.getElementById('edit_estimasi').value = estimasi;
            
            // Ubah action form secara dinamis mengarah ke rute admin
            document.getElementById('form-edit').action = '/admin/rute/' + id;
            
            openModal('modal-edit');
        }
    </script>

</body>
</html>