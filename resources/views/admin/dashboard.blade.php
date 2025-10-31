@extends('layouts.navbar-admin')

@section('content')
<div class="space-y-6">
  <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100 justify-between items-center text-center max-w-sm">

        <div>
            <form action="{{ route('admin.dashboard') }}" method="GET">
                <h2 class="text-xl font-semibold mb-3">Data Terakhir Diperbarui</h2>
                <label for="month" class="font-semibold">Pilih Bulan</label>
                <input type="month" id="month" name="month" value="{{ $month }}" onchange="this.form.submit()" class="border border-gray-300 rounded-md p-2 ml-4">
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">


    {{-- CARD 1: Distribusi Site / Cabang --}}
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
      <h3 class="text-lg font-medium text-gray-700 mb-4">Distribusi Site / Cabang</h3>
      <canvas id="siteDistributionChart"
        data-labels='@json($labelsSiteCategory)'
        data-data='@json($dataSiteCategory)'>
      </canvas>
    </div>

    {{-- CARD 2: Total Manpower --}}
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
      <h3 class="text-lg font-medium text-gray-700 mb-4">Total Manpower</h3>
      <canvas id="manpowerChart"  
        data-labels='@json($labelsManpower)'
        data-organik='@json($dataManpowerOrganik)'
        data-partner='@json($dataManpowerPartner)' width="300" height="300">
      </canvas>
    </div>

    {{-- CARD 3: Gender Manpower --}}
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
      <h3 class="text-lg font-medium text-gray-700 mb-4">Gender Manpower</h3>
      <canvas id="genderChart"
        data-labels='@json($labelsGender)'
        data-organik='@json($dataGenderOrganik)'
        data-partner='@json($dataGenderPartner)'>
      </canvas>
    </div>
    </div>

    {{-- CARD 4: Total Manhours --}}
        <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mt-6 mb-6">
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
      <h3 class="text-lg font-medium text-gray-700 mb-4">Total Manhours</h3>
      <canvas id="manhoursChart"
        data-labels='@json($labelsManhours)'
        data-organik='@json($dataManhoursOrganik)'
        data-partner='@json($dataManhoursPartner)'>
      </canvas>
    </div>


    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
      <h3 class="text-lg font-medium text-gray-700 mb-4">Struktural Safety</h3>
      <canvas id="manhoursByCategoryChart"></canvas>
        </div>
</div>
@endsection
