{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.guest')
@section('title', 'Login')
@section('content')
    <div class="flex h-screen">
        <div class="container px-6 mx-auto flex flex-col justify-center items-center">
            <span class="text-black text-2xl font-bold mb-4">Social Network Platform for Online Communities</span>
            <div class="p-4 bg-gray-300 rounded-lg shadow-xl w-1/2">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Password Reset</h2>
                <form class="flex flex-col" method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <label class="block text-sm mt-2">
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input required autofocus autocomplete="username" type="email" name="email"
                                value="{{ old('email', $request->email) }}" id="email"
                                class="block w-full pl-10 mt-1 text-sm text-black  focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                placeholder="Email" />

                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                        </div>
                    </label>


                    <label class="block mt-2 text-sm">
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input type="password" name="password" id="password" required autocomplete="new-password"
                                class="block w-full pl-10 mt-1 text-sm text-blac focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                placeholder="Password" />
                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <button type="button"
                                class="w-20 password-toggle-icon absolute inset-y-0 right-0 flex justify-center items-center px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md"
                                onclick="password_show_hide()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="hidden w-6 h-6" id="show">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="hide">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </label>

                    <label class="block mt-2 text-sm">
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input type="password" name="password_confirmation" id="cpassword" required
                                autocomplete="new-password"
                                class="block w-full pl-10 mt-1 text-sm text-black   focus:border-purple-400 focus:outline-none focus:shadow-outline-purple  form-input"
                                placeholder="Confirm Password" />
                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <button type="button"
                                class="w-20 password-toggle-icon absolute inset-y-0 right-0 flex justify-center items-center px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md"
                                onclick="cpassword_show_hide()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="hidden w-6 h-6" id="cshow">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="chide">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </label>

                    <button
                        class="text-white font-bold w-auto py-2 px-4 mt-4 mx-auto rounded-md border-2 bg-black hover:bg-black "
                        type="submit">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function password_show_hide() {
            var input_box = document.getElementById("password");
            var show = document.getElementById("show");
            var hide = document.getElementById("hide");

            if (input_box.type === "password") {
                input_box.type = "text";
                show.classList.remove("hidden");
                hide.classList.add("hidden");
            } else {
                input_box.type = "password";
                hide.classList.remove("hidden");
                show.classList.add("hidden");
            }
        }

        function cpassword_show_hide() {
            var input_box = document.getElementById("cpassword");
            var cshow = document.getElementById("cshow");
            var chide = document.getElementById("chide");

            if (input_box.type === "password") {
                input_box.type = "text";
                cshow.classList.remove("hidden");
                chide.classList.add("hidden");
            } else {
                input_box.type = "password";
                chide.classList.remove("hidden");
                cshow.classList.add("hidden");
            }
        }
    </script>
@endsection
