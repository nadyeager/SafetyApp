@extends('layouts.app')

@section('content')
<div class="container mx-auto space-y-6 ">

    <div class="bg-white rounded-xl shadow p-6 flex items-center justify-between">
    <div>

    <h2 class="text-xl font-semibold">Data Terakhir Di Perbarui</h2>
    <p class="text-gray-600 mt-1">Bulan: <span class="font-medium text-blue-600">{{ $lastUpdatedMonth }}</span></p>
    </div>
     <div class="text-sm text-gray-500">Dashboard Admin</div>
    </div>


    {{-- Grid 2 kolom untuk chart --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">

        {{-- CARD 1 - Total Manpower --}}
        <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-medium text-gray-700 mb-4">
                Total Manpower
            </h3>
            <canvas id="manpowerChart"   
                data-labels='@json($labelsManpower)'
                data-data='@json($dataManpower)'
                width="400"
                height="200">
            </canvas>
        </div>

{{-- card 2 - Gender Manpower --}}
          <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-medium text-gray-700 mb-4">
                Gender Manpower</h3>
            <canvas id="genderChart"
                data-labels='@json($labelsGender)'
                data-data='@json($dataGender)'
                width="400"
                height="200">
            </canvas>
            </div>

        {{-- CARD 3 - Total Manhours (Gunung) --}}
        <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-medium text-gray-700 mb-4">
             Total Manhours 
            </h3>
            <canvas id="manhoursChart"
                data-labels='@json($labelsManhours)'
                data-data='@json($dataManhours)'
                width="400"
                height="200">
            </canvas>
        </div>

       {{-- Card 4 - Sites Per Category --}}
        <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-medium text-gray-700 mb-4">
             Total Sites
            </h3>
            <canvas id="categoryChart"
                data-labels='@json($labelsSite)'
                data-data='@json($dataSite)'
                width="400"
                height="200">
            </canvas>
        </div>

       
      

    </div>
</div>
@endsection
