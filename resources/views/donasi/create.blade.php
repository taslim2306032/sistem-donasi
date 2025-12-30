@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-6">Tambah Donasi</h2>

        <form method="POST" action="{{ route('donasi.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-medium">Judul Donasi</label>
                <input type="text" name="judul_donasi"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Deskripsi</label>
                <textarea name="deskripsi"
                          class="w-full border rounded px-3 py-2" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Target Donasi</label>
                <input type="number" name="target_donasi"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Tanggal Berakhir</label>
                <input type="date" name="tanggal_berakhir"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-medium">Gambar</label>
                <input type="file" name="gambar">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('donasi.index') }}" class="text-gray-600">
                    Batal
                </a>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
