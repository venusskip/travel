<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pemesanan - TravelKu Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] flex min-h-screen font-sans">

    @include('partials.sidebar')

    <main class="flex-1 p-8">
        
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Pemesanan</h1>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Manajemen Pemesanan</h2>
                    <p class="text-sm text-gray-400 mt-1">1 pemesanan</p>
                </div>
                
                <div>
                    <select name="filter_status" class="bg-white border border-gray-200 rounded-xl px-4 py-2 text-sm text-gray-700 focus:outline-none focus:border-blue-500 shadow-sm transition">
                        <option value="semua">Semua Status</option>
                        <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Dikonfirmasi">Dikonfirmasi</option>
                        <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 text-xs font-medium uppercase tracking-wider">
                            <th class="pb-4 font-semibold">Kode</th>
                            <th class="pb-4 font-semibold">Penumpang</th>
                            <th class="pb-4 font-semibold">Rute</th>
                            <th class="pb-4 font-semibold">Tanggal</th>
                            <th class="pb-4 font-semibold">Total</th>
                            <th class="pb-4 font-semibold">Status</th>
                            <th class="pb-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-600 divide-y divide-gray-50">
                        
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 text-gray-400 font-mono text-xs tracking-tight">TRVMQXH2Y7ANVX</td>
                            <td class="py-4 font-bold text-gray-800">Rahmat Dhani</td>
                            <td class="py-4 text-gray-500">Baubau &rarr; Kendari</td>
                            <td class="py-4 text-gray-500">20/07/25</td>
                            <td class="py-4 font-bold text-blue-600">Rp 250.000</td>
                            <td class="py-4">
                                <select onchange="updateStatusStyle(this)" class="bg-[#FFFDF5] text-[#D97706] border border-[#FDE68A] rounded-xl px-3 py-1.5 text-xs font-medium focus:outline-none focus:ring-1 focus:ring-amber-500 cursor-pointer">
                                    <option value="Menunggu Pembayaran" selected>Menunggu Pembayaran</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Dikonfirmasi">Dikonfirmasi</option>
                                    <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Dibatalkan">Dibatalkan</option>
                                </select>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center items-center">
                                    <button onclick="openDetailModal()" class="text-blue-500 hover:text-blue-700 p-2 rounded-lg hover:bg-blue-50 transition" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="modal-detail" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 transition-opacity duration-300">
        <div class="bg-white rounded-2xl p-6 w-full max-w-xl shadow-xl relative m-4">
            
            <button onclick="closeModal()" class="absolute top-6 right-6 text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-1.5 rounded-full transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18"></path></svg>
            </button>
            
            <h3 class="text-base font-bold text-gray-800 mb-1">Detail Pemesanan</h3>
            <div class="flex justify-between items-center mb-6">
                <span class="text-xs text-gray-400 font-mono">#TRVMQXH2Y7ANVX</span>
                <span class="bg-[#FFFDF5] text-[#D97706] border border-[#FDE68A] px-3 py-1 rounded-full text-xs font-medium">Menunggu Pembayaran</span>
            </div>
            
            <div class="space-y-6">
                <div>
                    <h4 class="font-bold text-gray-800 text-sm mb-3">Express Sultra</h4>
                    <div class="space-y-2 text-xs text-gray-500">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Baubau &rarr; Kendari</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>20 July 2025</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>06:00</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>1 tiket &bull; Kursi: -</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4">
                    <h4 class="font-bold text-gray-800 text-xs mb-3">Data Penumpang</h4>
                    <div class="space-y-2 text-xs text-gray-500">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span class="text-gray-700">Rahmat Dhani</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.72l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.72.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>02190190193</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>rahmatdhaniii38@gmail.com</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4 flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2 text-gray-500 text-xs">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        <span>Transfer Bank BRI</span>
                    </div>
                    <div class="font-bold text-blue-600 text-base">
                        Rp 250.000
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function openDetailModal() {
            document.getElementById('modal-detail').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal-detail').classList.add('hidden');
        }

        // Opsional: Logika interaktif untuk mengubah warna background dropdown berdasarkan opsi status yang dipilih
        function updateStatusStyle(selectElement) {
            const status = selectElement.value;
            if (status === 'Menunggu Pembayaran') {
                selectElement.style.backgroundColor = '#FFFDF5';
                selectElement.style.color = '#D97706';
                selectElement.style.borderColor = '#FDE68A';
            } else if (status === 'Selesai') {
                selectElement.style.backgroundColor = '#F0FDF4';
                selectElement.style.color = '#16A34A';
                selectElement.style.borderColor = '#BBF7D0';
            } else if (status === 'Dibatalkan') {
                selectElement.style.backgroundColor = '#FEF2F2';
                selectElement.style.color = '#DC2626';
                selectElement.style.borderColor = '#FCA5A5';
            } else {
                selectElement.style.backgroundColor = '#F0F9FF';
                selectElement.style.color = '#0284C7';
                selectElement.style.borderColor = '#BAE6FD';
            }
        }
    </script>

</body>
</html>