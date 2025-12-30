<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DonasiUntukUmat</title>

    <!-- FONT INTER (PASTI AKTIF) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="font-family: 'Inter', sans-serif"
      class="bg-white text-[#0f172a] min-h-screen flex flex-col">

<!-- ================= NAVBAR ================= -->
<nav class="bg-white">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">

        <!-- LOGO -->
        <div class=" flex items-center gap-5 mt-8">
            <img src="{{ asset('img/logo.png') }}"
                 alt="Logo DonasiKu"
                 class="h-10 w-10 object-contain">
            <span class="text-xl font-bold text-emerald-500">
                DonasiUntukUmat
            </span>
        </div>

        <!-- ACTION -->
        <div class="flex items-center gap-6">
            @auth
                <a href="{{ route('donasi.index') }}"
                   class="text-sm font-medium text-emerald-700 hover:text-indigo-600">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="text-sm font-medium text-gray-600 hover:text-indigo-600">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="inline-block px-6 py-3 rounded-xl
                            text-sm font-semibold shadow-md">
                    Daftar
                </a>
            @endauth
        </div>

    </div>
</nav>

<!-- ================= HERO ================= -->
<main class="flex-grow">
<section class="bg-white">
    <div class="max-w-7xl mx-auto px-6 pt-28 pb-44">

        <div class="max-w-3xl">

            <!-- JUDUL (PX FIXED, MIRIP GAMBAR) -->
            <h1 style="font-size:72px; line-height:1.05;"
                class="tracking-tight text-slate-900">
                Berbagi 
                <span class="block text-[#4f46e5]">
                    Kebaikan
                </span>
                <span class="block text-emerald-500">
                    Untuk Seksama
                </span>
            </h1>

            <!-- DESKRIPSI -->
            <p class="mt-6 text-lg text-gray-500 leading-relaxed max-w-xl">
                Platform donasi online yang aman dan terpercaya.
                <br>
                Mari bergabung dalam gerakan kebaikan untuk membantu
                sesama yang membutuhkan.
            </p>



            <!-- BUTTON -->
            <div class="mt-12">
                <a href="{{ route('donasi.index') }}"
                style="background:#059669;; color:white;"
                class="inline-block px-6 py-3 rounded-xl
                        text-sm font-semibold shadow-md">
                    Lihat Donasi
                </a>
            </div>


        </div>

    </div>
</section>
</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-slate-50 mt-auto">
    <div class="max-w-7xl mx-auto
