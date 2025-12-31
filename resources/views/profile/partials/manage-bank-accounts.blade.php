<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Manajemen Rekening Donasi') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Tambahkan atau hapus nomor rekening yang ditampilkan di halaman donasi.') }}
        </p>
    </header>

    <div class="mt-6 space-y-4">
        <!-- List Rekening -->
        @if($bankAccounts->isEmpty())
            <p class="text-sm text-gray-500 italic">Belum ada rekening yang ditambahkan.</p>
        @else
            <div class="space-y-2">
                @foreach($bankAccounts as $account)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-bold text-gray-800">{{ $account->bank_name }}: {{ $account->account_number }}</p>
                            <p class="text-xs text-gray-600">A.N {{ $account->account_holder }}</p>
                        </div>
                        <form method="POST" action="{{ route('bank-accounts.destroy', $account->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold"
                                onclick="return confirm('Hapus rekening ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Form Tambah -->
        <hr class="my-4 border-gray-200">
        
        <form method="POST" action="{{ route('bank-accounts.store') }}" class="space-y-4">
            @csrf
            <div>
                <x-input-label for="bank_name" :value="__('Nama Bank')" />
                <x-text-input id="bank_name" name="bank_name" type="text" class="mt-1 block w-full" placeholder="Contoh: BCA / BRI / Mandiri" required />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="account_number" :value="__('Nomor Rekening')" />
                    <x-text-input id="account_number" name="account_number" type="text" class="mt-1 block w-full" placeholder="1234567890" required />
                </div>
                <div>
                    <x-input-label for="account_holder" :value="__('Atas Nama')" />
                    <x-text-input id="account_holder" name="account_holder" type="text" class="mt-1 block w-full" placeholder="Nama Pemilik" required />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Simpan Rekening') }}</x-primary-button>
            </div>
        </form>
    </div>
</section>
