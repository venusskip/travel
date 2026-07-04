<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - TravelKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-900 min-h-screen flex flex-col justify-center items-center p-4 antialiased">

    <div class="w-full max-w-[440px] flex flex-col items-center">
        
        <div class="mb-5 bg-blue-600 text-white p-3.5 rounded-2xl shadow-md shadow-blue-600/20 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-slate-900 mb-1 tracking-tight">Reset password</h1>
        <p class="text-gray-400 text-xs mb-8">We'll send you a link to reset it</p>

        <div class="w-full bg-white border border-gray-100 rounded-2xl p-7 shadow-sm mb-6">
            
            @if (session('status'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-600 text-xs p-3 rounded-xl font-medium">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-600 text-xs p-3 rounded-xl font-medium">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-slate-800 mb-2" for="email">Email address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </span>
                        <input class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-xs text-gray-700 placeholder-gray-300 focus:outline-none focus:border-blue-500 transition font-medium" 
                        type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl text-xs transition shadow-md shadow-blue-600/10 pt-3.5 pb-3.5">
                    Send reset link
                </button>
            </form>

        </div>

        <a href="{{ route('login') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-blue-600 hover:underline transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Back to log in</span>
        </a>

    </div>

</body>
</html>