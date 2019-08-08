<button class="btn btn-sm rounded-left" disabled>
    {{ $status->replies->count() }} replies
</button>

<a href="{{ $status->path() }}" class="btn btn-sm btn-primary">Reply</a>