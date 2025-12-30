@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    {{-- JUDUL --}}
    {{-- JUDUL --}}
    <div class="bg-white p-6 rounded-lg shadow-sm mb-6 flex justify-between items-center border-l-4 border-emerald-500">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Daftar Donasi
            </h1>
            <p class="text-gray-500 text-sm mt-1">Mari berbagi kebaikan untuk sesama</p>
        </div>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- LIST DONASI --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($donasi as $item)

            @php
                $persen = $item->target_donasi > 0
                    ? min(100, ($item->donasi_terkumpul / $item->target_donasi) * 100)
                    : 0;
            @endphp

            <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between hover:shadow-lg transition">
                
                {{-- GAMBAR --}}
                @if($item->gambar)
                    <div class="w-full h-48 mb-4 overflow-hidden rounded-md">
                        <img src="{{ asset('storage/' . $item->gambar) }}" 
                             alt="{{ $item->judul_donasi }}" 
                             class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-full h-48 mb-4 bg-gray-200 rounded-md flex items-center justify-center text-gray-500">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif

                {{-- JUDUL --}}
                <div>
                    <h2 class="font-semibold text-lg text-gray-800 uppercase">
                        {{ $item->judul_donasi }}
                    </h2>

                    <p class="text-sm text-gray-600 mt-1 mb-3">
                        {{ Str::limit($item->deskripsi, 80) }}
                    </p>

                    <p class="text-sm mb-1">
                        Terkumpul:
                        <strong>
                            Rp {{ number_format($item->donasi_terkumpul, 0, ',', '.') }}
                        </strong>
                    </p>

                    <p class="text-sm mb-3">
                        Target:
                        Rp {{ number_format($item->target_donasi, 0, ',', '.') }}
                    </p>

                    {{-- PROGRESS BAR --}}
                    <div class="w-full bg-gray-200 rounded h-3 mb-2">
                        <div class="bg-green-500 h-3 rounded"
                             style="width: {{ $persen }}%">
                        </div>
                    </div>

                    <p class="text-xs text-gray-500">
                        {{ number_format($persen, 0) }}% tercapai
                    </p>
                </div>

                {{-- ACTION --}}
                <div class="flex items-center justify-between mt-4">

                    <a href="{{ route('donasi.show', $item->id) }}"
                       class="text-green-600 font-medium hover:underline">
                        Detail
                    </a>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="flex items-center gap-4">

                                <a href="{{ route('donasi.edit', $item->id) }}"
                                   class="text-blue-600 font-medium hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('donasi.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus donasi ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 font-medium hover:underline">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        @endif
                    @endauth

                </div>
            </div>

        @empty
            <p class="text-gray-500 col-span-full">
                Belum ada donasi.
            </p>
        @endforelse
    </div>

</div>
@endsection
