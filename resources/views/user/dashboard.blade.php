@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="ml-18 mt-6 p-6">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Dashboard Safety</h2>
    <p class="text-gray-700 mb-6">
        Selamat datang di sistem <span class="font-semibold">SafetyApp</span>. Pastikan semua aktivitas kerja berlangsung aman dan sesuai prosedur.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-blue-50 p-4 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-blue-800">Pentingnya APD</h3>
            <p class="text-sm text-gray-700 mt-2">Gunakan Alat Pelindung Diri untuk menghindari risiko cedera.</p>
        </div>

        <div class="bg-blue-50 p-4 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-blue-800">Area Aman</h3>
            <p class="text-sm text-gray-700 mt-2">Pastikan area kerja bersih dari hambatan dan tanda peringatan terlihat.</p>
        </div>

        <div class="bg-blue-50 p-4 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-blue-800">Inspeksi Rutin</h3>
            <p class="text-sm text-gray-700 mt-2">Periksa alat berat dan area kerja secara rutin untuk mencegah bahaya.</p>
        </div>
    </div>
</div>
@endsection
