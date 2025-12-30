<nav 
    x-show="sidebarOpen" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-emerald-900 to-emerald-700 shadow-2xl flex flex-col items-center justify-between"
    style="display: none;">

    {{-- CLOSE BUTTON --}}
    <button @click="closeSidebar()" class="absolute top-4 right-4 text-emerald-200 hover:text-white transition">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>

    <div class="px-6 py-8 w-full">
        
        <!-- HEADER: LOGO & USER INFO -->
        <div class="flex flex-col items-center mb-10 pb-6 border-b border-emerald-600/50 w-full text-center">
            <!-- LOGO -->
            <a href="{{ url('/') }}" class="flex-shrink-0 mb-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-20 w-auto drop-shadow-md hover:scale-105 transition">
            </a>

            <!-- USER INFO / AUTH LINKS -->
            <div class="flex flex-col w-full">
                @auth
                    <div class="font-bold text-white text-lg leading-tight truncate">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-xs text-emerald-200 uppercase font-semibold tracking-wider flex items-center justify-center mt-2">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                        {{ Auth::user()->role }}
                    </div>
                @else
                    <div class="flex flex-col gap-3 w-full">
                        <a href="{{ route('login') }}" class="bg-white text-emerald-800 px-4 py-2.5 rounded-lg font-bold shadow-lg hover:bg-emerald-50 hover:scale-105 transition-all duration-200 text-center flex items-center justify-center text-sm w-full">
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
        <div class="flex flex-col space-y-4 w-full">
            {{-- Helper component for nicer buttons --}}
            @php
                $btnClass = "flex items-center px-4 py-3 rounded-xl transition-all duration-200 font-medium group text-left";
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
    <div class="mt-auto p-6 border-t border-emerald-600/30 w-full">
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


