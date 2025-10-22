@extends('layouts.navbar-user')

@section('title', 'Dashboard')

@section('content')


    <div class="ml-18 mt-4 p-4">
        <h2 class="text-4xl font-bold text-blue-700 mb-4">Dashboard Safety</h2>
        <p class="text-gray-700 mb-6">
            Selamat datang di sistem <span class="font-semibold">SafetyApp</span>. Pastikan semua aktivitas kerja
            berlangsung aman dan sesuai prosedur.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-blue-50 p-4 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-blue-800">Pentingnya APD</h3>
                <p class="text-sm text-gray-700 mt-2">Gunakan Alat Pelindung Diri untuk menghindari risiko cedera.</p>
            </div>

            <div class="bg-blue-50 p-4 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-blue-800">Area Aman</h3>
                <p class="text-sm text-gray-700 mt-2">Pastikan area kerja bersih dari hambatan dan tanda peringatan
                    terlihat.</p>
            </div>

            <div class="bg-blue-50 p-4 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-blue-800">Inspeksi Rutin</h3>
                <p class="text-sm text-gray-700 mt-2">Periksa alat berat dan area kerja secara rutin untuk mencegah bahaya.
                </p>
            </div>
        </div>
    </div>

    {{-- Grid 2 kolom untuk chart --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">

        {{-- CARD 1 - Total Manpower --}}
        <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-medium text-gray-700 mb-4">
                Total Manpower
            </h3>

            <canvas id="manpowerChart" data-labels='@json($labelsManpower)' data-data='@json($dataManpower)' width="400"
                height="400">
            </canvas>
        </div>

        {{-- card 2 - Gender Manpower --}}
        <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-medium text-gray-700 mb-4">
                Gender Manpower</h3>
            <canvas id="genderChart" data-labels='@json($labelsGender)' data-data='@json($dataGender)' width="400"
                height="200">
            </canvas>
        </div>

        {{-- CARD 3 - Total Manhours (Gunung) --}}
        <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-medium text-gray-700 mb-4">
                Total Manhours
            </h3>
            <canvas id="manhoursChart" data-labels='@json($labelsManhours)' data-data='@json($dataManhours)' width="400"
                height="500">
            </canvas>
        </div>

        {{-- Card 4 - Sites Per Category --}}
        <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-medium text-gray-700 mb-4">
                Total Sites
            </h3>
            <canvas id="categoryChart" data-labels='@json($labelsSite)' data-data='@json($dataSite)' width="400"
                height="200">
            </canvas>
        </div>




    </div>

    

@endsection