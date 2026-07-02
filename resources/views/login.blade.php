<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TravelKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-900 min-h-screen flex flex-col justify-center items-center p-4 antialiased">

    <div class="w-full max-w-[440px] flex flex-col items-center">
        
        <div class="mb-5 bg-blue-600 text-white p-3.5 rounded-2xl shadow-md shadow-blue-600/20 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h3a3 3 0 013 3v1"></path>
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-slate-900 mb-1 tracking-tight">Welcome back</h1>
        <p class="text-gray-400 text-xs mb-8">Log in to your account</p>

        <div class="w-full bg-white border border-gray-100 rounded-2xl p-7 shadow-sm mb-6">
            
            <button class="w-full border border-gray-200 hover:bg-gray-50 text-gray-700 font-semibold text-xs py-3 px-4 rounded-xl flex items-center justify-center space-x-2.5 transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24">
                    <path fill="#EA4335" d="M12.24 10.285V14.4h6.887c-.275 1.565-1.88 4.604-6.887 4.604-4.33 0-7.866-3.577-7.866-8s3.536-8 7.866-8c2.46 0 4.105 1.025 5.047 1.926l3.256-3.133C18.417.99 15.564 0 12.24 0 5.48 0 0 5.37 0 12s5.48 12 12.24 12c7.06 0 11.758-4.918 11.758-11.83 0-.796-.08-1.4-.184-1.885H12.24z"/>
                </svg>
                <span>Continue with Google</span>
            </button>

            <div class="relative flex py-5 items-center">
                <div class="flex-grow border-t border-gray-100"></div>
                <span class="flex-shrink mx-3 text-[10px] font-bold text-gray-300 uppercase tracking-wider">OR</span>
                <div class="flex-grow border-t border-gray-100"></div>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 text-xs p-3 rounded-xl font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-xs font-bold text-slate-800 mb-2" for="email">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </span>
                        <input class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-xs text-gray-700 placeholder-gray-300 focus:outline-none focus:border-blue-500 transition font-medium" 
                               type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-bold text-slate-800" for="password">Password</label>
                        <a href="{{ route('password.request') }}" class="text-[11px] font-semibold text-blue-600 hover:underline">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </span>
                        <input class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-xs text-gray-700 placeholder-gray-300 focus:outline-none focus:border-blue-500 transition font-medium" 
                        type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl text-xs transition shadow-md shadow-blue-600/10 pt-3.5 pb-3.5">
                    Log in
                </button>
            </form>

        </div>

        <p class="text-xs text-gray-400 font-medium">
            Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Create one</a>
        </p>

    </div>

</body>
</html>