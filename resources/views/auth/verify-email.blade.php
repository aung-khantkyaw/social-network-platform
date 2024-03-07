{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button type="submit">
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    {{ __('Edit Profile') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout> --}}

@extends('layouts.guest')
@section('title', 'Verify Email')
@section('content')
    <div class="flex h-screen">
        <div class="container px-6 mx-auto flex justify-center items-center">
            <div
                class="p-4 bg-gray-100 rounded-lg shadow-xl w-2/3 dark:bg-gray-800 flex flex-col items-center border-t-8 border-blue-600">
                <h3 class="text-center text-white pb-2 text-xl font-bold sm:text-2xl">Verify your email address
                </h3>
                <span class="bg-blue-500 mx-auto mb-6 inline-block h-1 w-10 rounded"></span>
                <p class="text-gray-400 mb-6 lead w-2/3 text-center">
                    {{ __('Thanks for signing up!') }}
                    <br />
                    {{ __('Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email,we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <script>
                        setTimeout(function() {
                            document.querySelector('.alert').remove();
                        }, 5000);
                    </script>
                    <div
                        class="alert px-4 py-2 mb-6 bg-blue-600 rounded-full flex justify-center text-blue-100 lead lg:rounded-full flex lg:inline-flex">
                        <span class="font-semibold text-sm">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}</span>
                    </div>
                @endif

                <div class="flex flex-row gap-6">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <button type="submit"
                                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                {{ __('Resend Verification Email') }}
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
