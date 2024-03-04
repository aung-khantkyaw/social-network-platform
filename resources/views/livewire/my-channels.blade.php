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
    <div class="mt-4 p-4 rounded-lg bg-blue-100 shadow-md dark:bg-gray-700">
        @if ($ownChannels->count() > 0)
            <div class="grid gap-6 my-8 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                @foreach ($ownChannels as $channel)
                    <div class="flex flex-col p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
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
                            <div class="flex-1 bg-gray-100 p-6 flex flex-col justify-between dark:bg-gray-800">
                                <div class="flex flex-1">
                                    <img src="{{ 'images/pages/' . $channel->icon }}" alt="Avatar"
                                        class="w-12 h-12 rounded-full mr-4">
                                    <div>
                                        <h2 class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                            {{ $channel->name }}
                                        </h2>
                                        @if ($followers_count > 0)
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $followers_count }} Followers
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
            <div class="flex items-center justify-center h-160">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">No Channels Found</h1>
                    <p class="text-gray-500 dark:text-gray-300 mt-2">No channels found. Please check back later.</p>
                </div>
            </div>
        @endif
    </div>
    <div class="mt-4 p-4 rounded-lg bg-blue-100 shadow-md dark:bg-gray-700">
        @if ($followChannels->count() > 0)
            <div class="grid gap-6 my-8 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                @foreach ($followChannels as $channel)
                    <div class="flex flex-col p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
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
                            <div class="flex-1 bg-gray-100 p-6 flex flex-col justify-between dark:bg-gray-800">
                                <div class="flex flex-1">
                                    <img src="{{ 'images/pages/' . $channel->icon }}" alt="Avatar"
                                        class="w-12 h-12 rounded-full mr-4">
                                    <div>
                                        <h2 class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                            {{ $channel->name }}
                                        </h2>
                                        @if ($followers_count > 0)
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $followers_count }} Followers
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
            <div class="flex items-center justify-center h-160">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">No Channels Found</h1>
                    <p class="text-gray-500 dark:text-gray-300 mt-2">No channels found. Please check back later.</p>
                </div>
            </div>
        @endif
    </div>
</div>
