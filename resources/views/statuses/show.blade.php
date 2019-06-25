{{ $status->body }}

@foreach ($status->replies as $reply)
    {{ $reply->body }}
@endforeach

@if ($status->parent)
    {{ $status->parent }}
@endif