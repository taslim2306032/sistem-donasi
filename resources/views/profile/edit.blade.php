@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                {{ __('Profile') }}
            </h1>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" x-data="{ open: false }">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Informasi Akun') }}
                    </h2>
                    <button @click="open = !open" class="text-indigo-600 hover:text-indigo-900 font-medium">
                        <span x-show="!open">{{ __('Ubah Profil') }}</span>
                        <span x-show="open">{{ __('Batal') }}</span>
                    </button>
                </div>

                <div class="max-w-xl mt-4 transition-all duration-300" x-show="open">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" x-data="{ open: false }">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Security') }}
                    </h2>
                    <button @click="open = !open" class="text-indigo-600 hover:text-indigo-900 font-medium">
                        <span x-show="!open">{{ __('Ubah Password') }}</span>
                        <span x-show="open">{{ __('Batal') }}</span>
                    </button>
                </div>

                <div x-show="open" class="mt-4 max-w-xl transition-all duration-300">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            @if(auth()->user()->role === 'admin' || auth()->user()->usertype === 'admin')
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" x-data="{ open: false }">
                 <div class="flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Manajemen Rekening') }}
                    </h2>
                    <button @click="open = !open" class="text-indigo-600 hover:text-indigo-900 font-medium">
                        <span x-show="!open">{{ __('Kelola') }}</span>
                        <span x-show="open">{{ __('Tutup') }}</span>
                    </button>
                </div>

                <div x-show="open" class="mt-4 max-w-xl transition-all duration-300">
                    @include('profile.partials.manage-bank-accounts')
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
