{{-- The best athlete wants his opponent at his best. --}}
@php
    $ownChannels = \App\Models\Page::all()->where('user_id', auth()->id());
    // $followChannels = \App\Models\PageLike::all()->where('user_id', auth()->id());
    $followChannels = \App\Models\Page::join('page_likes', 'pages.id', '=', 'page_likes.page_id')
        ->where('page_likes.user_id', auth()->id())
        ->get();
    $followers_count = \App\Models\Follower::all()->count();
@endphp
<div class="container px-6 mx-auto grid">
    <div class="my-4 flex justify-evenly">
        {{-- @if (session()->has('friend_request'))
            <script>
                setTimeout(function() {
                    document.querySelector('.alert').remove();
                }, 5000);
            </script>
            <div
                class="alert absolute z-10 top-0 right-0 w-auto bg-gray-100 rounded-b-lg border-t-8 border-green-600 px-4 py-4 flex flex-col justify-around shadow-md dark:bg-white text-gray-700 dark:text-gray-700">
                <div class="flex justify-between items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="pl-2 font-bold">{{ session('friend_request') }}</span>
                </div>
            </div>
            @php
                session()->forget('friend_request');
            @endphp
        @endif --}}

        <button
            class="follow flex items-center justify-between w-64 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
            Followed Channels
            <span class="ml-2" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="w-6 h-6">
                    <path fill="currentColor"
                        d="M10.871 1.015a.5.5 0 0 1 .364.606l-.25 1a.5.5 0 1 1-.97-.242l.25-1a.5.5 0 0 1 .606-.364Zm2.983 1.132a.5.5 0 0 1 0 .707l-1 1a.5.5 0 1 1-.707-.707l1-1a.5.5 0 0 1 .707 0Zm-7.57 10.886a2 2 0 0 0 3.63-1.605l-3.63 1.605Zm-.92.406l-.998.442a1.4 1.4 0 0 1-1.555-.29l-.4-.399a1.394 1.394 0 0 1-.293-1.548l3.871-8.808a1.4 1.4 0 0 1 2.269-.427l5.332 5.316a1.395 1.395 0 0 1-.422 2.264l-2.335 1.032a3 3 0 0 1-5.469 2.418ZM14.5 5h-1a.5.5 0 0 0 0 1h1a.5.5 0 1 0 0-1ZM6.905 3.238l-3.872 8.808a.394.394 0 0 0 .083.438l.401.4a.4.4 0 0 0 .444.082l8.802-3.892a.395.395 0 0 0 .12-.64l-5.33-5.318a.4.4 0 0 0-.647.12Z" />
                </svg>
            </span>
        </button>
        <button
            class="own flex items-center justify-between w-64 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
            My Own Channels
            <span class="ml-2" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="w-6 h-6">
                    <path fill="currentColor"
                        d="M10.871 1.015a.5.5 0 0 1 .364.606l-.25 1a.5.5 0 1 1-.97-.242l.25-1a.5.5 0 0 1 .606-.364Zm2.983 1.132a.5.5 0 0 1 0 .707l-1 1a.5.5 0 1 1-.707-.707l1-1a.5.5 0 0 1 .707 0Zm-7.57 10.886a2 2 0 0 0 3.63-1.605l-3.63 1.605Zm-.92.406l-.998.442a1.4 1.4 0 0 1-1.555-.29l-.4-.399a1.394 1.394 0 0 1-.293-1.548l3.871-8.808a1.4 1.4 0 0 1 2.269-.427l5.332 5.316a1.395 1.395 0 0 1-.422 2.264l-2.335 1.032a3 3 0 0 1-5.469 2.418ZM14.5 5h-1a.5.5 0 0 0 0 1h1a.5.5 0 1 0 0-1ZM6.905 3.238l-3.872 8.808a.394.394 0 0 0 .083.438l.401.4a.4.4 0 0 0 .444.082l8.802-3.892a.395.395 0 0 0 .12-.64l-5.33-5.318a.4.4 0 0 0-.647.12Z" />
                </svg>
            </span>
        </button>
    </div>

    <section class="follow_section">
        <div class="mt-4 p-4 rounded-lg bg-gray-100  shadow-md dark:bg-gray-700">
            @if ($followChannels->count() > 0)
                <div class="grid gap-6 my-8 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                    @foreach ($followChannels as $channel)
                        <div class="flex flex-col p-4 bg-blue-100 rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="flex flex-col rounded-lg shadow-lg">

                                <div class="flex-shrink-0">
                                    @if ($channel->thumbnail)
                                        <img class="w-full h-32 rounded-lg"
                                            src="{{ 'images/pages/thumbnails/' . $channel->thumbnail }}" alt="">
                                    @else
                                        <img class="w-full h-32 rounded-lg" src="https://picsum.photos/200/300"
                                            alt="">
                                    @endif
                                </div>
                                <div class="flex-1 bg-blue-100 p-6 flex flex-col justify-between dark:bg-gray-800">
                                    <div class="flex flex-1">
                                        <img src="{{ 'images/pages/' . $channel->icon }}" alt="Avatar"
                                            class="w-12 h-12 rounded-full mr-4">
                                        <div>
                                            <h2 class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                                {{ $channel->name }}
                                            </h2>
                                            @if ($channel->members > 0)
                                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                                    {{ $channel->members }} Followers
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-6 flex justify-between gap-6">
                                        <a href="{{ route('channel.show', $channel->uuid) }}"
                                            class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                            View Channel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center h-144">
                    <img src="{{ asset('images/website/zoom.gif') }}" alt="" width="150px">
                    <div class="text-center mt-6">
                        <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">No Channels Found!</h1>
                        <p class="text-gray-500 dark:text-gray-300 mt-2">There is no channel that you followed. Please
                            check back later.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <section class="hidden own_section">
        <div class="mt-4 p-4 rounded-lg bg-gray-100 shadow-md dark:bg-gray-700">
            @if ($ownChannels->count() > 0)
                <div class="grid gap-6 my-8 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                    @foreach ($ownChannels as $channel)
                        <div class="flex flex-col p-4 bg-blue-100 rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="flex flex-col rounded-lg shadow-lg">

                                <div class="flex-shrink-0">
                                    @if ($channel->thumbnail)
                                        <img class="w-full h-32 rounded-lg"
                                            src="{{ 'images/pages/thumbnails/' . $channel->thumbnail }}" alt="">
                                    @else
                                        <img class="w-full h-32 rounded-lg" src="https://picsum.photos/200/300"
                                            alt="">
                                    @endif
                                </div>
                                <div class="flex-1 bg-blue-100 p-6 flex flex-col justify-between dark:bg-gray-800">
                                    <div class="flex flex-1">
                                        <img src="{{ 'images/pages/' . $channel->icon }}" alt="Avatar"
                                            class="w-12 h-12 rounded-full mr-4">
                                        <div>
                                            <h2 class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                                {{ $channel->name }}
                                            </h2>
                                            @if ($channel->members > 0)
                                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                                    {{ $channel->members }} Followers
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-6 flex justify-between gap-6">
                                        <a href="{{ route('channel.show', $channel->uuid) }}"
                                            class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                            View Channel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center h-144">
                    <img src="{{ asset('images/website/zoom.gif') }}" alt="" width="150px">
                    <div class="text-center mt-6">
                        <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">No Channels Found!</h1>
                        <p class="text-gray-500 dark:text-gray-300 mt-2">There is no channel that you created. Please
                            check back later.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>

<script>
    let follow = document.querySelector('.follow');
    let own = document.querySelector('.own');

    let follow_section = document.querySelector('.follow_section');
    let own_section = document.querySelector('.own_section');

    follow.addEventListener('click', () => {
        follow_section.classList.remove('hidden');
        own_section.classList.add('hidden');
    });

    own.addEventListener('click', () => {
        own_section.classList.remove('hidden');
        follow_section.classList.add('hidden');
    });
</script>
