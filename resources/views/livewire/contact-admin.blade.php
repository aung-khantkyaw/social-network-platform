@section('title', 'Contact Admin')
@php
    $user = Auth::user();
@endphp
<div class="flex items-center justify-center h-screen">
    <form action="{{ route('contact.admin', $user->id) }}" method="post">
        <button type="submit">Send</button>
    </form>
</div>
