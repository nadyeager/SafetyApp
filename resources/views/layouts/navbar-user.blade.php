<nav class="bg-gray-800" x-data="{ open: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <!-- Brand -->
      <div class="flex-shrink-0 flex items-center">
        <a href="#" class="text-white font-bold text-xl">MyDashboard</a>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex md:items-center md:space-x-6">
        <a href="{{ route('user.dashboard') }}" class="text-white hover:text-gray-300">Dashboard</a>
        <a href="{{ route('accidents.index') }}" class="text-white hover:text-gray-300">Accidents</a>
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
  <div x-show="open" @click.away="open = false" class="md:hidden bg-gray-700">
    <div class="px-2 pt-2 pb-3 space-y-1">
      <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 text-white hover:bg-gray-600 rounded">Dashboard</a>
      <a href="{{ route('accidents.index') }}" class="block px-3 py-2 text-white hover:bg-gray-600 rounded">Accidents</a>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full text-left px-3 py-2 text-white hover:bg-red-600 rounded">Logout</button>
      </form>
    </div>
  </div>
</nav>
