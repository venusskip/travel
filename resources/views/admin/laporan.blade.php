<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Analisis - TravelKu Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Gaya khusus saat cetak agar tombol filter & sidebar tidak ikut tercetak */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff;
            }
            main {
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-[#F8F9FA] flex min-h-screen font-sans">

    <div class="no-print">
        @include('partials.sidebar')
    </div>

    <main class="flex-1 p-8">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Laporan</h1>
                <p class="text-xs text-gray-400 mt-0.5">Analisis pemesanan dan pendapatan</p>
            </div>
            <button onclick="window.print()" class="no-print bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 px-4 py-2 rounded-xl text-xs font-medium flex items-center gap-2 shadow-sm transition">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Cetak PDF
            </button>
        </div>

        <form action="{{ route('admin.laporan') }}" method="GET" id="filterForm" class="no-print bg-white p-5 rounded-2xl shadow-sm border border-gray-100 mb-6 flex gap-4 max-w-xl">
            <div class="flex-1">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Dari Tanggal</label>
                <input type="date" name="dari_tanggal" value="{{ $dariTanggal }}" onchange="document.getElementById('filterForm').submit()" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 text-gray-600 bg-gray-50/50">
            </div>
            <div class="flex-1">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Sampai Tanggal</label>
                <input type="date" name="sampai_tanggal" value="{{ $sampaiTanggal }}" onchange="document.getElementById('filterForm').submit()" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 text-gray-600 bg-gray-50/50">
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400">Total Pemesanan</p>
                    <p class="text-2xl font-bold text-gray-800 mt-0.5">{{ $totalPemesanan }}</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600 font-bold text-lg select-none">
                    Rp
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-800 mt-0.5">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-orange-50 rounded-xl text-orange-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400">Total Penumpang</p>
                    <p class="text-2xl font-bold text-gray-800 mt-0.5">{{ $totalPenumpang }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-6">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 md:col-span-7">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Pendapatan per Bulan</h3>
                <div class="h-64 relative">
                    <canvas id="chartPendapatan"></canvas>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 md:col-span-5">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Distribusi Status</h3>
                <div class="h-64 relative flex justify-center items-center">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-gray-800 mb-4">Detail Pemesanan</h3>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 text-xs font-medium">
                            <th class="pb-3 font-semibold w-12">No</th>
                            <th class="pb-3 font-semibold">Kode</th>
                            <th class="pb-3 font-semibold">Penumpang</th>
                            <th class="pb-3 font-semibold">Rute</th>
                            <th class="pb-3 font-semibold">Tanggal</th>
                            <th class="pb-3 font-semibold">Tiket</th>
                            <th class="pb-3 font-semibold">Total</th>
                            <th class="pb-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs text-gray-600 divide-y divide-gray-50">
                        @forelse($bookings as $key => $booking)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 text-gray-400">{{ $key + 1 }}</td>
                            <td class="py-4 text-gray-400 font-mono">{{ $booking->kode_pemesanan }}</td>
                            <td class="py-4 font-bold text-gray-800">{{ $booking->nama_penumpang }}</td>
                            <td class="py-4 text-gray-500">{{ $booking->kota_asal }} &rarr; {{ $booking->kota_tujuan }}</td>
                            <td class="py-4 text-gray-500">{{ \Carbon\Carbon::parse($booking->tanggal_berangkat)->format('d/m/y') }}</td>
                            <td class="py-4 text-gray-500">{{ $booking->jumlah_tiket }}</td>
                            <td class="py-4 font-bold text-blue-600">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                            <td class="py-4">
                                @if($booking->status == 'Menunggu Pembayaran')
                                    <span class="bg-[#FFFDF5] text-[#D97706] border border-[#FDE68A] px-2.5 py-1 rounded-full font-medium">
                                        Menunggu Pembayaran
                                    </span>
                                @elseif($booking->status == 'Selesai')
                                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 px-2.5 py-1 rounded-full font-medium">
                                        Selesai
                                    </span>
                                @else
                                    <span class="bg-red-50 text-red-600 border border-red-200 px-2.5 py-1 rounded-full font-medium">
                                        Dibatalkan
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-400">Tidak ada data pemesanan pada rentang tanggal ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // 1. Inisialisasi Chart Batang Dinamis
        const ctxBar = document.getElementById('chartPendapatan').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: {{ Js::from($chartLabels) }},
                datasets: [{
                    label: 'Pendapatan',
                    data: {{ Js::from($chartData) }},
                    backgroundColor: '#3B82F6', 
                    borderRadius: 8,
                    barThickness: 50 // Disesuaikan agar tetap proporsional saat data bertambah
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                if (value === 0) return '0';
                                return (value / 1000) + 'k'; 
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // 2. Inisialisasi Chart Lingkaran Dinamis
        const ctxPie = document.getElementById('chartStatus').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: {{ Js::from($pieLabels) }},
                datasets: [{
                    data: {{ Js::from($pieData) }},
                    backgroundColor: ['#D97706', '#10B981', '#EF4444'], // Jingga (Menunggu), Hijau (Selesai), Merah (Batal)
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            boxWidth: 12,
                            font: { size: 11, family: 'sans-serif' },
                            color: '#4B5563'
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>