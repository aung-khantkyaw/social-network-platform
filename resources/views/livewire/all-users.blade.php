{{-- If your happiness depends on money, you will never be happy with yourself. --}}
@php
    $users = App\Models\User::all()->where('username', '!=', 'snpoc_admin');
    $posts = App\Models\Post::all();
    $channels = App\Models\Page::all();
    $squads = App\Models\Group::all();
    $comments = App\Models\Comment::all();

    // function to banned user or not
    function isBanned($user)
    {
        if ($user->banned_to != null && $user->banned_to > now('Asia/Yangon')) {
            return true;
        }
        return false;
    }

    // function to lock user or not
    function isLocked($user)
    {
        if ($user->is_private == 1) {
            return true;
        }
        return false;
    }

    // function to count
    function counting($user_id, $types)
    {
        $count = 0;
        foreach ($types as $type) {
            if ($type->user_id == $user_id) {
                $count++;
            }
        }
        return $count;
    }

    // function to get line number
    function lineNumber()
    {
        static $line = 1;
        return $line++;
    }

@endphp
<div class="container px-6 mx-auto">
    <div class="w-full my-8 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">All Users</h1>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3"></th>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Channels</th>
                        <th class="px-4 py-3">Squads</th>
                        <th class="px-4 py-3">Posts</th>
                        <th class="px-4 py-3">Comments</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Banned Times</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($users as $user)
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
                                {{ counting($user->id, $channels) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ counting($user->id, $squads) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ counting($user->id, $posts) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ counting($user->id, $comments) }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                @if (isLocked($user))
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-lg dark:bg-red-700 dark:text-red-100">
                                        Locked
                                    </span>
                                @else
                                    @if (isBanned($user))
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                            Banned
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Active
                                        </span>
                                    @endif
                                @endif
                            </td>
                            <td class="px-4 py-3 text-xs">
                                {{ $user->is_banned }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                @if (isLocked($user))
                                    <a href="{{ route('admin.unlock', $user->id) }}"
                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-lg dark:bg-green-700 dark:text-green-100">
                                        Unlock
                                    </a>
                                @else
                                    @if (isBanned($user))
                                        <a href="{{ route('admin.unban', $user->id) }}"
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-lg dark:bg-green-700 dark:text-green-100">
                                            UNBAN
                                        </a>
                                    @else
                                        <a href="{{ route('admin.ban', $user->id) }}"
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-lg dark:bg-red-700 dark:text-red-100">
                                            BAN
                                        </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
