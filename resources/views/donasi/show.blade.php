@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">

    <!-- Kembali -->
    <a href="{{ route('donasi.index') }}"
       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150 mb-6">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke daftar donasi
    </a>

    <div class="bg-white p-6 rounded-lg shadow mt-4">

        <!-- KONTEN UTAMA (Background Hijau Muda) -->
        <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-6 mb-6">
            
            <!-- Judul Header -->
            <div class="border-l-4 border-emerald-500 pl-4 mb-6">
                <h1 class="text-2xl font-bold text-gray-800 uppercase">
                    {{ $donasi->judul_donasi }}
                </h1>
            </div>

            <!-- Gambar dengan Popup -->
            @if($donasi->gambar)
                <div x-data="{ open: false }">
                    <!-- Thumbnail Container -->
                    <div class="cursor-pointer overflow-hidden rounded-lg mb-6 shadow-sm group" @click="open = true">
                        <img src="{{ asset('storage/'.$donasi->gambar) }}"
                             class="w-full h-56 object-cover transform transition group-hover:scale-105 duration-300"
                             alt="{{ $donasi->judul_donasi }}">
                        <p class="text-center text-xs text-gray-500 mt-2 italic group-hover:text-emerald-600">Klik gambar untuk memperbesar</p>
                    </div>

                    <!-- Modal / Popup -->
                    <div x-show="open" 
                         style="display: none;"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80 p-4"
                         @click.self="open = false">
                        
                        <div class="relative max-w-5xl w-full max-h-screen">
                            <button @click="open = false" class="absolute -top-10 right-0 text-white hover:text-gray-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                            <img src="{{ asset('storage/'.$donasi->gambar) }}" class="rounded shadow-2xl w-full h-auto max-h-[90vh] object-contain">
                        </div>
                    </div>
                </div>
            @endif

            <!-- Deskripsi -->
            <div class="prose prose-emerald max-w-none text-gray-700 mb-8 bg-white/50 p-4 rounded-lg">
                {{ $donasi->deskripsi }}
            </div>

            <!-- Progress Donasi -->
            @php
                $persen = $donasi->target_donasi > 0
                    ? min(100, ($donasi->donasi_terkumpul / $donasi->target_donasi) * 100)
                    : 0;
            @endphp

            <div class="bg-white p-4 rounded-lg shadow-sm border border-emerald-100">
                <div class="mb-3">
                    <div class="flex justify-between text-sm mb-1 font-semibold text-gray-600">
                        <span>Terkumpul</span>
                        <span>{{ number_format($persen, 0) }}%</span>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-emerald-500 h-3 rounded-full"
                             style="width: {{ $persen }}%">
                        </div>
                    </div>
                </div>

                <!-- Nominal -->
                <div class="flex justify-between text-sm">
                    <div>
                        <strong class="text-lg text-emerald-700">Rp {{ number_format($donasi->donasi_terkumpul,0,',','.') }}</strong><br>
                        <span class="text-gray-500">Terkumpul</span>
                    </div>
                    <div class="text-right">
                        <strong class="text-lg text-gray-700">Rp {{ number_format($donasi->target_donasi,0,',','.') }}</strong><br>
                        <span class="text-gray-500">Target</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Donasi -->
        <!-- Tombol Donasi (Sembunyikan jika Admin) -->
        @if(!Auth::check() || Auth::user()->role !== 'admin')
            <a href="{{ route('donasi.form', $donasi->id) }}"
               class="block text-center bg-blue-600 hover:bg-blue-700
                      text-white font-semibold py-3 rounded-lg transition transform hover:-translate-y-1 shadow-md">
                💖 DONASI SEKARANG
            </a>
        @endif

    </div>
</div>
@endsection
