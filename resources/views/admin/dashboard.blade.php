@extends('layouts.navbar')

@section('content')
<div class="space-y-8">


  <h1 class="text-5xl font-bold text-green-600 text-center mt-4">
    Safety <span class="text-blue-900">Bina Pertiwi</span>
  </h1>
  <p class="text-lg text-gray-600 text-center">
    Data terakhir diperbarui: {{ now()->format('d M Y') }}
  </p>


  <div class="bg-white shadow-md rounded-2xl p-3 border border-gray-100 max-w-md mx-auto text-center flex flex-col items-center space-y-3">
   <div class="flex items-center justify-center gap-3 mb-4">
  <i data-lucide="calendar" class="w-10 h-10 text-gray-500"></i>
  <h2 class="text-xl font-semibold text-gray-800">Data Terakhir Diperbarui</h2>

    </div>

    <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center justify-center gap-3 mt-2">
      <label for="month" class="font-medium text-gray-700 -mt-8">Pilih Bulan:</label>
      <input type="month" id="month" name="month" value="{{ $month }}"
             onchange="this.form.submit()"
             class="border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-green-500 focus:outline-none -mt-6">
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
