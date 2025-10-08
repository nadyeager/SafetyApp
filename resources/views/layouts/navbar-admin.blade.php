<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg flex flex-col">
            <div class="p-4 border-b">
                <h1 class="text-xl font-bold text-gray-800">🧱 Admin Panel</h1>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">
                    📊 Dashboard
                </a>

                <a href="{{ route('admin.user.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">
                    👥 Kelola User
                </a>

                <a href="{{ route('sites.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">
                    🏢 Kelola Site
                </a>

                {{-- <a href="{{ route('admin.user.edit') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">
                    📁 edit users
                </a> --}}

                {{-- <a href="{{ route('settings.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">
                    ⚙️ Pengaturan
                </a> --}}
            </nav>

            <div class="p-4 border-t">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-200">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>
</body>
</html>
