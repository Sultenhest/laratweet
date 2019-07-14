@if( $status->isLiked() )
    <form method="POST" action="{{ $status->path() }}/unlike" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-danger">Unlike</button>
    </form>
@else
    <form method="POST" action="{{ $status->path() }}/like" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-success">Like</button>
    </form>
@endif