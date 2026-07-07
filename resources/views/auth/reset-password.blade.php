<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password - TravelKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-900 min-h-screen flex flex-col justify-center items-center p-4 antialiased">

    <div class="w-full max-w-[460px] flex flex-col items-center">
        
        <h1 class="text-2xl font-bold text-slate-900 mb-2 tracking-tight">Atur Ulang Password</h1>
        <p class="text-gray-500 text-xs text-center mb-6 px-4">Silakan masukkan password baru Anda untuk mengamankan akun kembali.</p>

        <div class="w-full bg-white border border-gray-100 rounded-2xl p-7 shadow-sm">
            
            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-600 text-xs p-3 rounded-xl font-medium">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-4">
                    <label for="email" class="block text-xs font-semibold text-slate-700 mb-2">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                        class="w-full bg-gray-50 border border-gray-200 text-gray-500 text-xs rounded-xl p-3 outline-none cursor-not-allowed">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-xs font-semibold text-slate-700 mb-2">Password Baru</label>
                    <input type="password" id="password" name="password" required autofocus autocomplete="new-password" placeholder="Minimal 8 karakter"
                        class="w-full border border-gray-200 focus:border-blue-500 text-xs rounded-xl p-3 outline-none transition">
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password baru"
                        class="w-full border border-gray-200 focus:border-blue-500 text-xs rounded-xl p-3 outline-none transition">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl text-xs transition shadow-md shadow-blue-600/10">
                    Perbarui Password
                </button>
            </form>
        </div>
    </div>
</body>
</html>