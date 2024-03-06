{{-- Success is as dangerous as failure. --}}
@php
    $users = App\Models\User::all();
    $posts = App\Models\Post::all();
    $channels = App\Models\Page::all();
    $squads = App\Models\Group::all();
    $banned_users = App\Models\User::where('banned_to', '>', now('Asia/Yangon'))->get();

    function lineNumber()
    {
        static $line = 1;
        return $line++;
    }
@endphp
<div class="container px-6 mx-auto grid">
    <div class="grid gap-6 my-8 md:grid-cols-2 xl:grid-cols-4">
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                        clip-rule="evenodd" />
                </svg>

            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Users
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $users->count() - 1 }}
                </p>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1025 1024" fill="currentColor" class="w-6 h-6">
                    <path fill="currentColor"
                        d="M855.048 768h-87l-256 256V768h-343q-57 0-113-57t-56-115V172q0-58 56-115t113-57h686q57 0 113 57t56 115v424q0 58-56 115t-113 57zm-87-576h-512q-27 0-45.5 19t-18.5 45.5t18.5 45t45.5 18.5h512q26 0 45-18.5t19-45t-19-45.5t-45-19zm0 256h-512q-27 0-45.5 19t-18.5 45.5t18.5 45t45.5 18.5h512q26 0 45-18.5t19-45t-19-45.5t-45-19z" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Posts
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $posts->count() }}
                </p>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
                    <path fill="currentColor"
                        d="M14.158 1.026a.5.5 0 0 1 .317.632l-.5 1.5a.5.5 0 0 1-.95-.316l.5-1.5a.5.5 0 0 1 .633-.316Zm3.697 1.828a.5.5 0 1 0-.708-.707l-2 2a.5.5 0 0 0 .707.707l2-2Zm-10.248.292a2 2 0 0 1 3.261-.515l6.587 6.98a2 2 0 0 1-.648 3.203L12.87 14.55A3.504 3.504 0 0 1 9.5 19a3.498 3.498 0 0 1-2.975-1.655l-1.2.529a1.5 1.5 0 0 1-1.661-.308l-1.222-1.21a1.5 1.5 0 0 1-.299-1.71l5.464-11.5Zm-.154 13.789a2.5 2.5 0 0 0 4.488-1.977l-4.488 1.977ZM17 6a.5.5 0 0 0 0 1h1.5a.5.5 0 1 0 0-1H17Z" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Channels
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $channels->count() }}
                </p>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                        clip-rule="evenodd" />
                    <path
                        d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Squads
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $squads->count() }}
                </p>
            </div>
        </div>
    </div>

    {{-- <div class="w-1/2 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div style="width: 80%; margin: auto;">
            <canvas id="lineChart"></canvas>
        </div>

        <script>
            var ctx = document.getElementById('lineChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($data['labels']),
                    datasets: [{
                        label: 'Data',
                        data: @json($data['data']),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

    </div> --}}

    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Banned Users</h1>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3"></th>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Banned At</th>
                        <th class="px-4 py-3">Banned To</th>
                        <th class="px-4 py-3">Banned Times</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($banned_users as $user)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                {{ lineNumber() }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full"
                                            src="{{ asset('images/profiles/' . $user->profile) }}" alt=""
                                            loading="lazy" />
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $user->first_name . ' ' . $user->last_name }}
                                        </p>
                                        <a href="{{ route('profile.show', $user->username) }}"
                                            class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ '@' . $user->username }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->banned_at }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->banned_to }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                {{ $user->is_banned }}
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

</div>
