@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h1>
        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-emerald-600">← Kembali ke Dashboard</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">No WhatsApp</th>
                    <th class="py-3 px-6 text-center">Bergabung Sejak</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold mr-3">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="font-medium">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ $user->email }}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ $user->no_wa ?? '-' }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-500">
                            Belum ada pengguna terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
