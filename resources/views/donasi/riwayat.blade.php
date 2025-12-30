@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Riwayat Donasi Saya</h1>

    <table class="w-full border">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">Judul Donasi</th>
                <th class="border px-4 py-2">Nominal</th>
                <th class="border px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayat as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->donasi->judul_donasi }}</td>
                    <td class="border px-4 py-2">
                        Rp {{ number_format($item->nominal,0,',','.') }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4">
                        Belum ada donasi
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
