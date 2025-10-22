<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: false }">
    <!-- Overlay hitam di mobile -->
    <div 
        class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        x-transition.opacity
    ></div>

    <!-- Wrapper utama -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside 
            class="w-64 bg-white shadow-lg flex flex-col fixed inset-y-0 left-0 z-50 transform 
                   transition-transform duration-300 ease-in-out
                   md:translate-x-0"
            :class="{ '-translate-x-full': !sidebarOpen }"
        >
            <!-- Header -->
            <div class="p-4 border-b flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-800">Dashboard Admin</h1>
                <!-- Tombol close di mobile -->
                <button class="md:hidden text-gray-500" @click="sidebarOpen = false">X</button>
            </div>

            <!-- Navigasi -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">Dashboard</a>
                <a href="{{ route('admin.accident.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">Accident Investigation</a>
                <a href="{{ route('admin.inspection.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">Inspection</a>
                <a href="{{ route('admin.training.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">Training</a>
                <a href="{{ route('admin.assessment.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">Assessment</a>
                <a href="{{ route('admin.safetyActivity.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">Safety Activity</a>
                <a href="{{ route('admin.manhour.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">Man Hour</a>
                <a href="{{ route('admin.manpower.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">Man Power</a>
                <a href="{{ route('admin.user.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">Users</a>
            </nav>

            <!-- Tombol Logout -->
            <div class="p-4 border-t mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-200">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Konten utama -->
        <div class="flex-1 flex flex-col md:ml-64">
            <!-- Navbar atas -->
            <header class="bg-white shadow p-4 flex items-center justify-between">
                <button class="md:hidden text-gray-700" @click="sidebarOpen = true">☰</button>
                <h2 class="text-lg font-bold text-green-600 items-center justify-start">Safety App</h2>
            </header>

            <!-- Isi dashboard -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
