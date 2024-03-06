@php
    $path = parse_url(url()->current())['path'];
    $uuid = substr($path, strrpos($path, '/') + 1);
    $post = App\Models\Post::where('uuid', $uuid)->first();
@endphp
<div class="flex flex-col items-center">
    <script>
        function openModal(title) {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal').classList.add('flex');
            document.getElementById('modal-title').innerHTML = title;
        }

        function closeModal() {
            document.getElementById('modal').classList.remove('flex');
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
    <div id="modal"
        class=" hidden absolute z-10 center-absolute w-1/4 bg-red-100 border-t-8 border-red-600 rounded-b-lg px-4 py-4 flex-col justify-around shadow-md dark:bg-white text-gray-700 dark:text-gray-700">
        <div class="flex flex-col justify-center items-center">
            <img src="{{ asset('images/website/trash_bin.gif') }}" alt="" width="100px">
            <h2 class="text-lg font-bold mt-2 text-center">Are you sure to delete <span id="modal-title"></span> ?</h2>
            <div class="flex justify-between gap-6 mt-2">
                <a href="{{ route('post.delete', $uuid, 'delete') }}"
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

    <div class="w-3/4 max-w-md bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 p-6 mt-2 mb-2">
        <div style="background-image: url({{ asset('images/thumbnails/' . $post->thumbnail) }}); background-size: cover; background-position: center; background-repeat: no-repeat;"
            class="min-h-xs flex items-center justify-center rounded-lg">
            <div class="glass-morphic min-w-xl text-center">
                <h1 class="text-3xl font-bold text-white">{{ $post->title }}
                </h1>
            </div>
        </div>
        <div class="mt-4 flex justify-between text-gray-700 dark:text-gray-100">
            <div class="flex">
                <div>
                    <img src="{{ asset('images/profiles/' . $post->user->profile) }}" alt="Avatar"
                        class="w-12 h-12 rounded-full mr-4">
                </div>
                <div>
                    <span class="text-sm font-bold">By <a
                            href="{{ route('profile.show', $post->user->username) }}">{{ $post->user->username }}</a></span><br>
                    <span class="text-sm font-bold">at {{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>
            @if (auth()->id() == $post->user_id)
                <div class="flex items-center justify-between gap-6">
                    <a href="{{ route('post.edit', $post->uuid) }}"
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Edit
                    </a>
                    <button onclick="openModal('{{ $post->title }}')"
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
                        Delete
                    </button>
                </div>
            @endif

            @if (auth()->user()->username == 'snpoc_admin')
                <div class="flex items-center justify-between gap-6">
                    <a href="{{ route('delete&ban', $post->uuid) }}"
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
                        Post Delete and Ban User
                    </a>
                </div>
            @endif
        </div>

        <div class="mt-4 dark:text-white">
            {!! $post->content !!}
        </div>

        @php
            $post_media = App\Models\PostMedia::where('post_id', $post->id)->first();
        @endphp
        @if ($post_media && $post_media->file_type == 'image')
            @php
                $medias = json_decode($post_media->file);
            @endphp
            <div class="mt-4 p-4 rounded-lg text-gray-700 dark:text-gray-100 dark:bg-gray-900">
                <div class="m-4 flex flex-row justify-between">
                    @foreach ($medias as $media)
                        <img src="{{ asset('images/posts/' . $media) }}" alt="post image" class="rounded-lg"
                            width="20%">
                    @endforeach
                </div>
            </div>
        @endif


        <hr class="mt-4 border-2" />
        <div class="mt-4 bg-blue-100 dark:bg-gray-700 p-4 rounded-md">
            <h2 class="text-xl font-bold text-gray-700 dark:text-gray-100">Comments</h2>

            <div class="mt-4">
                <form method="POST" action="{{ route('post.comment', $post->id, 'comment') }}">
                    @csrf
                    @if (auth()->user()->banned_to > now('Asia/Yangon'))
                        <div
                            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg">
                            You can't comment because your account is banned.
                        </div>
                    @else
                        <label class="w-full text-sm mt-4">
                            <div class="relative text-gray-500 focus-within:text-purple-600">
                                <input type="text" name="comment" id="comment"
                                    class="block w-full  mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                                    placeholder="Write your comment" />

                                <button type="submit"
                                    class="w-24 absolute inset-y-0 right-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">Comment</button>
                            </div>
                        </label>
                    @endif
                </form>
            </div>

            <div class="mt-4">
                @php
                    $comments = App\Models\Comment::with('post')->get('*');
                @endphp
                @forelse ($comments as $comment)
                    @if ($comment->post_id == $post->id)
                        <div
                            class="mt-4 p-4 rounded-lg flex flex-col text-gray-700 dark:text-gray-100 bg-gray-100 dark:bg-gray-900">

                            <div class="flex flex-row">
                                <div>
                                    <img src="{{ asset('images/profiles/' . $comment->user->profile) }}" alt="Avatar"
                                        class="w-12 h-12 rounded-full mr-4">
                                </div>
                                <div class="min-w-lg">
                                    <span class="text-sm font-bold">By <a
                                            href="{{ route('profile.show', $comment->user->username) }}">{{ '@' . $comment->user->username }}</a></span><br>
                                    <span class="text-sm font-bold">at
                                        {{ $comment->created_at->diffForHumans() }}</span>

                                </div>
                            </div>
                            <div class="mt-4 p-4 rounded-lg border dark:text-gray-100 dark:bg-gray-800">
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endif

                @empty
                    <p>No comments yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
