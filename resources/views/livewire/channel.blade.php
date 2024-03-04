{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
@php
    $path = parse_url(url()->current())['path'];
    $uuid = substr($path, strrpos($path, '/') + 1);
    $channel = App\Models\Page::where('uuid', $uuid)->first();
@endphp
<div class="flex flex-col items-center">
    {{ $channel->name }}
</div>
