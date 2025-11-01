<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
  
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
        <!-- Sidebar -->
<aside 
    class="w-64 bg-blue-700 text-white fixed inset-y-0 left-0 z-50 transform transition-transform duration-300 ease-in-out md:translate-x-0"
    :class="{ '-translate-x-full': !sidebarOpen }"
>
    <!-- Header Sidebar -->
    <div class="p-4 border-b border-blue-600 flex items-center justify-between">
        <h1 class="text-xl font-bold">Dashboard Admin</h1>
        <!-- Tombol close di mobile -->
        <button class="md:hidden text-white text-xl font-bold" @click="sidebarOpen = false">×</button>
    </div>

    <!-- Navigasi -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-1">
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors"
           :class="{ 'bg-blue-900 font-semibold': '{{ request()->routeIs('admin.dashboard') }}' }">
            <i data-lucide="home" class="w-5 h-5"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.accident.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors"
           :class="{ 'bg-blue-900 font-semibold': '{{ request()->routeIs('admin.accident.*') }}' }">
            <i data-lucide="alert-triangle" class="w-5 h-5"></i>
            Accident Investigation
        </a>

        <a href="{{ route('admin.inspection.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors"
           :class="{ 'bg-blue-900 font-semibold': '{{ request()->routeIs('admin.inspection.*') }}' }">
            <i data-lucide="check-square" class="w-5 h-5"></i>
            Inspection
        </a>

        <a href="{{ route('admin.training.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors"
           :class="{ 'bg-blue-900 font-semibold': '{{ request()->routeIs('admin.training.*') }}' }">
            <i data-lucide="book" class="w-5 h-5"></i>
            Training
        </a>

        <a href="{{ route('admin.certification.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors"
           :class="{ 'bg-blue-900 font-semibold': '{{ request()->routeIs('admin.certification.*') }}' }">
            <i data-lucide="award" class="w-5 h-5"></i>
            Certification
        </a>

        <a href="{{ route('admin.assessment.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors"
           :class="{ 'bg-blue-900 font-semibold': '{{ request()->routeIs('admin.assessment.*') }}' }">
            <i data-lucide="clipboard" class="w-5 h-5"></i>
            Assessment
        </a>

        <a href="{{ route('admin.safetyActivity.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors"
           :class="{ 'bg-blue-900 font-semibold': '{{ request()->routeIs('admin.safetyActivity.*') }}' }">
            <i data-lucide="activity" class="w-5 h-5"></i>
            Safety Activity
        </a>

        <a href="{{ route('admin.manhour.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors"
           :class="{ 'bg-blue-900 font-semibold': '{{ request()->routeIs('admin.manhour.*') }}' }">
            <i data-lucide="clock" class="w-5 h-5"></i>
            Man Hour
        </a>

        <a href="{{ route('admin.manpower.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors"
           :class="{ 'bg-blue-900 font-semibold': '{{ request()->routeIs('admin.manpower.*') }}' }">
            <i data-lucide="users" class="w-5 h-5"></i>
            Man Power
        </a>

        <a href="{{ route('admin.user.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors"
           :class="{ 'bg-blue-900 font-semibold': '{{ request()->routeIs('admin.user.*') }}' }">
            <i data-lucide="user" class="w-5 h-5"></i>
            Users
        </a>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-blue-600 mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-red-600 transition-colors">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                Logout
            </button>
        </form>
    </div>
</aside>


        <!-- Konten utama -->
        <div class="flex-1 flex flex-col md:ml-64">
            <!-- Navbar atas -->
            <header>
                <button class="md:hidden text-gray-700" @click="sidebarOpen = true">☰</button>
               
            </header>

            <!-- Isi dashboard -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            
        </div>
    </div>
    <script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>

</body>

</html>
