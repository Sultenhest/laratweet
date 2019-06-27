{{ $tag->name }}

@foreach ($statuses as $status)
    {{ $status->body }}
@endforeach