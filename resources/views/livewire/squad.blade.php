{{-- Do your work, then step back. --}}
@php
    $path = parse_url(url()->current())['path'];
    $uuid = substr($path, strrpos($path, '/') + 1);
    $squad = App\Models\Group::where('uuid', $uuid)->first();
    $posts = App\Models\Post::where('group_id', $squad->id)
        ->get()
        ->sortByDesc('created_at');
    $joined = App\Models\GroupMember::where('user_id', auth()->id())
        ->where('group_id', $squad->id)
        ->exists();

@endphp
<div class="container p-6 mx-auto">
    <script>
        function squadDelete() {
            document.getElementById('squadDelete').classList.remove('hidden');
            document.getElementById('squadDelete').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('squadDelete').classList.remove('flex');
            document.getElementById('squadDelete').classList.add('hidden');
        }
    </script>
    <div id="squadDelete"
        class=" hidden absolute z-10 center-absolute w-1/3 bg-red-100 border-t-8 border-red-600 rounded-b-lg px-4 py-4 flex-col justify-around shadow-md dark:bg-white text-gray-700 dark:text-gray-700">
        <div class="flex flex-col justify-center items-center">
            <img src="{{ asset('images/website/trash_bin.gif') }}" alt="" width="100px">
            <h2 class="text-lg font-bold mt-2 text-center">Are you sure to delete <span
                    id="modal-title">{{ $squad->name }}</span> ?</h2>
            <span class="text-sm font-bold my-4">To confirm, type "{{ $squad->name }}" in the box
                below</span>
            <input type="text" name="checkDeleteSquadName" id="checkDeleteSquadName" onblur="checkDeleteSquadName()"
                class="border-black bg-gray-300 block w-full mt-1 text-sm text-black focus:shadow-outline-gray form-input">
            <div class="flex justify-between gap-6 mt-2">
                <a href="" id="deleteSquad"
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
    <div class="relative">
        <img src="{{ asset('images/squads/thumbnails/' . $squad->thumbnail) }}" alt="Cover photo"
            class="w-full h-72 rounded-t-lg">
    </div>
    <div class="bg-gray-100 p-4 rounded-lg shadow mt-4 dark:bg-gray-800 dark:text-gray-200">
        <hr class="my-3 dark:border-gray-600" />
        <div class="flex justify-between items-center p-4">
            <div class="border-4 border-black bg-gray-100 rounded-lg overflow-hidden dark:border-white">
                <img src="{{ asset('images/squads/' . $squad->icon) }}" alt="Profile picture"
                    class="w-24 h-24 object-cover">
            </div>
            <div class="text-center">
                <h2 class="text-lg font-bold">{{ $squad->name }}</h2>

                <span class="font-semibold text-sm text-gray-600 dark:text-gray-400">
                    {{ $squad->members }} @if ($squad->members > 1)
                        Members
                    @else
                        Member
                    @endif |
                    {{ $posts->count() }}
                    @if ($posts->count() > 1)
                        Posts
                    @else
                        Post
                    @endif
                </span><br />
                <span class="font-semibold text-sm text-gray-600 dark:text-gray-400">" {{ $squad->description }}
                    "</span>
            </div>
            <div class="flex gap-6">
                @if ($squad->user_id == auth()->id())
                    <a href="{{ route('squad.create-post', $squad->uuid) }}"
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        New Post
                    </a>
                    <button onclick="squadDelete()"
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                        Delete Squad
                    </button>
                @elseif($joined)
                    <a href="{{ route('squad.create-post', $squad->uuid) }}"
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        New Post
                    </a>
                    <a href="{{ route('leave-squad', $squad->id) }}"
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
                        Leave Squad
                    </a>
                @else
                    <a href="{{ route('join-squad', $squad->id) }}"
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                        Join Squad
                    </a>
                @endif

            </div>
        </div>
        <hr class="my-3 dark:border-gray-600" />
    </div>

    <section class="container my-4 px-6 mx-auto grid">
        @if ($posts->count() > 0)
            <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                <!-- Card -->
                @forelse ($posts as $post)
                    @php
                        $user = App\Models\User::where('id', $post->user_id)->first();
                        $title = $post->title;
                    @endphp
                    <div class="flex flex-col p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="flex items-center justify-between">
                            <div class="flex">
                                <img src="{{ asset('images/profiles/' . $user->profile) }}" alt="Avatar"
                                    class="w-12 h-12 rounded-full mr-4">
                                <div>
                                    <a href="{{ route('profile.show', $user->username) }}">
                                        <h2 class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                            {{ $user->first_name . ' ' . $user->last_name }}
                                        </h2>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ '@' . $user->username }}
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="relative inline-flex rounded-lg shadow-sm" role="group">
                                <a href="{{ route('squad.post.show', $post->uuid) }}"
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
                @empty
                    {{-- <h1 class="text-center text-red-600">Empty</h1> --}}
                @endforelse
            </div>
        @else
            <div class="flex items-center justify-center h-56">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">No Posts Found</h1>
                    <p class="text-gray-500 dark:text-gray-300 mt-2">No posts found. Please check back later.</p>
                </div>
            </div>

        @endif
    </section>
</div>
<script>
    let checkInputSquad = document.getElementById('checkDeleteSquadName');
    let deleteSquadButton = document.getElementById('deleteSquad');
    let checkSquad = @json($squad->name);

    function checkDeleteSquadName() {
        if (checkInputSquad.value === checkSquad) {
            deleteSquadButton.href = "{{ route('delete-squad', $squad->id) }}";
        } else {
            deleteSquadButton.href = "";
        }
    }
</script>
