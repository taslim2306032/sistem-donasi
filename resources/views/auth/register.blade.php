<x-guest-layout>

    <!-- HEADER REGISTER -->
    <div class="text-center mb-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Buat Akun Baru
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Daftarkan akun Anda untuk mulai berdonasi
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- No WA -->
        <div class="mt-4">
            <x-input-label for="no_wa" value="Nomor WhatsApp" />
            <x-text-input
                id="no_wa"
                class="block mt-1 w-full"
                type="text"
                name="no_wa"
                :value="old('no_wa')"
                required
                placeholder="08123456789"
            />
            <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a
                href="{{ route('login') }}"
                class="text-sm text-gray-600 hover:text-gray-900"
            >
                Sudah punya akun?
            </a>

            <x-primary-button>
                Daftar
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>
