<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - TravelKu Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] flex min-h-screen font-sans">

    @include('partials.sidebar')

    <main class="flex-1 p-8">
        
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-800">User</h1>
        </div>

        <!-- NOTIFIKASI SUKSES (Memenuhi Ketentuan 4.3) -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800">Manajemen User</h2>
                <!-- Menghitung jumlah user dinamis -->
                <p class="text-sm text-gray-400 mt-1">{{ $users->count() }} pengguna terdaftar</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 text-xs font-medium uppercase tracking-wider">
                            <th class="pb-4 font-semibold w-1/4">Nama</th>
                            <th class="pb-4 font-semibold">Email</th>
                            <th class="pb-4 font-semibold">No HP</th>
                            <th class="pb-4 font-semibold">Alamat</th>
                            <th class="pb-4 font-semibold">Role (Ubah Otomatis)</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-600 divide-y divide-gray-50">
                        
                        <!-- LOOPING DATA DARI DATABASE (Memenuhi Ketentuan 3.3) -->
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-sm select-none">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="font-bold text-gray-800">{{ $user->name }}</span>
                            </td>
                            <td class="py-4 text-gray-500">{{ $user->email }}</td>
                            <td class="py-4 text-gray-400">{{ $user->phone ?? '-' }}</td>
                            <td class="py-4 text-gray-400">{{ $user->address ?? '-' }}</td>
                            <td class="py-4">
                                <!-- FORM EDIT ROLE LANGSUNG DI TABEL (Memenuhi Ketentuan 2.4) -->
                                <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" onchange="this.form.submit()" 
                                        class="text-xs font-semibold tracking-wide px-3 py-1 rounded-full cursor-pointer border-none outline-none focus:ring-2 focus:ring-purple-300
                                        {{ $user->role === 'admin' ? 'bg-[#F3E8FF] text-[#A855F7]' : 'bg-gray-100 text-gray-600' }}">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>user</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>