<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DonasiUntukUmat</title>

    <!-- FONT INTER (PASTI AKTIF) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="font-family: 'Inter', sans-serif; background-image: url('{{ asset('img/bg-landing.jpg') }}');"
      class="bg-cover bg-center bg-fixed min-h-screen flex flex-col relative text-white">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/70"></div>

    <!-- CONTENT WRAPPER -->
    <div class="relative z-10 flex flex-col min-h-screen">

<!-- ================= NAVBAR ================= -->
<nav class="bg-transparent">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">

        <!-- LOGO -->
        <div class="flex items-center gap-5 mt-4">
            <img src="{{ asset('img/logo.png') }}"
                 alt="Logo DonasiKu"
                 class="h-16 w-16 object-contain">
            <span class="text-3xl font-extrabold text-emerald-500 tracking-wide">
                DonasiUntukUmat
            </span>
        </div>

        <!-- ACTION -->
        <div class="flex items-center gap-6">
            @auth
                <a href="{{ route('donasi.index') }}"
                   class="text-sm font-medium text-emerald-700 hover:text-emerald-900">
                    Dashboard
                </a>
            @endauth
        </div>

    </div>
</nav>

<!-- ================= HERO ================= -->
<main class="flex-grow">
<section class="bg-transparent">
    <div class="max-w-7xl mx-auto px-6 pt-28 pb-44">

        <div class="max-w-3xl">

            <!-- JUDUL  -->
            <h1 style="font-size:72px; line-height:1.05;"
                class="tracking-tight text-white font-bold">
                Berbagi 
                <span class="block bg-gradient-to-b from-gray-300 to-emerald-400 bg-clip-text text-transparent">
                    Kebaikan
                </span>
                <span class="block bg-gradient-to-b from-gray-300 to-emerald-400 bg-clip-text text-transparent font-extrabold pb-2">
                    Untuk Seksama
                </span>
            </h1>

            <!-- DESKRIPSI -->
            <p class="mt-6 text-lg text-gray-200 leading-relaxed max-w-xl shadow-black drop-shadow-md">
                Platform donasi online yang aman dan terpercaya.
                <br>
                Mari bergabung dalam gerakan kebaikan untuk membantu
                sesama yang membutuhkan.
            </p>



            <!-- BUTTON -->
            <div class="mt-12 flex gap-4">
                @auth
                    <a href="{{ route('donasi.index') }}"
                    style="background:#059669; color:white;"
                    class="inline-block px-6 py-3 rounded-xl
                            text-sm font-semibold shadow-md hover:bg-emerald-700 transition">
                        Masuk Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                    class="inline-block px-6 py-3 rounded-xl
                            text-sm font-bold text-white shadow-lg transform hover:scale-105 transition"
                    style="background: #117b2cff;">
                        Masuk Sekarang
                    </a>
                    
                    <a href="{{ route('register') }}"
                    class="inline-block px-6 py-3 rounded-xl
                            text-sm font-bold text-slate-700 bg-white border border-slate-200 shadow-md hover:bg-slate-50 transition">
                        Daftar Akun
                    </a>
                @endauth
            </div>


        </div>

    </div>

</section>
</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-transparent mt-auto border-t border-white/20 text-white/80">
    <div class="max-w-7xl mx-auto py-6 px-6 text-center text-sm">
        &copy; {{ date('Y') }} DonasiUntukUmat. All rights reserved.
    </div>
</footer>

</div> <!-- End Content Wrapper -->
</body>
</html>
