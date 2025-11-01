@extends('layouts.navbar-user')

@section('title', 'Dashboard')

@section('content')


  <div class="relative w-screen left-[50%] right-[50%] ml-[-50vw] mr-[-50vw] overflow-hidden">
    <img src="{{ asset('images/poto.png') }}" alt="poto image"
      class="w-full h-[450px] md:h-[550px] object-cover brightness-75">

    <div class="absolute inset-0 flex items-center justify-center">
      <div class="text-center text-white">
        <h1 class="text-4xl sm:text-6xl font-bold leading-tight">
          Our <span class="text-green-400">Responsibility</span>
        </h1>
        <p class="mt-4 text-lg text-gray-200">
         Helping you stay safe at work
        </p>
      </div>
    </div>
  </div>

  <div class="container mt-10">
    <h1 class="text-2xl font-semibold mb-4">Selamat Datang Di <span class="text-blue-600">Safety App</span></h1>
    <p class="text-gray-900 font-sans mb-1">Platform keselamatan kerja digital yang membantu memastikan lingkungan kerja
      lebih aman, efisien, dan terkendali</p>
    <p class="text-green-600 font-bold mb-3">Karena keselamatan adalah tanggung jawab bersama</p>
  </div>

  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- From Uiverse.io by fthisilak -->
      <div class="mt-10 group relative h-80 w-72 [perspective:1000px]">
        <div
          class="absolute duration-1000 w-full h-full [transform-style:preserve-3d] group-hover:[transform:rotateX(180deg)]">
          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-green-200 to-blue-600 p-6 text-white [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="flex justify-between items-start">
                <div class="text-3xl font-bold">Awareness Card</div>
                <div class="text-3xl">🦺</div>
              </div>
              <div class="mt-4">
                <p class="text-base">
                  Area kerja dengan alat berat (seperti excavator, crane, forklift, dan dump truck) memiliki risiko
                  tinggi. Semua pekerja harus paham bahwa keselamatan pribadi dimulai dari diri sendiri.
                </p>
              </div>
              <div class="mt-auto">
                <p class="text-sm opacity-75">Hover to flip!</p>
              </div>
            </div>
          </div>

          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-blue-400 to-green-600 p-6 text-white [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="text-2xl font-bold mb-4">Back Side</div>
              <div class="flex-grow">
                <p class="text-sm font-semibold">
                  🔹 Gunakan APD lengkap setiap saat, termasuk helm, rompi reflektif, sepatu safety, sarung tangan, dan
                  pelindung pendengaran.
                  <br>🔹 Jangan menganggap area kerja aman hanya karena terlihat sepi; alat berat bisa bergerak tiba-tiba.
                  <br>🔹 Laporkan segera jika menemukan kondisi tidak aman (oil leak, kabel terbuka, area licin, dsb).
                </p>
              </div>
              <div class="flex justify-end items-left mt-3">
                <!-- <button
                class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-opacity-90 transition-colors"
              >
                Action
              </button> -->
                <span class="text-3xl">🦺</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- card-2 -->
      <div class="mt-10 group relative h-80 w-72 [perspective:1000px]">
        <div
          class="absolute duration-1000 w-full h-full [transform-style:preserve-3d] group-hover:[transform:rotateX(180deg)]">
          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-400 to-teal-600 p-6 text-white [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="flex justify-between items-start">
                <div class="text-3xl font-bold">Risk Reminder</div>
                <div class="text-3xl">⚙️</div>
              </div>
              <div class="mt-4">
                <p class="text-base">
                  Area alat berat punya blind spot (titik buta) yang besar. Operator tidak selalu bisa melihat orang di
                  dekatnya, terutama di belakang dan samping.
                </p>
              </div>
              <div class="mt-auto">
                <p class="text-sm opacity-75">Hover to flip!</p>
              </div>
            </div>
          </div>

          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-blue-400 to-green-600 p-6 text-white [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="text-2xl font-bold mb-4">Back Side</div>
              <div class="flex-grow">
                <p class="text-sm font-semibold">
                  ⚠️ Hindari berdiri di area 5 meter dari alat yang beroperasi.
                  <br>⚠️ Jangan berjalan di jalur alat berat tanpa izin atau pengawasan.
                  <br>⚠️ Saat alat berat memutar atau memindahkan beban, pastikan tidak berada di radius kerja lengan
                  alat.
                  <br>⚠️ Jika harus berada di area tersebut, pastikan komunikasi visual (eye contact) dengan operator.
                </p>
              </div>
              <div class="flex justify-end items-left mt-3">
                <!-- <button
                class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-opacity-90 transition-colors"
              >
                Action
              </button> -->
                <span class="text-3xl">⚙️</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Card-3 -->
      <div class="mt-10 group relative h-80 w-72 [perspective:1000px]">
        <div
          class="absolute duration-1000 w-full h-full [transform-style:preserve-3d] group-hover:[transform:rotateX(180deg)]">
          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-400 to-teal-600 p-6 text-white [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="flex justify-between items-start">
                <div class="text-3xl font-bold">Safety Behavior</div>
                <div class="text-3xl">🧭</div>
              </div>
              <div class="mt-4">
                <p class="text-base">
                  Menumbuhkan kebiasaan kerja yang aman dan disiplin dalam interaksi dengan alat berat
                  <br><span class="font-bold">Perilaku aman adalah kunci menurunkan angka kecelakaan.</span>
                </p>
              </div>
              <div class="mt-auto">
                <p class="text-sm opacity-75">Hover to flip!</p>
              </div>
            </div>
          </div>

          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-blue-400 to-green-600 p-6 text-white [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="text-2xl font-bold mb-4">Back Side</div>
              <div class="flex-grow">
                <p class="text-sm font-semibold">
                  ✅ Selalu lakukan eye contact dengan operator sebelum melintas di area kerja.
              <br>✅ Gunakan isyarat tangan yang disepakati untuk komunikasi (standard signal).
              <br>✅ Jangan menggunakan HP atau alat musik saat berada di area alat berat.
              <br>✅ Jangan bercanda atau mengalihkan perhatian operator.
                </p>
              </div>
              <div class="flex justify-end items-left my-auto">
                <!-- <button
                class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-opacity-90 transition-colors"
              >
                Action
              </button> -->
                <span class="text-3xl">🧭</span>
              </div>
            </div>
          </div>
        </div>
      </div>
       <!-- Card-4 -->
      <div class="mt-10 group relative h-80 w-72 [perspective:1000px]">
        <div
          class="absolute duration-1000 w-full h-full [transform-style:preserve-3d] group-hover:[transform:rotateX(180deg)]">
          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-400 to-teal-600 p-6 text-white [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="flex justify-between items-start">
                <div class="text-3xl font-bold">Safety Behavior</div>
                <div class="text-3xl">🧭</div>
              </div>
              <div class="mt-4">
                <p class="text-base">
                  Area alat berat punya blind spot (titik buta) yang besar. Operator tidak selalu bisa melihat orang di
                  dekatnya, terutama di belakang dan samping.
                </p>
              </div>
              <div class="mt-auto">
                <p class="text-sm opacity-75">Hover to flip!</p>
              </div>
            </div>
          </div>

          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-blue-400 to-green-600 p-6 text-white [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="text-2xl font-bold mb-4">Back Side</div>
              <div class="flex-grow">
                <p class="text-sm font-semibold">
                  ⚠️ Hindari berdiri di area 5 meter dari alat yang beroperasi.
                  <br>⚠️ Jangan berjalan di jalur alat berat tanpa izin atau pengawasan.
                  <br>⚠️ Saat alat berat memutar atau memindahkan beban, pastikan tidak berada di radius kerja lengan
                  alat.
                  <br>⚠️ Jika harus berada di area tersebut, pastikan komunikasi visual (eye contact) dengan operator.
                </p>
              </div>
              <div class="flex justify-end items-left my-auto">
                <!-- <button
                class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-opacity-90 transition-colors"
              >
                Action
              </button> -->
                <span class="text-3xl">🧭</span>
              </div>
            </div>
          </div>
        </div>
      </div>

       <!-- Card-5  -->
      <div class="mt-10 group relative h-80 w-72 [perspective:1000px]">
        <div
          class="absolute duration-1000 w-full h-full [transform-style:preserve-3d] group-hover:[transform:rotateX(180deg)]">
          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-400 to-teal-600 p-6 text-white [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="flex justify-between items-start">
                <div class="text-3xl font-bold">Risk Reminder</div>
                <div class="text-3xl">⚙️</div>
              </div>
              <div class="mt-4">
                <p class="text-base">
                  Area alat berat punya blind spot (titik buta) yang besar. Operator tidak selalu bisa melihat orang di
                  dekatnya, terutama di belakang dan samping.
                </p>
              </div>
              <div class="mt-auto">
                <p class="text-sm opacity-75">Hover to flip!</p>
              </div>
            </div>
          </div>

          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-blue-400 to-green-600 p-6 text-white [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="text-2xl font-bold mb-4">Back Side</div>
              <div class="flex-grow">
                <p class="text-sm font-semibold">
                  ⚠️ Hindari berdiri di area 5 meter dari alat yang beroperasi.
                  <br>⚠️ Jangan berjalan di jalur alat berat tanpa izin atau pengawasan.
                  <br>⚠️ Saat alat berat memutar atau memindahkan beban, pastikan tidak berada di radius kerja lengan
                  alat.
                  <br>⚠️ Jika harus berada di area tersebut, pastikan komunikasi visual (eye contact) dengan operator.
                </p>
              </div>
              <div class="flex justify-end items-left my-auto">
                <!-- <button
                class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-opacity-90 transition-colors"
              >
                Action
              </button> -->
                <span class="text-3xl">⚙️</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card-6 -->
      <div class="mt-10 group relative h-80 w-72 [perspective:1000px]">
        <div
          class="absolute duration-1000 w-full h-full [transform-style:preserve-3d] group-hover:[transform:rotateX(180deg)]">
          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-400 to-teal-600 p-6 text-white [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="flex justify-between items-start">
                <div class="text-3xl font-bold">Risk Reminder</div>
                <div class="text-3xl">⚙️</div>
              </div>
              <div class="mt-4">
                <p class="text-base">
                  Area alat berat punya blind spot (titik buta) yang besar. Operator tidak selalu bisa melihat orang di
                  dekatnya, terutama di belakang dan samping.
                </p>
              </div>
              <div class="mt-auto">
                <p class="text-sm opacity-75">Hover to flip!</p>
              </div>
            </div>
          </div>

          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-blue-400 to-green-600 p-6 text-white [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="text-2xl font-bold mb-4">Back Side</div>
              <div class="flex-grow">
                <p class="text-sm font-semibold">
                  ⚠️ Hindari berdiri di area 5 meter dari alat yang beroperasi.
                  <br>⚠️ Jangan berjalan di jalur alat berat tanpa izin atau pengawasan.
                  <br>⚠️ Saat alat berat memutar atau memindahkan beban, pastikan tidak berada di radius kerja lengan
                  alat.
                  <br>⚠️ Jika harus berada di area tersebut, pastikan komunikasi visual (eye contact) dengan operator.
                </p>
              </div>
              <div class="flex justify-end items-left my-auto">
                <!-- <button
                class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-opacity-90 transition-colors"
              >
                Action
              </button> -->
                <span class="text-3xl">⚙️</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card awareness -->
    <div class="bg-white border-l-4 border-green-500 shadow-md p-6 rounded-xl">
      <h3 class="text-lg font-bold text-green-700 mb-2">🦺 Safety Awareness</h3>
      <p class="text-sm text-gray-700 leading-relaxed">
        Gunakan APD lengkap sebelum mendekati alat berat — helm, rompi reflektif, sepatu safety, dan sarung tangan adalah
        perlindungan pertama Anda.
      </p>
    </div>
    <!-- Tambahkan card-card lain sesuai tabel di atas -->
  </div>

  </div>




  <footer class="bg-gray-100 border-t mt-10">
    <div class="max-w-6xl mx-auto px-6 py-10 text-center">

      <p class="text-lg italic text-gray-700 mb-4">
        “Tidak ada pekerjaan yang begitu penting sehingga kita tidak punya waktu untuk melakukannya dengan aman.”
      </p>
      <p class="text-gray-600 font-medium mb-6">— Safety Department</p>


      <div class="border-t border-gray-300 my-6"></div>

  </footer>

  <footer class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">

    <div class="text-center">
      <h3 class="text-lg font-semibold text-gray-800 mb-3">Butuh bantuan?</h3>
      <p class="text-gray-600">Hubungi tim HSE: <a href="mailto:hse@safetyapp.com"
          class="text-blue-600 hover:underline">hse@safetyapp.com</a></p>
      <p class="mt-2 text-gray-600">Hotline darurat: <span class="font-semibold">(021) 1234 5678</span></p>
      <p class="mt-3 text-sm text-gray-500">© {{ date('Y') }} SafetyApp. Semua hak dilindungi.</p>
    </div>
    </div>
  </footer>


<div class="ml-0 md:ml-18 -mt-8 p-4">
    <h2 class="text-3xl md:text-4xl text-center font-bold text-green-600 mb-4">Safety Dashboard</h2>
    <p class="text-center text-base md:text-xl text-gray-700 mb-6">
        Selamat datang di sistem <span class="font-semibold">SafetyApp</span>. Pastikan semua aktivitas kerja
        berlangsung aman dan sesuai prosedur.
    </p>

    {{-- ✅ Info Cards (Responsive 1-3 kolom) --}}
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

{{-- ✅ Filter Bulan (Responsive) --}}
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

{{-- ✅ Chart Grid Responsive --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-2 sm:p-4">
    {{-- CARD 1: Distribusi Site / Cabang --}}
    <div class="bg-white shadow-md rounded-2xl p-4 sm:p-6 border border-gray-100 overflow-x-auto">
        <h3 class="text-base md:text-lg font-medium text-gray-700 mb-4">Distribusi Site / Cabang</h3>
        <canvas id="siteDistributionChart"
            data-labels='@json($labelsSiteCategory)'
            data-data='@json($dataSiteCategory)'
            class="w-full h-auto">
        </canvas>
    </div>

    {{-- CARD 2: Total Manpower --}}
    <div class="bg-white shadow-md rounded-2xl p-4 sm:p-6 border border-gray-100 overflow-x-auto">
        <h3 class="text-base md:text-lg font-medium text-gray-700 mb-4">Total Manpower</h3>
        <canvas id="manpowerChart"
            data-labels='@json($labelsManpower)'
            data-organik='@json($dataManpowerOrganik)'
            data-partner='@json($dataManpowerPartner)'width="300" height="300"
            class="w-full h-auto">
        </canvas>
    </div>

    {{-- CARD 3: Gender Manpower --}}
    <div class="bg-white shadow-md rounded-2xl p-4 sm:p-6 border border-gray-100 overflow-x-auto">
        <h3 class="text-base md:text-lg font-medium text-gray-700 mb-4">Gender Manpower</h3>
        <canvas id="genderChart"
            data-labels='@json($labelsGender)'
            data-organik='@json($dataGenderOrganik)'
            data-partner='@json($dataGenderPartner)'
            class="w-full h-auto">
        </canvas>
    </div>
</div>

{{-- ✅ CARD 4: Total Manhours --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 mb-6 p-2 sm:p-4">
    <div class="bg-white shadow-md rounded-2xl p-4 sm:p-6 border border-gray-100 overflow-x-auto">
        <h3 class="text-base md:text-lg font-medium text-gray-700 mb-4">Total Manhours</h3>
        <canvas id="manhoursChart"
            data-labels='@json($labelsManhours)'
            data-organik='@json($dataManhoursOrganik)'
            data-partner='@json($dataManhoursPartner)'
            class="w-full h-auto">
        </canvas>
    </div>
</div>
@endsection