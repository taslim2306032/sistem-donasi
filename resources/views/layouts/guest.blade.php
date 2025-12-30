<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Donasi Untuk Kebaikan Umat</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased min-h-screen bg-no-repeat"
      style="
        background-image: url('{{ asset('img/bg-login.png') }}');
        background-size: 100%;
        background-position: -70% center;
      ">


    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- CONTENT -->
    <div class="relative z-10 min-h-screen flex flex-col sm:justify-center items-center px-4">

        <!-- LOGO -->
        <div class="mb-6">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-white" />
            </a>
        </div>

        <!-- CARD -->
        <div class="w-full sm:max-w-md bg-white shadow-xl rounded-5xl overflow-hidden px-6 py-8">
            {{ $slot }}
        </div>

    </div>

</body>
</html>
