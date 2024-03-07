@php
    $url = $_SERVER['REQUEST_URI'];
    $parsedUrl = parse_url($url);
    $path = $parsedUrl['path'];
    $pathSegments = explode('/', $path);
    $postType = $pathSegments[1];

    $notifications = App\Models\Notification::where('user_id', auth()->id())
        ->where('read_at', null)
        ->orderBy('created_at', 'desc')
        ->get();

@endphp

<script>
    function accountDelete() {
        document.getElementById('accountDelete').classList.remove('hidden');
        document.getElementById('accountDelete').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('accountDelete').classList.remove('flex');
        document.getElementById('accountDelete').classList.add('hidden');
    }
</script>
<div id="accountDelete"
    class=" hidden absolute z-10 center-absolute w-1/3 bg-red-100 border-t-8 border-red-600 rounded-b-lg px-4 py-4 flex-col justify-around shadow-md dark:bg-white text-gray-700 dark:text-gray-700">
    <div class="flex flex-col justify-center items-center">
        <img src="{{ asset('images/website/trash_bin.gif') }}" alt="" width="100px">
        <h2 class="text-lg font-bold mt-2 text-center">Are you sure to delete <span
                id="modal-title">{{ auth()->user()->username }}</span> ?</h2>
        <span class="text-sm font-bold my-4">To confirm, type "{{ auth()->user()->username }}" in the box
            below</span>
        <input type="text" name="checkDeleteName" id="checkDeleteName" onblur="checkDeleteName()"
            class="border-black bg-gray-300 block w-full mt-1 text-sm text-black focus:shadow-outline-gray form-input">
        <div class="flex justify-between gap-6 mt-2">
            <a href="" id="deleteAccount"
                class="bg-red-600 active:bg-red-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
                type="button">
                Delete
            </a>
            <button
                class="bg-gray-600 active:bg-gray-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
                type="button" onclick="closeModal()">
                Cancle
            </button>
        </div>
    </div>
</div>

