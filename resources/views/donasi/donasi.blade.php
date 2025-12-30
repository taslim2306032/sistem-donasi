@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">

    <a href="{{ route('donasi.show', $donasi->id) }}"
       class="text-blue-600 hover:underline">
        ← Kembali
    </a>

    <div class="bg-white p-6 rounded-lg shadow mt-4">

        <h2 class="text-xl font-bold mb-4">
            Donasi untuk "{{ $donasi->judul_donasi }}"
        </h2>

        <!-- INSTRUKSI PEMBAYARAN -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <h3 class="font-bold text-blue-800 text-lg mb-2">Instruksi Pembayaran</h3>
            <p class="text-sm text-blue-700 mb-2">Silakan transfer donasi ke rekening berikut:</p>
            <ul class="list-disc list-inside text-sm text-blue-700 font-semibold mb-3">
                <li>BSI: 123-456-7890 (Yayasan DonasiKu)</li>
                <li>BCA: 098-765-4321 (Yayasan DonasiKu)</li>
            </ul>
            <p class="text-xs text-blue-600">Setelah transfer, mohon upload bukti pembayaran di bawah ini agar donasi Anda dapat diverifikasi.</p>
        </div>

        <form method="POST" action="{{ route('donasi.storeNominal', $donasi->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Nominal Donasi (Rp)
                </label>
                <input type="number"
                       name="nominal"
                       class="w-full border rounded p-2"
                       placeholder="Contoh: 10000"
                       min="1000"
                       required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-semibold">
                    Upload Bukti Pembayaran
                </label>
                <input type="file"
                       name="bukti_pembayaran"
                       class="w-full border border-gray-300 rounded p-2 text-sm"
                       required>
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF.</p>
            </div>

            <button class="w-full bg-green-600 hover:bg-green-700
                           text-white font-semibold py-3 rounded-lg transition">
                🚀 Kirim Donasi & Upload Bukti
            </button>
        </form>

    </div>
</div>
@endsection
