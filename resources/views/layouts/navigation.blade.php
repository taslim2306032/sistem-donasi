<nav x-data="{ open: false }" class="bg-gradient-to-b from-emerald-900 to-emerald-700 w-72 flex-shrink-0 min-h-screen hidden md:flex md:flex-col shadow-xl">
    <div class="px-6 py-8">
        
        <!-- HEADER: LOGO & USER INFO -->
        <div class="flex items-center gap-4 mb-10 pb-6 border-b border-emerald-600/50">
            <!-- LOGO -->
            <a href="{{ url('/') }}" class="flex-shrink-0">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 w-auto drop-shadow-md hover:scale-105 transition">
            </a>

            <!-- USER INFO / AUTH LINKS -->
            <div class="flex flex-col">
                @auth
                    <div class="font-bold text-white text-lg leading-tight truncate w-32">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-xs text-emerald-200 uppercase font-semibold tracking-wider flex items-center mt-1">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                        {{ Auth::user()->role }}
                    </div>
                @else
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('login') }}" class="bg-white text-emerald-800 px-4 py-2.5 rounded-lg font-bold shadow-lg hover:bg-emerald-50 hover:scale-105 transition-all duration-200 text-center flex items-center justify-center text-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="text-emerald-200 hover:text-white text-xs text-center font-medium transition hover:underline">
                            Belum punya akun? <span class="text-white font-bold ml-1">Daftar</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <!-- NAVIGATION LINKS -->
        <div class="flex flex-col space-y-4">
            {{-- Helper component for nicer buttons --}}
            @php
                $btnClass = "flex items-center px-4 py-3 rounded-xl transition-all duration-200 font-medium group";
                $activeClass = "bg-white text-emerald-800 shadow-lg transform translate-x-1";
                $inactiveClass = "text-white/80 hover:bg-emerald-800/50 hover:text-white hover:translate-x-1";
            @endphp

            <!-- DASHBOARD -->
            @auth
            <a href="{{ route('dashboard') }}" 
               class="{{ $btnClass }} {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            @endauth



            <!-- DONASI -->
            <a href="{{ route('donasi.index') }}" 
               class="{{ $btnClass }} {{ request()->routeIs('donasi.index') || request()->routeIs('donasi.show') ? $activeClass : $inactiveClass }}">
                <div class="{{ (request()->routeIs('donasi.index') || request()->routeIs('donasi.show')) ? 'bg-white text-emerald-800' : 'bg-white/10 text-white' }} p-2 rounded-lg mr-3 group-hover:scale-110 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                </div>
                <span>Donasi</span>
            </a>

            @auth
                @if(Auth::user()->isAdmin())
                    <!-- TAMBAH DONASI (ADMIN) -->
                    <a href="{{ route('donasi.create') }}" 
                       class="{{ $btnClass }} {{ request()->routeIs('donasi.create') ? $activeClass : $inactiveClass }}">
                        <div class="{{ request()->routeIs('donasi.create') ? 'bg-emerald-100 text-emerald-700' : 'bg-white/10 text-white' }} p-2 rounded-lg mr-3 group-hover:scale-110 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                            </svg>
                        </div>
                        <span>Tambah Donasi</span>
                    </a>
                @endif

                @if(Auth::user()->role === 'user')
                    <!-- RIWAYAT (USER) -->
                    <a href="{{ route('donasi.riwayat') }}" 
                       class="{{ $btnClass }} {{ request()->routeIs('donasi.riwayat') ? $activeClass : $inactiveClass }}">
                        <div class="{{ request()->routeIs('donasi.riwayat') ? 'bg-emerald-100 text-emerald-700' : 'bg-white/10 text-white' }} p-2 rounded-lg mr-3 group-hover:scale-110 transition">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2M12 22a10 10 0 100-20 10 10 0 000 20z"/>
                            </svg>
                        </div>
                        <span>Riwayat Donasi</span>
                    </a>
                @endif

                <!-- PROFILE -->
                <a href="{{ route('profile.edit') }}" 
                   class="{{ $btnClass }} {{ request()->routeIs('profile.edit') ? $activeClass : $inactiveClass }}">
                    <div class="{{ request()->routeIs('profile.edit') ? 'bg-emerald-100 text-emerald-700' : 'bg-white/10 text-white' }} p-2 rounded-lg mr-3 group-hover:scale-110 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A7.5 7.5 0 014.501 20.118z" />
                        </svg>
                    </div>
                    <span>Profil Saya</span>
                </a>
            @endauth
        </div>
    </div>

    <!-- LOGOUT BUTTON (Bottom) -->
    @auth
    <div class="mt-auto p-6 border-t border-emerald-600/30">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-emerald-800 hover:bg-emerald-900 text-emerald-200 hover:text-white rounded-xl transition duration-200 group">
                <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Keluar
            </button>
        </form>
    </div>
    @endauth
</nav>

<!-- MOBILE HEADER (VISIBLE ONLY ON SMALL SCREENS) -->
<div class="md:hidden bg-emerald-600 w-full p-4 flex justify-between items-center text-white">
    <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 w-auto">
    </a>
    <button @click="open = !open" class="p-2 rounded-md hover:bg-emerald-700 focus:outline-none">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>

<!-- MOBILE SLIDE-OVER MENU -->
<div x-show="open" class="md:hidden fixed inset-0 z-50 flex">
    <div @click="open = false" class="fixed inset-0 bg-gray-900 bg-opacity-50"></div>
    <div class="relative flex-1 flex flex-col max-w-xs w-full bg-emerald-600 text-white">
        <div class="absolute top-0 right-0 -mr-12 pt-2">
            <button @click="open = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                <span class="sr-only">Close sidebar</span>
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
             <div class="flex-shrink-0 flex items-center px-4 mb-5">
                <img class="h-8 w-auto" src="{{ asset('img/logo.png') }}" alt="Logo">
            </div>
            <nav class="mt-5 px-2 space-y-1">
                 <x-responsive-nav-link :href="route('donasi.index')" :active="request()->is('donasi*')">
                    Donasi
                </x-responsive-nav-link>
                @auth
                    @if(Auth::user()->isAdmin())
                        <x-responsive-nav-link :href="route('donasi.create')" :active="request()->is('donasi/create')">
                            Tambah Donasi
                        </x-responsive-nav-link>
                    @endif
                    @if(Auth::user()->role === 'user')
                        <x-responsive-nav-link :href="route('donasi.riwayat')" :active="request()->is('donasi/riwayat')">
                            Riwayat Donasi
                        </x-responsive-nav-link>
                    @endif
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            Keluar
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')">Masuk</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Daftar</x-responsive-nav-link>
                @endauth
            </nav>
        </div>
    </div>
</div>
