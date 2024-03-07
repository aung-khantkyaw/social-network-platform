{{-- user info and avatar --}}
@php
    $path = parse_url(url()->current())['path'];
    $userid = substr($path, strrpos($path, '/') + 1);
    $user = App\Models\User::find($userid);
@endphp
<div class="avatar w-32 h-32 flex">
    <img src="{{ asset('images/profiles/' . $user->profile) }}" alt="avatar">
</div>
<p class="info-name">{{ $user->first_name . ' ' . $user->last_name }}</p>
<div class="messenger-infoView-btns">
    <a href="#"
        class="flex items-center justify-between w-auto px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">Delete
        Conversation</a>
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Shared Photos</span></p>
    <div class="shared-photos-list"></div>
</div>
