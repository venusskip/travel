<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Tiket TravelKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-6 text-center border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Verifikasi Tiket TravelKu</h2>

        @if($tipe === 'success')
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl font-medium mb-4 text-sm">
                ✅ {{ $pesan }}
            </div>
        @elseif($tipe === 'warning')
            <div class="bg-amber-50 border border-amber-200 text-amber-700 p-4 rounded-xl font-medium mb-4 text-sm">
                ⚠️ {{ $pesan }}
            </div>
        @else
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl font-medium mb-4 text-sm">
                ❌ {{ $pesan }}
            </div>
        @endif

        <div class="text-left bg-gray-50 p-4 rounded-xl text-xs space-y-2 text-gray-600">
            <p><strong>Kode Booking:</strong> #{{ $booking->kode_pemesanan }}</p>
            <p><strong>Penumpang:</strong> {{ $booking->nama_penumpang }}</p>
            <p><strong>Travel:</strong> {{ $booking->nama_travel }}</p>
            <p><strong>Rute:</strong> {{ $booking->kota_asal }} ke {{ $booking->kota_tujuan }}</p>
            <p><strong>Kursi:</strong> {{ implode(', ', $booking->kursi_dipilih) }}</p>
        </div>
        
        <p class="text-[11px] text-gray-400 mt-4">Sistem Validasi Tiket Otomatis &copy; {{ date('Y') }} TravelKu</p>
    </div>

</body>
</html>