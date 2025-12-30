@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- WELCOME MESSAGE --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Halo, <span class="text-emerald-600">{{ Auth::user()->name }}!</span> 👋
        </h1>
        <p class="text-gray-600 mt-2">Selamat datang kembali di Dashboard DonasiKu.</p>
    </div>

    @if(Auth::user()->role === 'admin')
        {{-- ======================= ADMIN DASHBOARD ======================= --}}
        
        {{-- STATISTIC CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Donasi -->
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-emerald-500 flex items-center">
                <div class="p-3 rounded-full bg-emerald-100 text-emerald-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Donasi Masuk</p>
                    <p class="text-xl font-bold text-gray-800">Rp {{ number_format($totalDonasiTerkumpul, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Perlu Verifikasi -->
            <a href="{{ route('admin.payments.pending') }}" class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500 flex items-center hover:shadow-md transition cursor-pointer group">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4 group-hover:scale-110 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Pending Verifikasi</p>
                    <p class="text-xl font-bold text-gray-800">{{ $donasiPerluVerifikasi }}</p>
                </div>
            </a>

            <!-- Jumlah User -->
            <a href="{{ route('admin.users') }}" class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 flex items-center hover:shadow-md transition cursor-pointer group">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4 group-hover:scale-110 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total User</p>
                    <p class="text-xl font-bold text-gray-800">{{ $jumlahUser }}</p>
                </div>
            </a>

            <!-- Jumlah Kampanye -->
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500 flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Kampanye Aktif</p>
                    <p class="text-xl font-bold text-gray-800">{{ $jumlahKampanye }}</p>
                </div>
            </div>
        </div>

        {{-- RECENT TRANSACTIONS --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Donasi Masuk Terbaru</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Donatur</th>
                            <th class="px-6 py-4 font-semibold">Kampanye</th>
                            <th class="px-6 py-4 font-semibold">Nominal</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($transaksiTerbaru as $history)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold text-xs mr-3">
                                            {{ substr($history->user->name ?? 'A', 0, 1) }}
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $history->user->name ?? 'Anonim' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ Str::limit($history->donasi->judul_donasi ?? '-', 25) }}
                                </td>
                                <td class="px-6 py-4 font-bold text-emerald-600">
                                    Rp {{ number_format($history->nominal, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($history->status == 'verified')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                            Berhasil
                                        </span>
                                    @elseif($history->status == 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Menunggu
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ucfirst($history->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-400">
                                    {{ $history->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        <p>Belum ada transaksi masuk.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    @else
        {{-- ======================= USER DASHBOARD ======================= --}}

        {{-- USER STATS CARD (Gradient & Luxury Feel) --}}
        <div class="relative overflow-hidden bg-gradient-to-r from-emerald-600 to-green-500 rounded-2xl shadow-xl p-8 mb-10 text-white">
             {{-- Background Pattern --}}
             <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white/10 blur-3xl"></div>
             <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center mb-6 md:mb-0">
                    <div class="p-4 rounded-full bg-white/20 backdrop-blur-sm mr-6 shadow-inner">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider">Total Kebaikan Tersalurkan</p>
                        <p class="text-4xl font-extrabold text-white mt-1">Rp {{ number_format($totalDonasiSaya, 0, ',', '.') }}</p>
                        <p class="text-xs text-emerald-100 mt-2 font-light">Terima kasih telah menjadi pahlawan bagi mereka.</p>
                    </div>
                </div>
                <div>
                     <a href="{{ route('donasi.index') }}" class="inline-flex items-center bg-white text-emerald-700 px-8 py-3 rounded-full font-bold shadow-lg hover:bg-gray-50 hover:scale-105 transition transform duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Donasi Lagi
                     </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- RIWAYAT DONASI --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Riwayat Donasi Terakhir
                </h2>
                <div class="space-y-4">
                    @forelse($riwayatSaya as $item)
                        <div class="flex items-center justify-between p-5 bg-white border border-gray-100 rounded-xl hover:shadow-md transition duration-200 group">
                            <div class="flex items-center gap-5">
                                @if($item->donasi && $item->donasi->gambar)
                                    <div class="relative w-14 h-14 rounded-lg overflow-hidden group-hover:scale-105 transition">
                                        <img src="{{ asset('storage/'.$item->donasi->gambar) }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="font-bold text-gray-800 text-base mb-1">{{ $item->donasi->judul_donasi ?? 'Donasi Dihapus' }}</h3>
                                    <p class="text-xs text-gray-500 font-medium">{{ $item->created_at->format('d M Y, H:i') }} WIB</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-800 text-lg">Rp {{ number_format($item->nominal, 0, ',', '.') }}</p>
                                
                                {{-- STATUS BADGE DYNAMIC --}}
                                @if($item->status == 'verified')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 mt-1">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        Berhasil
                                    </span>
                                @elseif($item->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 mt-1">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Menunggu Verifikasi
                                    </span>
                                @elseif($item->status == 'rejected')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-800 mt-1">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-gray-50 rounded-xl border-dashed border-2 border-gray-200">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            <p class="text-gray-500 font-medium">Belum ada riwayat donasi.</p>
                            <p class="text-sm text-gray-400 mt-1">Mari mulai berbagi kebaikan hari ini!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- REKOMENDASI --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 h-fit sticky top-6">
                <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Yuk Bantu Mereka
                </h2>
                <div class="space-y-6">
                <div class="relative" x-data="{ 
                        activeSlide: 0,
                        slides: {{ $rekomendasiDonasi->count() }},
                        timer: null,
                        init() {
                            this.startTimer();
                        },
                        startTimer() {
                            this.timer = setInterval(() => {
                                this.next();
                            }, 3000);
                        },
                        stopTimer() {
                            clearInterval(this.timer);
                        },
                        next() {
                            this.activeSlide = (this.activeSlide + 1) % this.slides;
                        },
                        prev() {
                            this.activeSlide = (this.activeSlide === 0) ? (this.slides - 1) : (this.activeSlide - 1);
                        }
                    }" 
                    @mouseenter="stopTimer()" 
                    @mouseleave="startTimer()">
                    
                    {{-- CAROUSEL ITEMS --}}
                    <div class="relative w-full overflow-hidden rounded-xl" style="height: 320px;">
                        @forelse($rekomendasiDonasi as $index => $rek)
                            <div x-show="activeSlide === {{ $index }}"
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0 transform translate-x-full"
                                 x-transition:enter-end="opacity-100 transform translate-x-0"
                                 x-transition:leave="transition ease-in duration-500"
                                 x-transition:leave-start="opacity-100 transform translate-x-0"
                                 x-transition:leave-end="opacity-0 transform -translate-x-full"
                                 class="absolute inset-0 w-full h-full bg-white flex flex-col">
                                
                                {{-- Image --}}
                                <a href="{{ route('donasi.show', $rek->id) }}" class="block group relative h-48 overflow-hidden">
                                     @if($rek->gambar)
                                        <img src="{{ asset('storage/'.$rek->gambar) }}" class="w-full h-full object-cover transition transform duration-700 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full bg-gray-200"></div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-4">
                                        <h3 class="text-white font-bold text-lg truncate shadow-black drop-shadow-md">{{ $rek->judul_donasi }}</h3>
                                    </div>
                                </a>

                                {{-- Details --}}
                                <div class="p-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-xs font-semibold text-gray-500 uppercase">Terkumpul</span>
                                            <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                                                {{ number_format(($rek->donasi_terkumpul/$rek->target_donasi)*100, 0) }}%
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-100 rounded-full h-2.5 mb-2 overflow-hidden">
                                            <div class="bg-gradient-to-r from-emerald-500 to-green-400 h-full rounded-full transition-all duration-1000 ease-out" 
                                                 style="width: {{ min(100, ($rek->donasi_terkumpul/$rek->target_donasi)*100) }}%"></div>
                                        </div>
                                        
                                        <div class="flex justify-between text-xs text-gray-600 mt-2">
                                            <div>
                                                <p class="text-gray-400">Terkumpul</p>
                                                <p class="font-bold">Rp {{ number_format($rek->donasi_terkumpul, 0, ',', '.') }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-gray-400">Target</p>
                                                <p class="font-bold">Rp {{ number_format($rek->target_donasi, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('donasi.show', $rek->id) }}" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white text-center py-2 rounded-lg font-bold text-sm transition shadow-md hover:shadow-lg mt-3">
                                        Bantu Sekarang
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="flex items-center justify-center h-full text-gray-400 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                Belum ada rekomendasi.
                            </div>
                        @endforelse
                    </div>

                    {{-- CONTROLS --}}
                    @if($rekomendasiDonasi->count() > 1)
                        <button @click="prev()" class="absolute left-2 top-1/3 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg hover:scale-110 transition backdrop-blur-sm z-10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button @click="next()" class="absolute right-2 top-1/3 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg hover:scale-110 transition backdrop-blur-sm z-10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                        
                        {{-- DOTS --}}
                        <div class="absolute bottom-11 right-0 left-0 flex justify-center gap-2 z-10">
                            @foreach($rekomendasiDonasi as $index => $rek)
                                <button @click="activeSlide = {{ $index }}" 
                                        :class="{'bg-white w-6': activeSlide === {{ $index }}, 'bg-white/50 w-2': activeSlide !== {{ $index }}}"
                                        class="h-2 rounded-full transition-all duration-300 shadow-sm"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
                </div>
            </div>

        </div>
    @endif
</div>
@endsection
