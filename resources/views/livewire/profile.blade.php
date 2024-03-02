{{-- Care about people's approval and you will be their prisoner. --}}
@php
    $path = parse_url(url()->current())['path'];
    $username = substr($path, strrpos($path, '/') + 1);
    $user = App\Models\User::where('username', $username)->first();
    $posts = App\Models\Post::where('user_id', $user->id)->get();
@endphp
<div class="container p-6 mx-auto">
    <div class="relative">
        <img src="https://picsum.photos/2000/300" alt="Cover photo" class="w-full h-48 rounded-t-lg">
        <div class="absolute bottom-0 left-0 right-0 m-4 flex items-center justify-center -mt-12">
            <div class="border-4 border-black bg-gray-100 rounded-full overflow-hidden dark:border-white">
                <img src="{{ asset('images/profiles/' . $user->profile) }}" alt="Profile picture"
                    class="w-32 h-32 object-cover">
            </div>
        </div>
    </div>
    <div class="bg-gray-100 p-4 rounded-lg shadow mt-4 dark:bg-gray-800 dark:text-gray-200">
        <hr class="my-3 dark:border-gray-600" />
        <div class="flex  mt-16 md:flex-cols justify-between items-center">
            <h2 class="text-lg font-bold">{{ $user->first_name }} {{ $user->last_name }}</h2>
            <div class="flex items-center space-x-2">
                <button
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-black border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    <span class="mr-2" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </span>
                    Edit Profile
                </button>
            </div>
        </div>
        <hr class="mt-8 my-3 dark:border-gray-600" />
    </div>

    <div class="container px-2">
        <div class="flex flex-wrap">
            <div class="w-full  lg:w-40 p-4">
                <div
                    class="w-full mx-auto bg-gray-100 rounded-lg shadow-md overflow-hidden dark:bg-gray-800 dark:text-gray-200">
                    <!-- Card -->
                    <div class="p-6 text-2xl font-semibold">Friends (217)</div>
                    <div class="grid grid-cols-3 gap-6 p-6 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3">
                        <div class="rounded-lg overflow-hidden max-h-sm">
                            <img class="h-24 min-w-full object-cover" src="https://source.unsplash.com/random/1"
                                alt="">
                            <div class="py-2">
                                <a href="#" class="text-xs font-semibold">Sein Lwin</a>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden max-h-sm">
                            <img class="h-24 min-w-full object-cover" src="https://source.unsplash.com/random/2"
                                alt="">
                            <div class="py-2">
                                <a href="#" class="text-xs font-semibold">Soe Lwin Lwin</a>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden max-h-sm">
                            <img class="h-24 min-w-full object-cover" src="https://source.unsplash.com/random/3"
                                alt="">
                            <div class="py-2">
                                <a href="#" class="text-xs font-semibold">Khaing Htoo</a>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden max-h-sm">
                            <img class="h-24 min-w-full object-cover" src="https://source.unsplash.com/random/1"
                                alt="">
                            <div class="py-2">
                                <a href="#" class="text-xs font-semibold">Playboy Than Naing</a>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden max-h-sm">
                            <img class="h-24 min-w-full object-cover" src="https://source.unsplash.com/random/2"
                                alt="">
                            <div class="py-2">
                                <a href="#" class="text-xs font-semibold">Pone Yape</a>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden max-h-sm">
                            <img class="h-24 min-w-full object-cover" src="https://source.unsplash.com/random/3"
                                alt="">
                            <div class="py-2">
                                <a href="#" class="text-xs font-semibold">Myo Myat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:flex-cols lg:w-60 p-4">
                <div class="h-48 bg-green-500 rounded-lg">
                    @forelse ($posts as $post)
                        <div class="mb-4 flex flex-col p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="flex items-center justify-between">
                                <div class="flex">
                                    <img src="{{ asset('images/profiles/' . $user->profile) }}" alt="Avatar"
                                        class="w-12 h-12 rounded-full mr-4">
                                    <div>
                                        <h2 class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                            {{ $user->first_name }} {{ $user->last_name }}
                                        </h2>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ '@' . $user->username }}</p>
                                    </div>
                                </div>



                                <div class="inline-flex rounded-lg shadow-sm" role="group">
                                    <a href="{{ route('post.show', $post->uuid) }}"
                                        class="px-2 py-1 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-l-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                        Read More
                                    </a>
                                    <button type="button"
                                        class="px-2 py-1 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-r-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                        </svg>

                                    </button>
                                </div>

                            </div>
                            <div class="mt-4 h-20">
                                <h2 class="text-xl font-bold text-gray-700 dark:text-gray-100">{{ $post->title }}</h2>
                            </div>
                            <div class="mt-4">
                                <span
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                                <img src="{{ asset('images/thumbnails/' . $post->thumbnail) }}" alt="Post Image"
                                    class="text-center rounded-lg" width="100%" height="200px">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div class="flex items-center">
                                    @php
                                        $like = App\Models\Like::where([
                                            'post_id' => $post->id,
                                            'user_id' => auth()->id(),
                                        ])->exists();
                                    @endphp
                                    @if ($like)
                                        <a href="{{ route('post.dislike', $post->id, 'dislike') }}"
                                            class="hover:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium py-2 rounded mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m9 12.75 3 3m0 0 3-3m-3 3v-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </a>
                                    @else
                                        <a href="{{ route('post.like', $post->id, 'like') }}"
                                            class="hover:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium py-2 rounded mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </a>
                                    @endif
                                    <span>
                                        @if ($post->likes > 0)
                                            <span
                                                class="text-xs text-gray-700 dark:text-gray-100 font-bold">{{ $post->likes }}</span>
                                            <span class="text-xs text-gray-600 dark:text-gray-400">Upvotes</span>
                                        @endif
                                    </span>
                                </div>
                                <div>
                                    <a href="{{ route('post.show', $post->uuid) }}"class="flex items-center">
                                        <button
                                            class="hover:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium py-2 rounded mr-2"
                                            disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                            </svg>
                                        </button>
                                        <span>
                                            @if ($post->comments > 0)
                                                <span
                                                    class="text-xs text-gray-700 dark:text-gray-100 font-bold">{{ $post->comments }}</span>
                                                <span class="text-xs text-gray-600 dark:text-gray-400">Comments</span>
                                            @endif
                                        </span>
                                    </a>
                                </div>
                                <button
                                    class="hover:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium py-2 px-4 rounded mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    @empty
                        <h1 class="text-center text-red-600">Empty</h1>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
