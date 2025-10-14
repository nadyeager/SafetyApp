<div class="w-full">
  <!-- Top thin green strip -->
  <div class="bg-green-200 text-gray-800 text-xs sm:text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-8">
      <div class="flex items-center space-x-2">
        <span class="font-medium">Monday - Friday</span>
        <span class="text-gray-600">| 08.00 - 17.00</span>
      </div>
       <div class="flex items-center">
          <a href="{{ route('user.dashboard') ?? url('/') }}" class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-[90px] h-[60px] object-contain" />
          </a>
        </div>
      <div id="top-date-time" class="text-right text-sm font-medium"></div>
    </div>
    <script>
    function updateTopDateTime() {
        const now = new Date();

        // Hari & bulan versi Indonesia
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        const dayName = days[now.getDay()];
        const date = now.getDate();
        const month = months[now.getMonth()];
        const year = now.getFullYear();

        // Format jam dua digit
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
 

        // Gabung jadi satu teks
        const formatted = `${dayName}, ${date} ${month} ${year} | ${hours}:${minutes}`;

        // Masukkan ke dalam elemen
        document.getElementById('top-date-time').textContent = formatted;
    }

    // Panggil setiap detik
    setInterval(updateTopDateTime, 1000);
    // Jalankan pertama kali pas halaman dimuat
    updateTopDateTime();
</script>

  </div>

<nav class="bg-blue-400 bg-transparent-90" x-data="{ open: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
            <div class="flex items-center">

        </div>
      <!-- Brand -->
      <!-- <div class="flex-shrink-0 flex items-center">
        <a href="#" class="text-white font-bold text-xl">MyDashboard</a>
      </div> -->

      <!-- Desktop Menu -->
      <div class="hidden md:flex md:items-center md:space-x-6">
        <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-gray-300">Dashboard</a>
        <a href="{{ route('accidents.index') }}" class="text-gray-600 hover:text-gray-300">Accidents</a>
        <a href="{{ route('inspections.index') }}" class="text-gray-600 hover:text-gray-300">Inspections</a>
        <a href="{{ route('trainings.index') }}" class="text-gray-600 hover:text-gray-300">Trainings</a>
        <a href="{{ route('assessments.index') }}" class="text-gray-600 hover:text-gray-300">Assessments</a>
        <a href="{{ route('safety-activities.index') }}" class="text-gray-600 hover:text-gray-300">Safety Activities</a>
        <a href="{{ route('manhours.index') }}" class="text-gray-600 hover:text-gray-300">Man Hours</a>
        <a href="{{ route('manpowers.index') }}" class="text-gray-600 hover:text-gray-300">Man Power</a>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="text-white hover:text-red-400 bg-transparent border-0 cursor-pointer">Logout</button>
        </form>
      </div>

      <!-- Mobile menu button -->
      <div class="flex items-center md:hidden">
        <button @click="open = !open" type="button" class="text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
          <svg class="h-6 w-6" x-show="!open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
          </svg>
          <svg class="h-6 w-6" x-show="open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div x-show="open" @click.away="open = false" class="md:hidden bg-blue-400">
    <div class="px-2 pt-2 pb-3 space-y-1">
      <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 text-white hover:bg-gray-600 rounded">Dashboard</a>
      <a href="{{ route('accidents.index') }}" class="block px-3 py-2 text-white hover:bg-gray-600 rounded">Accidents</a>
      <a href="{{ route('inspections.index') }}" class="block px-3 py-2 text-white hover:bg-gray-600 rounded">Inspections</a>
      <a href="{{ route('trainings.index') }}" class="block px-3 py-2 text-white hover:bg-gray-600 rounded">Trainings</a>
      <a href="{{ route('assessments.index') }}" class="block px-3 py-2 text-white hover:bg-gray-600 rounded">Assessments</a>
      <a href="{{ route('safety-activities.index') }}" class="block px-3 py-2 text-white hover:bg-gray-600 rounded">Safety Activities</a>
      <a href="{{ route('manhours.index') }}" class="block px-3 py-2 text-white hover:bg-gray-600 rounded">Man Hours</a>
      <a href="{{ route('manpowers.index') }}" class="block px-3 py-2 text-white hover:bg-gray-600 rounded">Man Power</a>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full text-left px-3 py-2 text-white hover:bg-red-600 rounded">Logout</button>
      </form>
    </div>
  </div>
</nav>

