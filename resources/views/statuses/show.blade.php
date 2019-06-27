{{ $status->body }}

@foreach ($status->tags as $tag)
    {{ $tag->name }}
@endforeach

@foreach ($status->replies as $reply)
    {{ $reply->body }}
@endforeach

@if ($status->parent)
    {{ $status->parent }}
@endif

@if ($status->pinned)
    Unpin
@else
    Pin
@endif