<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }}" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.tiny.cloud/1/pi0s05we9fvgs70ikthvx2o4s6h8wd295h4en5cfuztsdgg5/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>

    @livewireStyles
    @livewireScripts
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('layouts.desktop_sidebar')
        @include('layouts.mobile_sidebar')
        <div class="flex flex-col flex-1 w-full">
            @include('layouts.navigation')
            <main class="h-full overflow-y-auto bg-blue-100 dark:bg-gray-900">
                @if (session()->has('success'))
                    <script>
                        setTimeout(function() {
                            document.querySelector('.alert').remove();
                        }, 5000);
                    </script>
                    <div role="alert"
                        class="alert w-auto absolute z-10 top-right-5 mb-2 p-2 bg-green-800 rounded-full items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex">
                        <span
                            class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">SUCCESS</span>
                        <span class="font-semibold mr-2 text-left flex-auto">{{ session('success') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                    {{-- <div
                        class="alert absolute z-10 top-0 right-0 w-64 bg-gray-100 rounded-b-lg border-t-8 border-green-600 px-4 py-4 flex flex-col justify-around shadow-md dark:bg-white text-gray-700 dark:text-gray-700">
                        <div class="flex justify-between items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div> --}}
                    @php
                        session()->forget('success');
                    @endphp
                @endif

                @if (session()->has('error'))
                    <script>
                        setTimeout(function() {
                            document.querySelector('.alert').remove();
                        }, 5000);
                    </script>
                    <div role="alert"
                        class="alert w-auto absolute z-10 top-right-5 mb-2 p-2 bg-red-800 rounded-full items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex">
                        <span
                            class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">ERROR</span>
                        <span class="font-semibold mr-2 text-left flex-auto">{{ session('error') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                    {{-- <div
                        class="alert absolute z-10 top-0 right-0 w-64 bg-gray-100 rounded-b-lg border-t-8 border-green-600 px-4 py-4 flex flex-col justify-around shadow-md dark:bg-white text-gray-700 dark:text-gray-700">
                        <div class="flex justify-between items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{ session('error') }}
                        </div>
                    </div> --}}
                    @php
                        session()->forget('error');
                    @endphp
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
