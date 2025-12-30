@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-6">Edit Donasi</h2>

        <form method="POST"
              action="{{ route('donasi.update',$donasi->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 font-medium">Judul Donasi</label>
                <input type="text" name="judul_donasi"
                       value="{{ $donasi->judul_donasi }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Deskripsi</label>
                <textarea name="deskripsi"
                          class="w-full border rounded px-3 py-2" required>{{ $donasi->deskripsi }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Target Donasi</label>
                <input type="number" name="target_donasi"
                       value="{{ $donasi->target_donasi }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai"
                       value="{{ $donasi->tanggal_mulai }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Tanggal Berakhir</label>
                <input type="date" name="tanggal_berakhir"
                       value="{{ $donasi->tanggal_berakhir }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="pending" {{ $donasi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ $donasi->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ $donasi->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="expired" {{ $donasi->status == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Verifikasi</label>
                <select name="is_verified" class="w-full border rounded px-3 py-2">
                    <option value="0" {{ !$donasi->is_verified ? 'selected' : '' }}>Belum Diverifikasi</option>
                    <option value="1" {{ $donasi->is_verified ? 'selected' : '' }}>Sudah Diverifikasi</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-medium">Gambar Baru (opsional)</label>
                <input type="file" name="gambar">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('donasi.index') }}" class="text-gray-600">
                    Batal
                </a>

                <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
