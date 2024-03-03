{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
@php
    $channels = \App\Models\Page::all();
@endphp
<div>
    @foreach ($channels as $channel)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $channel->name }}</h4>
                </div>
                <div class="card-body">
                    <p>{{ $channel->description }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
