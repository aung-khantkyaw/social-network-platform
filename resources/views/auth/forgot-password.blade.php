{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.guest')
@section('title', 'Forget Password')
@section('content')
    <div class="flex h-screen">
        <div class="container px-6 mx-auto flex flex-col justify-center items-center">
            <span class="text-black text-2xl font-bold mb-4">Social Network Platform for Online Communities</span>
            <div class="p-4 bg-gray-300 rounded-lg shadow-xl w-1/2">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Forget Password</h2>
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
                <form class="flex flex-col" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <label class="block text-sm mt-2">
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input required type="email" name="email" value="{{ old('email') }}" id="email"
                                class="block w-full pl-10 mt-1 text-sm text-black  focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                placeholder="Enter your Email" />

                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                        </div>
                    </label>


                    <button
                        class="text-white font-bold w-auto py-2 px-4 mt-4 mx-auto rounded-md border-2 bg-black hover:bg-black "
                        type="submit">Email Password Reset Link</button>
                </form>
            </div>
        </div>
    </div>

@endsection
