{{-- Stop trying to control. --}}
@php
    // Get all squads except the user's own squads and the squads the user is already following
$squads = \App\Models\Group::all()->where('user_id', '!=', auth()->id());
@endphp
<div class="container px-6 mx-auto grid">
    <div class="mt-4 p-4 rounded-lg bg-gray-100 shadow-md dark:bg-gray-700">
        @if ($squads->count() > 0)
            <div class="grid gap-6 my-8 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                @foreach ($squads as $squad)
                    @if (App\Models\GroupMember::where('user_id', auth()->id())->where('group_id', $squad->id)->exists())
                        @continue
                    @else
                        <div class="flex flex-col p-4 bg-blue-100 rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="flex flex-col rounded-lg shadow-lg">

                                <div class="flex-shrink-0">
                                    @if ($squad->thumbnail)
                                        <img class="w-full h-32 rounded-lg"
                                            src="{{ 'images/squads/thumbnails/' . $squad->thumbnail }}" alt="">
                                    @else
                                        <img class="w-full h-32 rounded-lg" src="https://picsum.photos/200/300"
                                            alt="">
                                    @endif
                                </div>
                                <div class="flex-1 bg-blue-100 p-6 flex flex-col justify-between dark:bg-gray-800">
                                    <div class="flex flex-1">
                                        <img src="{{ 'images/squads/' . $squad->icon }}" alt="Avatar"
                                            class="w-12 h-12 rounded-full mr-4">
                                        <div>
                                            <h2 class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                                {{ $squad->name }}
                                            </h2>
                                            @if ($squad->members > 0)
                                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                                    {{ $squad->members }} members
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-6 flex justify-between gap-6">
                                        <a href="{{ route('squad.show', $squad->uuid) }}"
                                            class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                            View Squad
                                        </a>
                                        <a href="{{ route('join-squad', $squad->id) }}"
                                            class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">
                                            Join Squad
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
                <div class="text-center mt-6 ">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">No Squads Found</h1>
                    <p class="text-gray-500 dark:text-gray-300 mt-2">There is no squad. Please check back later.</p>
                </div>
            </div>
        @endif
    </div>
</div>
