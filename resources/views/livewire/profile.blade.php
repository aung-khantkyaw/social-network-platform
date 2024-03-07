{{-- Care about people's approval and you will be their prisoner. --}}
@php
    $path = parse_url(url()->current())['path'];
    $username = substr($path, strrpos($path, '/') + 1);
    $user = App\Models\User::where('username', $username)->first();

    $posts = App\Models\Post::where('user_id', $user->id)
        ->where('is_page_post', 0)
        ->where('is_group_post', 0)
        ->get()
        ->sortByDesc('created_at');

    $numOfFriends = 0;
    $numOfFriends += App\Models\Friend::where('user_id', $user->id)
        ->where('status', 'accepted')
        ->count();
    $numOfFriends += App\Models\Friend::where('friend_id', $user->id)
        ->where('status', 'accepted')
        ->count();
    $user->numOfFriends = $numOfFriends;

    $friends = App\Models\Friend::where('user_id', $user->id)
        ->where('status', 'accepted')
        ->get();
    $get_friends = App\Models\Friend::where('friend_id', $user->id)
        ->where('status', 'accepted')
        ->get();

    $numOfComments = App\Models\Comment::where('user_id', $user->id)->count();
@endphp

<main class="profile-page h-full overflow-y-auto">
    <section class="relative block h-1/2">
        @if ($user->thumbnail)
            <div class="absolute top-0 w-full h-full bg-center bg-cover"
                style="background-image: url('{{ asset('images/profiles/thumbnails/' . $user->thumbnail) }}'); background-size:cover; background-repead:no-repead;">
            @else
                <div class="absolute top-0 w-full h-full bg-center bg-cover"
                    style="background-image: url('https://picsum.photos/id/237/200/300'); background-size:cover; background-repead:no-repead;">
        @endif
        <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
        </div>
        <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-20"
            style="transform: translateZ(0px)">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-gray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>
    <section class="relative py-16 bg-gray-200">
        <div class="container mx-auto px-4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-teal-100 w-full mb-6 shadow-xl rounded-lg -mt-48 dark:bg-gray-800 dark:text-gray-200">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                            <div class="relative">
                                <img src="{{ asset('images/profiles/' . $user->profile) }}"
                                    class="shadow-xl rounded-full align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-micro max-h-micro"
                                    alt="" width="150px" height="150px">
                            </div>
                        </div>
                        <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                            <div class="py-6 px-3 sm:mt-0">
                                @if ($user->username == auth()->user()->username)
                                    <a href="{{ route('profile-edit', $user->username, 'edit') }}"
                                        class="bg-blue-500 active:bg-blue-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        Edit
                                    </a>
                                @else
                                    <a href="{{ url('envoy', $user->id) }}"
                                        class="bg-blue-500 active:bg-blue-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        Connect
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="w-full lg:w-4/12 px-4 lg:order-1">
                            <div class="mt-2 flex flex-col justify-center text-center py-4 lg:pt-4 pt-8">
                                <h3 class="text-3xl font-semibold leading-normal text-gray-700 mb-2 dark:text-gray-200">
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </h3>
                                <div>
                                    @if ($user->numOfFriends > 0)
                                        <span class="text-sm"> {{ $user->numOfFriends }}
                                            @if ($user->numOfFriends > 1)
                                                friends
                                            @else
                                                friend
                                            @endif
                                        </span> <span class="font-bold">|</span>
                                    @endif
                                    @if ($posts->count() > 0)
                                        <span class="text-sm"> {{ $posts->count() }}
                                            @if ($posts->count() > 1)
                                                posts
                                            @else
                                                post
                                            @endif
                                        </span> <span class="font-bold">|</span>
                                    @endif
                                    @if ($numOfComments > 0)
                                        <span class="text-sm"> {{ $numOfComments }}
                                            @if ($numOfComments > 1)
                                                comments
                                            @else
                                                comment
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 py-6 border-t border-black dark:border-white text-center">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-9/12 px-4">
                                @if ($user->description)
                                    <p class="text-lg font-bold leading-relaxed text-gray-700 dark:text-gray-200">
                                        {{ $user->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (!($user->username == 'snpoc_admin'))
            <div class="container px-2">
                <div class="flex flex-wrap">
                    <div class="w-full  lg:w-40 p-4">
                        <div
                            class="h-106 w-full mx-auto bg-gray-100 rounded-lg shadow-md overflow-hidden dark:bg-gray-800 dark:text-gray-200">
                            <div class="p-6 text-2xl font-semibold">Friends ({{ $user->numOfFriends }})</div>
                            <div class="grid grid-cols-3 gap-6 p-6 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3">
                                @foreach ($friends as $friend)
                                    @php
                                        $friend = App\Models\User::find($friend->friend_id);
                                    @endphp
                                    <div
                                        class="rounded-lg overflow-hidden max-h-sm border border-black dark:border-white">
                                        <img class="h-24 min-w-full object-cover"
                                            src="{{ asset('images/profiles/' . $friend->profile) }}" alt="">
                                        <div class="py-2 text-center">
                                            <a href="{{ route('profile.show', $friend->username) }}"
                                                class="text-xs font-semibold">{{ $friend->username }}</a>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach ($get_friends as $friend)
                                    @php
                                        $friend = App\Models\User::find($friend->user_id);
                                    @endphp
                                    <div
                                        class="rounded-lg overflow-hidden max-h-sm border border-black dark:border-white">
                                        <img class="h-24 min-w-full object-cover"
                                            src="{{ asset('images/profiles/' . $friend->profile) }}" alt="">
                                        <div class="py-2 text-center">
                                            <a href="{{ route('profile.show', $friend->username) }}"
                                                class="text-xs font-semibold">{{ $friend->username }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:flex-cols lg:w-60 p-4">
                        <div
                            class="h-106 w-full mx-auto bg-gray-100 rounded-lg shadow-md overflow-hidden dark:bg-gray-800 dark:text-gray-200">
                            <div class="flex justify-between p-6 text-2xl font-semibold">
                                <p>About</p>
                            </div>
                            <div
                                class="p-6 m-6 bg-blue-100 rounded-lg shadow-md overflow-hidden dark:bg-gray-700 dark:text-gray-200">
                                @if ($user->school)
                                    <div class="flex mb-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                            </svg>
                                        </span>
                                        <p class="pl-2">{{ $user->school }}</p>
                                    </div>
                                @endif
                                @if ($user->college)
                                    <div class="flex mb-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                            </svg>
                                        </span>
                                        <p class="pl-2">{{ $user->college }}</p>
                                    </div>
                                @endif
                                @if ($user->university)
                                    <div class="flex mb-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                            </svg>

                                        </span>
                                        <p class="pl-2">{{ $user->university }}</p>
                                    </div>
                                @endif
                                @if ($user->work)
                                    <div class="flex mb-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                            </svg>
                                        </span>
                                        <p class="pl-2">{{ $user->work }}</p>
                                    </div>
                                @endif
                                @if ($user->website)
                                    <div class="flex mb-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                            </svg>
                                        </span>
                                        <a href="{{ $user->website }}" class="pl-2">{{ $user->website }}</a>
                                    </div>
                                @endif
                                @if ($user->relationship)
                                    <div class="flex mb-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                            </svg>
                                        </span>
                                        <p class="pl-2 capitalize">{{ $user->relationship }}
                                            @if ($user->relationship != 'single')
                                                with
                                                <a href="{{ route('profile.show', $user->partner) }}"
                                                    class="lowercase font-bold text-gray-600 dark:text-white">
                                                    {{ $user->partner }}</a>
                                            @endif
                                        </p>
                                    </div>
                                @endif
                                @if ($user->address)
                                    <div class="flex mb-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                                            </svg>

                                        </span>
                                        <p class="pl-2">{{ $user->address }}</p>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif

    </section>
    <section class="container -mt-8 mb-4 px-6 mx-auto grid">
        @if ($posts->count() > 0)
            <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                <!-- Card -->
                @foreach ($posts as $post)
                    @php
                        $title = $post->title;
                    @endphp
                    <div class="flex flex-col p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="flex items-center justify-between">
                            <div class="flex">
                                <img src="{{ asset('images/profiles/' . $user->profile) }}" alt="Avatar"
                                    class="w-12 h-12 rounded-full mr-4">
                                <div>
                                    <h2 class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </h2>
                                    <p class="text-xs text-gray-600 dark:text-gray-400"> {{ '@' . $user->username }}
                                    </p>
                                </div>
                            </div>
                            <div class="relative inline-flex rounded-lg shadow-sm" role="group">
                                <a href="{{ route('post.show', $post->uuid) }}"
                                    class="px-2 py-1 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                    Read More
                                </a>
                            </div>
                        </div>

                        <div class="mt-4 h-12">
                            <h2 class="text-xl font-bold text-gray-700 dark:text-gray-100">{{ $post->title }}</h2>
                        </div>
                        <div class="mt-4">
                            <span
                                class="text-sm text-gray-600 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                            <img src="{{ asset('images/thumbnails/' . $post->thumbnail) }}" alt="Post Image"
                                class="text-center rounded-lg" width="100%" height="200px">
                        </div>
                        <div class="mt-4 flex justify-between h-6">
                            <span>
                                @if ($post->likes > 0)
                                    <span
                                        class="text-xs text-gray-700 dark:text-gray-100 font-bold">{{ $post->likes }}</span>
                                    <span class="text-xs text-gray-600 dark:text-gray-400">Upvotes</span>
                                @endif
                            </span>

                            <div class="gap-6">
                                <span>
                                    @if ($post->comments > 0)
                                        <span
                                            class="text-xs text-gray-700 dark:text-gray-100 font-bold">{{ $post->comments }}</span>
                                        <span class="text-xs text-gray-600 dark:text-gray-400">Comments</span>
                                        <span class="text-xs font-bold text-gray-600 dark:text-white">:</span>
                                    @endif
                                </span>
                                <span>
                                    @if ($post->shares > 0)
                                        <span
                                            class="text-xs text-gray-700 dark:text-gray-100 font-bold">{{ $post->shares }}</span>
                                        <span class="text-xs text-gray-600 dark:text-gray-400">Shares</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr class="mt-2" />

                        <div class="px-4 mt-4 flex justify-between">
                            <div class="flex items-center justify-center ">
                                @php
                                    $like = App\Models\Like::where([
                                        'post_id' => $post->id,
                                        'user_id' => auth()->id(),
                                    ])->exists();
                                @endphp
                                @if ($like)
                                    <a href="{{ route('post.dislike', $post->id, 'dislike') }}"
                                        class=" hover:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium py-2 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m9 12.75 3 3m0 0 3-3m-3 3v-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('post.like', $post->id, 'like') }}"
                                        class=" hover:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium py-2 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </a>
                                @endif

                            </div>
                            <div class="flex items-center justify-center ">
                                <a href="{{ route('post.show', $post->uuid) }}"class="flex items-center">
                                    <button
                                        class="hover:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium py-2 rounded"
                                        disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                        </svg>
                                    </button>
                                </a>
                            </div>
                            <div class="flex items-center justify-center ">
                                <a href="{{ route('share-post', $post->id) }}"
                                    class="hover:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium py-2 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                    </svg>

                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex items-center justify-center h-32">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">No Posts Found</h1>
                    <p class="text-gray-500 dark:text-gray-300 mt-2">No posts found. Please check back later.</p>
                </div>
            </div>
        @endif
    </section>
</main>
