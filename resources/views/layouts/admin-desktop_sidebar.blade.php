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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>

                    <span class="ml-4">Dashboard</span>
                </a>
                @if ($postType == 'post' || $postType == 'create-post' || $postType == '' || $postType == 'home' || $postType == 'admin')
                    <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
            </li>
        </ul>


        <!-- <hr class="my-3 dark:border-gray-600" /> -->
        <span class="px-3 my-6 font-bold text-xs text-black dark:text-gray-100">Communicate</span>
        <ul>
            <li class="relative px-6 py-1">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('all-users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>


                    <span class="ml-4">Users</span>
                    @if ($postType == 'all-users')
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
        </ul>
        <hr class="my-3 dark:border-gray-600" />
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
