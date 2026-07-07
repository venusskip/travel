<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - TravelKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-900 min-h-screen flex flex-col justify-center items-center p-4 antialiased">

    <div class="w-full max-w-[460px] flex flex-col items-center">
        
        <div class="mb-5 bg-blue-600 text-white p-3.5 rounded-2xl shadow-md shadow-blue-600/20 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l8-5.333a2 2 0 012.22 0l8 5.333A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-2.25-1.5a2 2 0 00-2.22 0l-2.25 1.5M7.5 12h9"></path>
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-slate-900 mb-2 tracking-tight">Verifikasi Email Anda</h1>
        <p class="text-gray-500 text-xs text-center mb-8 px-4">Terima kasih telah mendaftar! Sebelum melangkah lebih jauh, mohon konfirmasi email Anda dengan mengklik tautan yang baru saja kami kirimkan.</p>

        <div class="w-full bg-white border border-gray-100 rounded-2xl p-7 shadow-sm mb-6">
            
            @if (session('status') == 'verification-link-sent')
                <div class="mb-5 bg-green-50 border border-green-200 text-green-600 text-xs p-3 rounded-xl font-medium text-center">
                    Tautan verifikasi baru telah dikirim ke alamat email Anda.
                </div>
            @endif

            <div class="flex flex-col space-y-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl text-xs transition shadow-md shadow-blue-600/10">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 font-semibold py-3 px-4 rounded-xl text-xs transition text-center">
                        Keluar / Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>