@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="container">
    <h1 class="text-2xl font-semibold mb-4">Selamat Datang Di <span class="text-blue-600">Safety App</span></h1>
    <p class="text-gray-900 font-sans mb-1">Platform keselamatan kerja digital yang membantu memastikan lingkungan kerja lebih aman, efisien, dan terkendali</p>
    <p class="text-green-600 font-bold mb-3">Karena keselamatan adalah tanggung jawab bersama</p>
</div>


<footer class="bg-gray-100 border-t mt-10">
    <div class="max-w-6xl mx-auto px-6 py-10 text-center">
       
        <p class="text-lg italic text-gray-700 mb-4">
            “Tidak ada pekerjaan yang begitu penting sehingga kita tidak punya waktu untuk melakukannya dengan aman.”
        </p>
        <p class="text-gray-600 font-medium mb-6">— Safety Department</p>

      
        <div class="border-t border-gray-300 my-6"></div>

 
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Butuh bantuan?</h2>
        <ul class="text-gray-600 space-y-2">
            <li> Hubungi tim HSE: <a href="mailto:hse@safetyapp.com" class="text-blue-600 hover:underline">hse@safetyapp.com</a></li>
            <li> Hotline darurat: <span class="font-semibold">(021) 1234 5678</span></li>
            <li> Panduan penggunaan: <a href="#" class="text-blue-600 hover:underline">Klik di sini</a></li>
        </ul>

      
        <div class="mt-8 text-sm text-gray-500">
            © {{ date('Y') }} SafetyApp. Semua hak dilindungi.
        </div>
    </div>
</footer>

@endsection
