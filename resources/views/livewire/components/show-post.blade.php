@php
    $path = parse_url(url()->current())['path'];
    $uuid = substr($path, strrpos($path, '/') + 1);
    $post = App\Models\Post::where('uuid', $uuid)->first();
@endphp
<div class="flex flex-col items-center">
    <div class="w-3/4 max-w-md bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 p-6 mt-2 mb-2">
        <div style="background-image: url({{ asset('images/thumbnails/' . $post->thumbnail) }}); background-size: cover; background-position: center; background-repeat: no-repeat;"
            class="min-h-xs flex items-center justify-center">
            <div class="glass-morphic min-w-xl text-center">
                <h1 class="text-3xl font-bold text-white">{{ $post->title }}
                </h1>

            </div>
        </div>
        <div class="mt-4 flex text-gray-700 dark:text-gray-100">
            <div>
                <img src="{{ asset('images/profiles/' . $post->user->profile) }}" alt="Avatar"
                    class="w-12 h-12 rounded-full mr-4">
            </div>
            <div>
                <span class="text-sm font-bold">By <a
                        href="{{ route('profile.show', $post->user->username) }}">{{ '@' . $post->user->username }}</a></span><br>
                <span class="text-sm font-bold">at {{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <div class="mt-4">
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
        <div class="mt-4">
            <h2 class="text-xl font-bold text-gray-700 dark:text-gray-100">Comments</h2>

            <div class="mt-4">
                <form method="POST" action="{{ route('post.comment', $post->id, 'comment') }}">
                    @csrf

                    <label class="w-full text-sm mt-4">
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input type="text" name="comment" id="comment"
                                class="block w-full  mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                                placeholder="Write your comment" />

                            <button type="submit"
                                class="w-24 absolute inset-y-0 right-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">Comment</button>
                        </div>
                    </label>
                </form>
            </div>

            <div class="mt-4">
                @php
                    $comments = App\Models\Comment::with('post')->get('*');
                @endphp
                @forelse ($comments as $comment)
                    @if ($comment->post_id == $post->id)
                        <div
                            class="mt-4 p-4 rounded-lg flex flex-col text-gray-700 dark:text-gray-100 dark:bg-gray-900">

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
                            <div class="mt-4 p-4 rounded-lg  dark:text-gray-100 dark:bg-gray-800">
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

<script>
    let url = window.location.pathname;
    let filename = url.substring(url.lastIndexOf('/') + 1);
    let curFile = document.getElementById(filename);
    if (filename == "" || filename == "create-post") {
        curFile = document.getElementById("home");
    }
    let span = document.createElement("span");
    span.className = "absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg";
    span.setAttribute("aria-hidden", "true");
    curFile.appendChild(span);
</script>
