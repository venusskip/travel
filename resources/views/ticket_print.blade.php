<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket-{{ $booking->kode_pemesanan }}</title>
    <!-- Memakai Tailwind CSS agar tampilan mewah -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Script QR Code Mandiri (Bekerja offline & lokal di browser) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { background-color: white; }
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4">

    <!-- Tombol Bantuan jika print otomatis tidak muncul -->
    <div class="no-print mb-4 space-x-2">
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
            Klik Cetak / Simpan PDF
        </button>
        <a href="{{ route('riwayat') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-lg shadow">
            Kembali ke Riwayat
        </a>
    </div>

    <!-- Area Tiket -->
    <div class="max-w-md w-full bg-white border-2 border-dashed border-gray-300 rounded-2xl p-6 shadow-md">
        <div class="text-center border-b-2 border-gray-100 pb-4">
            <h1 class="text-2xl font-bold text-blue-600 tracking-tight">TravelKu E-TICKET</h1>
            <p class="font-mono text-sm text-gray-500 font-semibold mt-1">#{{ $booking->kode_pemesanan }}</p>
        </div>

        <div class="mt-6 space-y-3 text-sm text-gray-700">
            <div class="flex justify-between">
                <span class="text-gray-400 font-medium">Nama Travel:</span>
                <span class="font-bold text-right">{{ $booking->nama_travel }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-400 font-medium">Layanan:</span>
                <span class="font-semibold text-right">{{ $booking->jenis_layanan ?? 'Travel Antar Kota' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-400 font-medium">Rute:</span>
                <span class="font-bold text-blue-600 text-right">{{ $booking->kota_asal }} &rarr; {{ $booking->kota_tujuan }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-400 font-medium">Jadwal Berangkat:</span>
                <span class="font-semibold text-right">{{ $booking->tanggal_berangkat->format('d M Y') }} - {{ $booking->jam_berangkat }}</span>
            </div>
            <hr class="border-gray-100 my-2">
            <div class="flex justify-between">
                <span class="text-gray-400 font-medium">Nama Penumpang:</span>
                <span class="font-semibold text-right">{{ $booking->nama_penumpang }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-400 font-medium">Jumlah / Kursi:</span>
                <span class="font-semibold text-right">{{ $booking->jumlah_tiket }} Tiket (Kursi: {{ implode(', ', $booking->kursi_dipilih) }})</span>
            </div>
            <div class="flex justify-between items-center pt-2">
                <span class="text-gray-400 font-medium">Total Pembayaran:</span>
                <span class="text-lg font-extrabold text-green-600">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Bagian QR Code Otomatis Javascript -->
        <div class="mt-6 pt-4 border-t border-gray-100 text-center flex flex-col items-center justify-center">
            <p class="text-xs text-gray-400 mb-3">Tunjukkan QR Code ini kepada supir saat naik kendaraan</p>
            
            <!-- Tempat QR Code akan digambar otomatis -->
            <div id="qrcode-canvas" class="p-2 border border-gray-200 rounded-xl bg-white"></div>
            
            <span class="text-[10px] text-green-600 font-bold bg-green-50 px-2 py-0.5 rounded mt-3 border border-green-200">TIKET VALID & LUNAS</span>
        </div>
    </div>

    <!-- Logika Otomatis Javascript untuk Membuat QR Code -->
    <script type="text/javascript">
        // Ambil URL Scan Unik dari Laravel
        var urlScan = "{{ route('booking.scan', $booking->id) }}";
        
        // Perintahkan qrcode.js menggambar kotak QR di dalam div #qrcode-canvas
        var qrcode = new QRCode(document.getElementById("qrcode-canvas"), {
            text: urlScan,
            width: 140,
            height: 140,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });

        // Jalankan perintah print otomatis setelah QR Code selesai digambar browser
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500); // Tunggu setengah detik agar gambar selesai diproses sempurna
        };
    </script>

</body>
</html>