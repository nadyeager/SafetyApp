@extends('layouts.navbar-user')

@section('title', 'Dashboard')

@section('content')
<div class="ml-0 md:ml-18 -mt-8 p-4">
    <h2 class="text-3xl md:text-4xl text-center font-bold text-green-600 mb-4">Safety Dashboard</h2>
    <p class="text-center text-base md:text-xl text-gray-700 mb-6">
        Selamat datang di sistem <span class="font-semibold">SafetyApp</span>. Pastikan semua aktivitas kerja
        berlangsung aman dan sesuai prosedur.
    </p>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-blue-50 p-6 sm:p-8 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-base md:text-lg font-bold text-blue-800">Pentingnya APD</h3>
            <p class="text-sm text-gray-700 mt-2">Gunakan Alat Pelindung Diri untuk menghindari risiko cedera.</p>
        </div>


        <div class="bg-blue-50 p-6 sm:p-8 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-base md:text-lg font-bold text-blue-800">Area Aman</h3>
            <p class="text-sm text-gray-700 mt-2">
                Pastikan area kerja bersih dari hambatan dan tanda peringatan terlihat.
            </p>
        </div>


        <div class="bg-blue-50 p-6 sm:p-8 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-base md:text-lg font-bold text-blue-800">Inspeksi Rutin</h3>
            <p class="text-sm text-gray-700 mt-2">
                Periksa alat berat dan area kerja secara rutin untuk mencegah bahaya.
            </p>
        </div>
    </div>
</div>


<div class="mb-6 bg-white shadow-md rounded-2xl p-6 border border-gray-100 flex flex-col sm:flex-row justify-center items-center text-center max-w-full sm:max-w-lg mx-auto">
    <form action="{{ route('user.dashboard') }}" method="GET" class="w-full">
        <h2 class="text-lg md:text-xl font-semibold mb-3">Data Terakhir Diperbarui</h2>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-3">
            <label for="month" class="font-semibold text-sm sm:text-base">Pilih Bulan</label>
            <input type="month" id="month" name="month" value="{{ $month }}" onchange="this.form.submit()"
                class="border border-gray-300 rounded-md p-2 w-full sm:w-auto focus:ring-2 focus:ring-green-400 focus:outline-none">
        </div>
    </form>
</div>


  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

    {{-- CARD 1 --}}
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100 flex flex-col items-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <i data-lucide="git-branch" class="w-8 h-8 text-blue-800"></i>
        <h3 class="text-lg font-semibold text-gray-700">Distribusi Site / Cabang</h3>
      </div>
      <canvas id="siteDistributionChart"
              data-labels='@json($labelsSiteCategory)'
              data-data='@json($dataSiteCategory)'
              width="260" height="260">
      </canvas>
    </div>

    {{-- CARD 2 --}}
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100 flex flex-col items-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <i data-lucide="users" class="w-8 h-8 text-green-700"></i>
        <h3 class="text-lg font-semibold text-gray-700">Total Manpower</h3>
      </div>
      <canvas id="manpowerChart"
              data-labels='@json($labelsManpower)'
              data-organik='@json($dataManpowerOrganik)'
              data-partner='@json($dataManpowerPartner)'
              width="260" height="260">
      </canvas>
    </div>

    {{-- CARD 3 --}}
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100 flex flex-col items-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <i data-lucide="user" class="w-8 h-8 text-yellow-500"></i>
        <h3 class="text-lg font-semibold text-gray-700">Gender Manpower</h3>
      </div>
      <canvas id="genderChart"
              data-labels='@json($labelsGender)'
              data-organik='@json($dataGenderOrganik)'
              data-partner='@json($dataGenderPartner)'
              width="260" height="260">
      </canvas>
    </div>

  </div>

<div class="grid grid-cols-2 sm:grid-cols-2 gap-6 mt-6">

  {{-- CARD 4 --}}
  <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100 flex flex-col items-center">
    <div class="flex items-center justify-center gap-3 mb-4">
      <i data-lucide="clock" class="w-8 h-8 text-red-700"></i>
      <h3 class="text-lg font-semibold text-gray-700">Total Manhours</h3>
    </div>  
    <canvas id="manhoursChart"
            data-labels='@json($labelsManhours)'
            data-organik='@json($dataManhoursOrganik)'
            data-partner='@json($dataManhoursPartner)'>
    </canvas>
  </div>

  {{-- CARD 5 --}}
  <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100 flex flex-col items-center">
    <div class="flex items-center justify-center gap-3 mb-4">
      <i data-lucide="shield-check" class="w-8 h-8 text-indigo-700"></i>
      <h3 class="text-lg font-semibold text-gray-700">Struktural Safety</h3>
    </div>
    <canvas id="manhoursByCategoryChart"></canvas>
  </div>

</div> 


@endsection


