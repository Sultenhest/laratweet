<button class="btn btn-sm rounded-left" disabled>
    {{ $status->likesCount() }} likes
</button>

@if( $status->isLiked() )
    <form method="POST" action="{{ $status->path() }}/unlike">
        @csrf
        <button type="submit" class="btn btn-sm  btn-danger">Unlike</button>
    </form>
@else
    <form method="POST" action="{{ $status->path() }}/like">
        @csrf
        <button type="submit" class="btn btn-sm btn-success">Like</button>
    </form>
@endif