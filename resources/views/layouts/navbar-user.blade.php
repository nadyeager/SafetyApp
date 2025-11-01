<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-[Poppins] bg-gray-100 h-screen overflow-hidden antialiased">
  <!-- Overlay (untuk mobile) -->
  <div 
    class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
    x-show="sidebarOpen"
    @click="sidebarOpen = false"
    x-transition.opacity>
  </div>

  <div class="flex h-full">

    <!-- SIDEBAR -->
    <aside 
      class="w-64 bg-blue-700 text-white fixed inset-y-0 left-0 z-50 flex flex-col transform transition-transform duration-300 ease-in-out md:translate-x-0"
      :class="{ '-translate-x-full': !sidebarOpen }">

      <!-- Header Sidebar -->
      <div class="p-4 border-b border-blue-600 flex items-center justify-between">
        <h1 class="text-xl font-bold">Safety App</h1>
        <button class="md:hidden text-white text-lg" @click="sidebarOpen = false">×</button>
      </div>

      <!-- Navigasi -->
      <nav class="flex-1 overflow-y-auto p-4 space-y-1">
        <a href="{{ route('user.dashboard') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors {{ request()->routeIs('user.dashboard') ? 'bg-blue-900 font-semibold' : '' }}">
          <i data-lucide="home" class="w-5 h-5"></i>
          Dashboard
        </a>

        <a href="{{ route('accidents.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors {{ request()->routeIs('accidents.*') ? 'bg-blue-900 font-semibold' : '' }}">
          <i data-lucide="alert-triangle" class="w-5 h-5"></i>
          Accidents
        </a>

        <a href="{{ route('assessments.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors {{ request()->routeIs('assessments.*') ? 'bg-blue-900 font-semibold' : '' }}">
          <i data-lucide="clipboard-check" class="w-5 h-5"></i>
          Assessments
        </a>

        <a href="{{ route('certifications.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors {{ request()->routeIs('certifications.*') ? 'bg-blue-900 font-semibold' : '' }}">
          <i data-lucide="award" class="w-5 h-5"></i>
          Certification
        </a>

        <a href="{{ route('inspections.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors {{ request()->routeIs('inspections.*') ? 'bg-blue-900 font-semibold' : '' }}">
          <i data-lucide="search-check" class="w-5 h-5"></i>
          Inspections
        </a>

        <a href="{{ route('trainings.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors {{ request()->routeIs('trainings.*') ? 'bg-blue-900 font-semibold' : '' }}">
          <i data-lucide="book" class="w-5 h-5"></i>
          Trainings
        </a>

        <a href="{{ route('safety-activities.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors {{ request()->routeIs('safety-activities.*') ? 'bg-blue-900 font-semibold' : '' }}">
          <i data-lucide="activity" class="w-5 h-5"></i>
          Safety Activities
        </a>

        <a href="{{ route('manhours.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors {{ request()->routeIs('manhours.*') ? 'bg-blue-900 font-semibold' : '' }}">
          <i data-lucide="clock" class="w-5 h-5"></i>
          Man Hours
        </a>

        <a href="{{ route('manpowers.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors {{ request()->routeIs('manpowers.*') ? 'bg-blue-900 font-semibold' : '' }}">
          <i data-lucide="users" class="w-5 h-5"></i>
          Man Power
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

    <!-- KONTEN UTAMA -->
    <div class="flex-1 flex flex-col md:ml-64 overflow-hidden">

      <!-- Navbar Atas -->
      <header class="bg-white shadow p-4 flex items-center justify-between fixed top-0 left-0 right-0 md:left-64 z-30">
        <button class="md:hidden text-gray-700" @click="sidebarOpen = true">☰</button>

        <div class="text-sm text-gray-600 font-medium" id="top-date-time"></div>

        <div class="flex items-center space-x-3">
          <span class="text-gray-700 font-medium"> Halo, {{ Auth::user()->name ?? 'User' }}</span>
        </div>
      </header>

      <!-- Isi Halaman -->
      <main class="flex-1 overflow-y-auto p-6 mt-16">
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Script Lucide + Jam -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    lucide.createIcons();
    function updateTopDateTime() {
      const now = new Date();
      const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
      const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
      const formatted = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()} | ${now.getHours().toString().padStart(2,'0')}:${now.getMinutes().toString().padStart(2,'0')}`;
      document.getElementById('top-date-time').textContent = formatted;
    }
    updateTopDateTime();
    setInterval(updateTopDateTime, 1000);
  </script>
</body>
</html>
