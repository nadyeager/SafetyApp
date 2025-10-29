<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  @vite(['resources/css/app.css', 'resources/js/user-chart.js'])
</head>

<body class="bg-gray-100 font-sans antialiased h-screen overflow-hidden">
  <!-- Overlay (untuk mobile) -->
  <div 
    class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
    x-show="sidebarOpen"
    @click="sidebarOpen = false"
    x-transition.opacity>
  </div>

  <!-- Wrapper utama -->
  <div class="flex h-full">

    <!-- Sidebar -->
    <aside 
      class="w-64 bg-white shadow-lg flex flex-col fixed inset-y-0 left-0 z-50 transform transition-transform duration-300 ease-in-out md:translate-x-0"
      :class="{ '-translate-x-full': !sidebarOpen }">
      
      <!-- Header Sidebar -->
      <div class="p-4 border-b flex items-center justify-between">
        <h1 class="text-xl font-bold text-blue-700">Safety App</h1>
        <button class="md:hidden text-gray-500" @click="sidebarOpen = false">✖</button>
      </div>

      <!-- Navigasi User -->
      <nav class="flex-1 overflow-y-auto p-4 space-y-2 text-gray-700">
        <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 text-blue-700 hover:bg-blue-50 rounded">Dashboard</a>
        <a href="{{ route('accidents.index') }}" class="block px-3 py-2 text-blue-700 hover:bg-blue-50 rounded">Accidents</a>
        <a href="{{ route('inspections.index') }}" class="block px-3 py-2 text-blue-700 hover:bg-blue-50 rounded">Inspections</a>
        <a href="{{ route('trainings.index') }}" class="block px-3 py-2 text-blue-700 hover:bg-blue-50 rounded">Trainings</a>
        <a href="{{ route('certifications.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-200">Certification</a>
        <a href="{{ route('assessments.index') }}" class="block px-3 py-2 text-blue-700 hover:bg-blue-50 rounded">Assessments</a>
        <a href="{{ route('safety-activities.index') }}" class="block px-3 py-2 text-blue-700 hover:bg-blue-50 rounded">Safety Activities</a>
        <a href="{{ route('manhours.index') }}" class="block px-3 py-2 text-blue-700 hover:bg-blue-50 rounded">Man Hours</a>
        <a href="{{ route('manpowers.index') }}" class="block px-3 py-2 text-blue-700 hover:bg-blue-50 rounded">Man Power</a>
      </nav>

      <!-- Logout -->
      <div class="p-4 border-t mt-auto">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full text-left px-3 py-2 rounded-lg hover:bg-red-300">
            🚪 Logout
          </button>
        </form>
      </div>
    </aside>

    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col md:ml-64 overflow-hidden">

      <!-- Navbar Atas -->
      <header class="bg-white shadow p-4 flex items-center justify-between fixed top-0 left-0 right-0 md:left-64 z-30">
        <button class="md:hidden text-gray-700" @click="sidebarOpen = true">☰</button>
        <div id="top-date-time" class="text-right text-bs font-medium"></div>

        <div class="flex items-center space-x-3">
          <span class="text-gray-600 text-sm">Halo, {{ Auth::user()->name ?? 'User' }}</span>
        </div>

          <script>
        function updateTopDateTime() {
          const now = new Date();
          const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
          const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
          const dayName = days[now.getDay()];
          const date = now.getDate();
          const month = months[now.getMonth()];
          const year = now.getFullYear();
          const hours = String(now.getHours()).padStart(2,'0');
          const minutes = String(now.getMinutes()).padStart(2,'0');
          const formatted = `${dayName}, ${date} ${month} ${year} | ${hours}:${minutes}`;
          const el = document.getElementById('top-date-time');
          if (el) el.textContent = formatted;
        }
        setInterval(updateTopDateTime, 1000);
        updateTopDateTime();
      </script>
      </header>

      <!-- Isi Halaman -->
      <main class="flex-1 overflow-y-auto p-6 mt-16">
        @yield('content')
      </main>
    </div>
  </div>
</body>

</html>