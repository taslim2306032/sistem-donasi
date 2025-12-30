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
    <body class="font-sans antialiased">
        <div x-data="{ 
                sidebarOpen: localStorage.getItem('sidebarState') === 'true',
                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                    localStorage.setItem('sidebarState', this.sidebarOpen);
                },
                closeSidebar() {
                    this.sidebarOpen = false;
                    localStorage.setItem('sidebarState', 'false');
                }
            }" 
            class="flex min-h-screen bg-gray-100 relative">
            
            {{-- MOBILE & DESKTOP MENU TOGGLE BUTTON (Fixed Top Left) --}}
            <button @click="toggleSidebar()" class="absolute top-4 left-4 z-40 p-2 rounded-md bg-emerald-600 text-white shadow-lg hover:bg-emerald-700 transition focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            @include('layouts.navigation')

            <div class="flex-1 flex flex-col min-w-0 overflow-hidden transition-all duration-300"
                 :class="{'md:ml-72': sidebarOpen}">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1">
                     @yield('content')
                </main>
            </div>
        </div>
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        @if(session('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
    </body>
</html>