<!-- Desktop sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-gray-100 dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a href="{{ url('/') }}" class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Social Network Platform
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-1" id="home">
                <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="{{ url('/') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4">My Feed</span>
                </a>
                @if ($postType == 'post' || $postType == 'create-post' || $postType == '' || $postType == 'home')
                    <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
            </li>
        </ul>
        <!-- <hr class="my-3 dark:border-gray-600" /> -->
        <span class="px-3 my-3 font-bold text-xs text-black dark:text-gray-100">Squads</span>
        <ul>
            <li class="relative px-6 py-1">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('squads') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <span class="ml-4">Public Squads</span>
                    @if ($postType == 'squads')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
            <li class="relative px-6 py-1"\>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('my-squads') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <span class="ml-4">My Squads</span>
                    @if ($postType == 'my-squads' || $postType == 'squad')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
            <li class="relative px-6 py-1">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('create-squad') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span class="ml-4">New Squad</span>
                    @if ($postType == 'create-squad')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
        </ul>
        <!-- <hr class="my-3 dark:border-gray-600" /> -->
        <span class="px-3 my-3 font-bold text-xs text-black dark:text-gray-100">Channels</span>
        <ul>
            <li class="relative px-6 py-1">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('channels') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="w-6 h-6">
                        <path fill="currentColor"
                            d="M10.871 1.015a.5.5 0 0 1 .364.606l-.25 1a.5.5 0 1 1-.97-.242l.25-1a.5.5 0 0 1 .606-.364Zm2.983 1.132a.5.5 0 0 1 0 .707l-1 1a.5.5 0 1 1-.707-.707l1-1a.5.5 0 0 1 .707 0Zm-7.57 10.886a2 2 0 0 0 3.63-1.605l-3.63 1.605Zm-.92.406l-.998.442a1.4 1.4 0 0 1-1.555-.29l-.4-.399a1.394 1.394 0 0 1-.293-1.548l3.871-8.808a1.4 1.4 0 0 1 2.269-.427l5.332 5.316a1.395 1.395 0 0 1-.422 2.264l-2.335 1.032a3 3 0 0 1-5.469 2.418ZM14.5 5h-1a.5.5 0 0 0 0 1h1a.5.5 0 1 0 0-1ZM6.905 3.238l-3.872 8.808a.394.394 0 0 0 .083.438l.401.4a.4.4 0 0 0 .444.082l8.802-3.892a.395.395 0 0 0 .12-.64l-5.33-5.318a.4.4 0 0 0-.647.12Z" />
                    </svg>
                    <span class="ml-4">Public Channels</span>
                    @if ($postType == 'channels')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
            <li class="relative px-6 py-1" id="my_squad.html">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ '/my-channels' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="w-6 h-6">
                        <path fill="currentColor"
                            d="M10.871 1.015a.5.5 0 0 1 .364.606l-.25 1a.5.5 0 1 1-.97-.242l.25-1a.5.5 0 0 1 .606-.364Zm2.983 1.132a.5.5 0 0 1 0 .707l-1 1a.5.5 0 1 1-.707-.707l1-1a.5.5 0 0 1 .707 0Zm-7.57 10.886a2 2 0 0 0 3.63-1.605l-3.63 1.605Zm-.92.406l-.998.442a1.4 1.4 0 0 1-1.555-.29l-.4-.399a1.394 1.394 0 0 1-.293-1.548l3.871-8.808a1.4 1.4 0 0 1 2.269-.427l5.332 5.316a1.395 1.395 0 0 1-.422 2.264l-2.335 1.032a3 3 0 0 1-5.469 2.418ZM14.5 5h-1a.5.5 0 0 0 0 1h1a.5.5 0 1 0 0-1ZM6.905 3.238l-3.872 8.808a.394.394 0 0 0 .083.438l.401.4a.4.4 0 0 0 .444.082l8.802-3.892a.395.395 0 0 0 .12-.64l-5.33-5.318a.4.4 0 0 0-.647.12Z" />
                    </svg>
                    <span class="ml-4">My Channels</span>
                    @if ($postType == 'my-channels' || $postType == 'channel')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
            <li class="relative px-6 py-1" id="new_squad.html">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('create-channel') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span class="ml-4">New Channel</span>
                    @if ($postType == 'create-channel')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
        </ul>
        <!-- <hr class="my-3 dark:border-gray-600" /> -->
        <span class="px-3 my-6 font-bold text-xs text-black dark:text-gray-100">Communicate</span>
        <ul>
            <li class="relative px-6 py-1" id="chatting.html">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ url('envoy', Auth()->user()->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                    </svg>

                    <span class="ml-4">Chat</span>
                    @if ($postType == 'chatting')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
            <li class="relative px-6 py-1" id="notifications.html">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('notification') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>

                    <span class="mx-4">Notifications</span>
                    @if (count($notifications) > 0)
                        <span
                            class="ml-4 bg-red-600 px-2 rounded-md text-white font-bold">{{ $notifications->count() }}</span>
                    @endif

                    @if ($postType == 'notification')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
            <li class="relative px-6 py-1">
                <a href="{{ route('friends') }}"
                    class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>


                    <span class="ml-4">Friends</span>
                    @if ($postType == 'friends')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
        </ul>
        <!-- <hr class="my-3 dark:border-gray-600" /> -->
        <span class="px-3 my-6 font-bold text-xs text-black dark:text-gray-100">Manage</span>
        <ul>
            <li class="relative px-6 py-1">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('profile.show', auth()->user()->username) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <span class="ml-4">Profile</span>
                    @if ($postType == 'profile')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
            <li class="relative px-6 py-1">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('save-posts') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                    </svg>

                    <span class="ml-4">Save Posts</span>
                    @if ($postType == 'save-posts')
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                </a>
            </li>
        </ul>
        <hr class="my-3 dark:border-gray-600" />
        <div class="px-6 my-6">
            <button onclick="accountDelete()"
                class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
                Account Delete
                <span class="ml-2" aria-hidden="true">-</span>
            </button>
        </div>
    </div>
</aside>
<script>
    let checkInput = document.getElementById('checkDeleteName');
    let deleteButton = document.getElementById('deleteAccount');
    let checkName = @json(auth()->user()->username);

    function checkDeleteName() {
        if (checkInput.value === checkName) {
            deleteButton.href = "{{ route('profile.delete', auth()->user()->username, 'delete') }}";
        } else {
            deleteButton.href = "";
        }
    }
</script>
