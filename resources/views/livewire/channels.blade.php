{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
@php
    // Get all channels except the user's own channels and the channels the user is already following
$channels = \App\Models\Page::all()->where('user_id', '!=', auth()->id());
@endphp
<div class="container px-6 mx-auto grid">
    <div class="mt-4 p-4 rounded-lg bg-blue-100 shadow-md dark:bg-gray-700">
        @if ($channels->count() > 0)
            <div class="grid gap-6 my-8 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                @foreach ($channels as $channel)
                    @if (App\Models\PageLike::where('user_id', auth()->id())->where('page_id', $channel->id)->exists())
                        @continue
                    @else
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
                                            @if ($channel->members > 0)
                                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                                    {{ $channel->members }} Followers
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-6 flex justify-between gap-6">
                                        <a href="{{ route('channel.show', $channel->uuid) }}"
                                            class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                            View Channel
                                        </a>
                                        <a href="{{ route('follow-channel', $channel->id) }}"
                                            class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                            Follow Channel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center h-160">
                <img src="{{ asset('images/website/zoom.gif') }}" alt="" width="150px">
                <div class="text-center mt-6">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">No Channels Found</h1>
                    <p class="text-gray-500 dark:text-gray-300 mt-2">No channels found. Please check back later.</p>
                </div>
            </div>
        @endif
    </div>
</div>
