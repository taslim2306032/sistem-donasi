@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Verifikasi Donasi</h1>
        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-emerald-600">← Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">Donatur</th>
                    <th class="py-3 px-6 text-left">Kampanye</th>
                    <th class="py-3 px-6 text-center">Nominal</th>
                    <th class="py-3 px-6 text-center">Bukti</th>
                    <th class="py-3 px-6 text-center">Tanggal</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($pendingDonations as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="font-medium">{{ $item->user->name ?? 'Anonim' }}</div>
                            </div>
                            <div class="text-xs text-gray-400">{{ $item->user->email ?? '' }}</div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ Str::limit($item->donasi->judul_donasi ?? '-', 30) }}
                        </td>
                        <td class="py-3 px-6 text-center font-bold text-emerald-600">
                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            @if($item->bukti_pembayaran)
                                <a href="{{ asset('storage/'.$item->bukti_pembayaran) }}" target="_blank" 
                                   class="bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-xs font-bold hover:bg-blue-200">
                                    Lihat Bukti
                                </a>
                            @else
                                <span class="bg-red-100 text-red-600 py-1 px-3 rounded-full text-xs">Tidak Ada</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center">
                            {{ $item->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center gap-2">
                                {{-- APPROVE --}}
                                <form action="{{ route('admin.payments.verify', $item->id) }}" method="POST" onsubmit="return confirm('Terima pembayaran ini?')">
                                    @csrf
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit" class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center hover:bg-green-200 hover:scale-110 transition" title="Terima">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                </form>

                                {{-- REJECT --}}
                                <form action="{{ route('admin.payments.verify', $item->id) }}" method="POST" onsubmit="return confirm('Tolak pembayaran ini?')">
                                    @csrf
                                    <input type="hidden" name="action" value="reject">
                                    <button type="submit" class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-200 hover:scale-110 transition" title="Tolak">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Tidak ada pembayaran yang perlu diverifikasi saat ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
