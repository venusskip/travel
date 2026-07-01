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

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800">Manajemen User</h2>
                <p class="text-sm text-gray-400 mt-1">1 pengguna terdaftar</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 text-xs font-medium uppercase tracking-wider">
                            <th class="pb-4 font-semibold w-1/4">Nama</th>
                            <th class="pb-4 font-semibold">Email</th>
                            <th class="pb-4 font-semibold">No HP</th>
                            <th class="pb-4 font-semibold">Alamat</th>
                            <th class="pb-4 font-semibold">Role</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-600 divide-y divide-gray-50">
                        
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-sm select-none">
                                    R
                                </div>
                                <span class="font-bold text-gray-800">Rahmat Dhani</span>
                            </td>
                            <td class="py-4 text-gray-500">rahmatdhaniii38@gmail.com</td>
                            <td class="py-4 text-gray-400">-</td>
                            <td class="py-4 text-gray-400">-</td>
                            <td class="py-4">
                                <span class="bg-[#F3E8FF] text-[#A855F7] px-3 py-1 rounded-full text-xs font-semibold tracking-wide">
                                    admin
                                </span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>