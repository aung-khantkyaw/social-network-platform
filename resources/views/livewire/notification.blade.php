{{-- The whole world belongs to you. --}}
@php

    $notReadNotifications = App\Models\Notification::where('user_id', auth()->id())
        ->where('read_at', null)
        ->orderBy('created_at', 'desc')
        ->limit(50)
        ->get();

    $ReadNotifications = App\Models\Notification::where('user_id', auth()->id())
        ->where('read_at', '!=', null)
        ->orderBy('created_at', 'desc')
        ->limit(50)
        ->get();

@endphp
<div class="container px-6 mx-auto grid">

    <div class="flex justify-between items-center mt-4">
        <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Notifications</h1>
        <div class="flex items-center justify-center gap-6">
            <button
                class="notRead flex items-center justify-between w-64 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">

                <span class="ml-2" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                    </svg>
                </span>
                Not Read @if (count($notReadNotifications) > 0)
                    {{ '( ' . count($notReadNotifications) . ' )' }}
                @endif
            </button>
            <button
                class="read flex items-center justify-between w-64 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
                All Notifications
            </button>
        </div>
        <a href="{{ route('mark-all-as-read') }}" class="text-sm text-blue-500 dark:text-blue-300 hover:underline">Mark
            all as read</a>
    </div>


    <div class="mt-4 p-4 rounded-lg bg-gray-100 shadow-md dark:bg-gray-700">
        <div class="flex justify-center">
            <div class="notRead_section mt-2 w-1/2 h-144 overflow-y-auto">
                @forelse ($notReadNotifications as $notification)
                    @php
                        $senderName = strtok($notification->message, ' ');
                        $notificationFrom = App\Models\User::where('username', $senderName)->first();
                    @endphp
                    @if ($notificationFrom !== null)
                        <div
                            class="w-full flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
                            <a href="{{ url($notification->url) }}" class="flex items-center w-2/3">
                                <img src="{{ 'images/profiles/' . $notificationFrom->profile }}" alt="Avatar"
                                    class="w-12 h-12 rounded-full mr-4">
                                <p class="text-sm text-black dark:text-white">
                                    <span
                                        class="text-lg font-bold text-black dark:text-white">{{ $notification->type }}</span>
                                    <br />
                                    {{ $notification->message }}
                                </p>
                            </a>
                            <a href="{{ route('mark-as-read', $notification->id) }}">Make as read</a>
                        </div>
                    @endif
                @empty
                    <div class="flex flex-col items-center justify-center h-144">
                        <img src="{{ asset('images/website/zoom.gif') }}" alt="" width="150px">
                        <div class="text-center mt-6">
                            <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">No Notification Found!
                            </h1>
                            <p class="text-gray-500 dark:text-gray-300 mt-2">There is no notification. Please check back
                                later.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="hidden read_section mt-2 w-full h-144 overflow-y-auto">
                @forelse ($ReadNotifications as $notification)
                    @php
                        $senderName = strtok($notification->message, ' ');
                        $notificationFrom = App\Models\User::where('username', $senderName)->first();
                    @endphp
                    @if ($notificationFrom !== null)
                        <a class="w-1/2 mx-auto flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                            href="{{ url($notification->url) }}">
                            <div class="flex items-center">
                                <img src="{{ 'images/profiles/' . $notificationFrom->profile }}" alt="Avatar"
                                    class="w-12 h-12 rounded-full mr-4">
                                <p class="text-sm text-black dark:text-white">
                                    <span
                                        class="text-lg font-bold text-black dark:text-white">{{ $notification->type }}</span>
                                    <br />
                                    {{ $notification->message }}
                                </p>
                            </div>
                            <span>{{ $notification->created_at->diffForHumans() }} &RightArrow;</span>
                        </a>
                    @endif
                @empty
                    <div class="flex flex-col items-center justify-center h-144">
                        <img src="{{ asset('images/website/zoom.gif') }}" alt="" width="150px">
                        <div class="text-center mt-6">
                            <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">No Notification Found!
                            </h1>
                            <p class="text-gray-500 dark:text-gray-300 mt-2">There is no notification. Please check back
                                later.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    let notRead = document.querySelector('.notRead');
    let read = document.querySelector('.read');

    let notRead_section = document.querySelector('.notRead_section');
    let read_section = document.querySelector('.read_section');

    notRead.addEventListener('click', () => {
        notRead_section.classList.remove('hidden');
        read_section.classList.add('hidden');
    });

    read.addEventListener('click', () => {
        read_section.classList.remove('hidden');
        notRead_section.classList.add('hidden');
    });
</script>
