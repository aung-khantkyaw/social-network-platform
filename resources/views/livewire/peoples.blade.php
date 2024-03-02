{{-- The best athlete wants his opponent at his best. --}}
@php
    $friends = App\Models\Friend::where('user_id', auth()->id())->get();
    $requests = App\Models\Friend::where('friend_id', auth()->id())->get();
    $suggestions = App\Models\User::where('id', '!=', auth()->id())->get();
@endphp
<div>
    <div class="mt-4 flex justify-evenly">
        <button
            class="friends flex items-center justify-between w-64 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
            Friends
            <span class="ml-2" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>

            </span>
        </button>
        <button
            class="request flex items-center justify-between w-64 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
            Friends Request
            <span class="ml-2" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>

            </span>
        </button>
        <button
            class="suggestions flex items-center justify-between w-64 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
            Suggestions
            <span class="ml-2" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 3.75H6A2.25 2.25 0 0 0 3.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0 1 20.25 6v1.5m0 9V18A2.25 2.25 0 0 1 18 20.25h-1.5m-9 0H6A2.25 2.25 0 0 1 3.75 18v-1.5M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>

            </span>
        </button>
    </div>

    <div class="m-4 p-4 rounded-lg bg-blue-100 shadow-md dark:bg-gray-700">

        <div class="friends_section ">
            <div class="flex items-center justify-between ">
                <h2 class="text-xl font-bold text-gray-700 dark:text-gray-100">Friends</h2>
                <div class="flex items-center">
                    <input type="text" wire:model="search" placeholder="Search..."
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-transparent border border-gray-900 rounded-lg dark:border-white dark:text-white dark:bg-gray-800 dark:placeholder-gray-400 focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white">
                    <button
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>


                    </button>
                </div>
            </div>
            @if ($friends->isEmpty())
                <div class="flex items-center justify-center">
                    <p class="text-xl font-bold text-gray-700 dark:text-gray-100">No Friends</p>
                </div>
            @else
                <div class="mt-4 grid gap-6 my-8 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                    @foreach ($friends as $friend)
                        <div class="flex flex-col rounded-lg shadow-lg">

                            <div class="flex-shrink-0">
                                <img class="w-full h-32 rounded-lg" src="{{ 'images/profiles/' . $friend->profile }}"
                                    alt="">
                            </div>
                            <div class="flex-1 bg-gray-100 p-6 flex flex-col justify-between dark:bg-gray-800">
                                <div class="flex-1">
                                    <a href="{{ route('profile.show', $friend->username) }}" class="block mt-2">
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $friend->first_name }} {{ $friend->last_name }}</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ '@' . $friend->username }}
                                        </p>
                                    </a>
                                </div>
                                <div class="mt-6 flex justify-between">
                                    <a href="{{ route('profile.show', $friend->username) }}"
                                        class="flex items-center justify-between w-40 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                        View Profile
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                    </a>
                                    <a href="{{ route('add-friend', $friend->id) }}"
                                        class="flex items-center justify-between w-40 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                        Add Friends
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


        </div>

        <div class="hidden request_section">
            <div class="flex items-center justify-between ">
                <h2 class="text-xl font-bold text-gray-700 dark:text-gray-100">Friend Request</h2>
                <div class="flex items-center">
                    <input type="text" wire:model="search" placeholder="Search..."
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-transparent border border-gray-900 rounded-lg dark:border-white dark:text-white dark:bg-gray-800 dark:placeholder-gray-400 focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white">
                    <button
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>


                    </button>
                </div>
            </div>
            @if ($requests->isEmpty())
                <div class="flex items-center justify-center">
                    <p class="text-xl font-bold text-gray-700 dark:text-gray-100">No Friend Request</p>
                </div>
            @else
                <div class="mt-4 grid gap-6 my-8 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                    @foreach ($requests as $request)
                        <div class="flex flex-col rounded-lg shadow-lg">

                            <div class="flex-shrink-0">
                                <img class="w-full h-32 rounded-lg" src="{{ 'images/profiles/' . $request->profile }}"
                                    alt="">
                            </div>
                            <div class="flex-1 bg-gray-100 p-6 flex flex-col justify-between dark:bg-gray-800">
                                <div class="flex-1">
                                    <a href="{{ route('profile.show', $request->username) }}" class="block mt-2">
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $request->first_name }} {{ $request->last_name }}</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ '@' . $request->username }}
                                        </p>
                                    </a>
                                </div>
                                <div class="mt-6">
                                    <a href="{{ route('profile.show', $request->username) }}"
                                        class="flex items-center justify-between w-40 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                        View Profile
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    <div class="flex justify-between">
                                        <a href="{{ route('accept-friend', $request->id) }}"
                                            class="flex items-center justify-between w-40 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                            Accept Request
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('reject-friend', $request->id) }}"
                                            class="flex items-center justify-between w-40 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                            Reject Request
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="hidden suggestions_section">
            <div class="flex items-center justify-between ">
                <h2 class="text-xl font-bold text-gray-700 dark:text-gray-100">Suggestion</h2>
                <div class="flex items-center">
                    <input type="text" wire:model="search" placeholder="Search..."
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-transparent border border-gray-900 rounded-lg dark:border-white dark:text-white dark:bg-gray-800 dark:placeholder-gray-400 focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white">
                    <button
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>


                    </button>
                </div>
            </div>
            @if ($suggestions->isEmpty())
                <div class="flex items-center justify-center">
                    <p class="text-xl font-bold text-gray-700 dark:text-gray-100">No Suggestions</p>
                </div>
            @else
                <div class="mt-4 grid gap-6 my-8 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                    @foreach ($suggestions as $suggestion)
                        <div class="flex flex-col rounded-lg shadow-lg">

                            <div class="flex-shrink-0">
                                <img class="w-full h-32 rounded-lg"
                                    src="{{ 'images/profiles/' . $suggestion->profile }}" alt="">
                            </div>
                            <div class="flex-1 bg-gray-100 p-6 flex flex-col justify-between dark:bg-gray-800">
                                <div class="flex-1">
                                    <a href="{{ route('profile.show', $suggestion->username) }}" class="block mt-2">
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $suggestion->first_name }} {{ $suggestion->last_name }}</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ '@' . $suggestion->username }}
                                        </p>
                                    </a>
                                </div>
                                <div class="mt-6 flex justify-between">
                                    <a href="{{ route('profile.show', $suggestion->username) }}"
                                        class="flex items-center justify-between w-40 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                        View Profile
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                    </a>
                                    <a href="{{ route('add-friend', $suggestion->id) }}"
                                        class="flex items-center justify-between w-40 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                        Add Friends
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    let friends = document.querySelector('.friends');
    let request = document.querySelector('.request');
    let suggestions = document.querySelector('.suggestions');

    let friends_section = document.querySelector('.friends_section');
    let request_section = document.querySelector('.request_section');
    let suggestions_section = document.querySelector('.suggestions_section');

    // add class and remove class
    friends.addEventListener('click', () => {
        friends_section.classList.remove('hidden');
        request_section.classList.add('hidden');
        suggestions_section.classList.add('hidden');
    });

    request.addEventListener('click', () => {
        request_section.classList.remove('hidden');
        friends_section.classList.add('hidden');
        suggestions_section.classList.add('hidden');
    });

    suggestions.addEventListener('click', () => {
        suggestions_section.classList.remove('hidden');
        friends_section.classList.add('hidden');
        request_section.classList.add('hidden');
    });
</script>
