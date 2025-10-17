@extends('layouts.app')

@section('title', 'Dashboard User')

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
    <h1 class="text-5xl font-semibold mb-4">Selamat Datang Di <span class="text-blue-600">Safety App</span></h1>
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
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [backface-visibility:hidden]">
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
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <!-- <div class="text-2xl font-bold mb-4">Back Side</div> -->
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
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [backface-visibility:hidden]">
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
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <!-- <div class="text-2xl font-bold mb-4">Back Side</div> -->
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
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [backface-visibility:hidden]">
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
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <!-- <div class="text-2xl font-bold mb-4">Back Side</div> -->
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
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="flex justify-between items-start">
                <div class="text-3xl font-bold">Procedural / SOP Card</div>
                <div class="text-3xl">🚧</div>
              </div>
              <div class="mt-4">
                <p class="text-base">
                  Menegaskan prosedur standar dan alur kerja aman di area proyek alat berat
                  Setiap pekerjaan harus mengikuti SOP yang berlaku.
                </p>
              </div>
              <div class="mt-auto">
                <p class="text-sm opacity-75">Hover to flip!</p>
              </div>
            </div>
          </div>

          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <!-- <div class="text-2xl font-bold mb-2">Back Side</div> -->
              <div class="flex-grow">
                <p class="text-sm font-semibold">
                    1️⃣ Lakukan pre-start inspection (cek oli, rem, lampu, alarm mundur, klakson).
                    <br>2️⃣ Pastikan area kerja bersih dari orang & benda yang tidak perlu.
                    <br>3️⃣ Gunakan spotter atau pengarah saat alat bermanuver di area sempit atau ramai.
                    <br>4️⃣ Matikan mesin, tarik rem parkir, dan turunkan alat kerja saat berhenti.
                    <!-- <br>5️⃣ Gunakan lock out – tag out jika melakukan perawatan. -->
                </p>
              </div>
              <div class="flex justify-end items-left my-auto">
                <!-- <button
                class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-opacity-90 transition-colors"
              >
                Action
              </button> -->
                <span class="text-3xl">🚧</span>
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
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="flex justify-between items-start">
                <div class="text-3xl font-bold">Environmental Safety</div>
                <div class="text-3xl">🌿</div>
              </div>
              <div class="mt-4">
                <p class="text-base">
                    Mengingatkan pentingnya menjaga lingkungan kerja yang bersih & bebas polusi
                    <span class="font-bold">Lingkungan yang bersih juga bagian dari keselamatan.</span>
                </p>
              </div>
              <div class="mt-auto">
                <p class="text-sm opacity-75">Hover to flip!</p>
              </div>
            </div>
          </div>

          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <!-- <div class="text-2xl font-bold mb-4">Back Side</div> -->
              <div class="flex-grow">
                <p class="text-sm font-semibold">
                  🌱 Jangan biarkan tumpahan oli atau bahan bakar mencemari tanah atau air.
                  <br>🌱 Buang limbah B3 (oli bekas, filter, kain lap) ke tempat khusus.
                  <br>🌱 Gunakan wadah tertutup untuk bahan kimia.
                  <div class="text-center mt-5">💧 “Keselamatan kerja dan kelestarian lingkungan berjalan berdampingan.”</div>
                  
                </p>
              </div>
              <div class="flex justify-end items-left my-auto">
                <!-- <button
                class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-opacity-90 transition-colors"
              >
                Action
              </button> -->
                <span class="text-3xl">🌿</span>
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
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <div class="flex justify-between items-start">
                <div class="text-3xl font-bold">Safety Quote</div>
                <div class="text-3xl">💭</div>
              </div>
              <div class="mt-4">
                <p class="text-base">
                  Menanamkan budaya safety di setiap individu
                </p>
              </div>
              <div class="mt-auto">
                <p class="text-sm opacity-75">Hover to flip!</p>
              </div>
            </div>
          </div>

          <div
            class="absolute w-full h-full rounded-xl bg-gradient-to-br from-sky-200 to-teal-50 p-6 border-l-4 border-green-500 text-black [transform:rotateX(180deg)] [backface-visibility:hidden]">
            <div class="flex flex-col h-full">
              <!-- <div class="text-2xl font-bold mb-4">Back Side</div> -->
              <div class="flex-grow">
                <p class="text-sm font-semibold">
                    “Tidak ada pekerjaan yang begitu penting sehingga kita tidak punya waktu untuk melakukannya dengan aman.”
                <br>“Kecelakaan bisa dihindari, tapi keselamatan harus diupayakan setiap hari.”
                <br>“Lebih baik kehilangan waktu satu menit, daripada kehilangan nyawa seumur hidup.”
                <br>“Safety bukan sekadar aturan, tapi sikap profesional.”
                </p>
              </div>
              <div class="flex justify-end items-left my-auto">
                <!-- <button
                class="px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold hover:bg-opacity-90 transition-colors"
              >
                Action
              </button> -->
                <span class="text-3xl">💭</span>
              </div>
            </div>
          </div>
        </div>
      </div>
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



@endsection