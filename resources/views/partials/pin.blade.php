@can('update', $status)
    <form method="POST" action="{{ $status->path() }}/pin">
        @csrf
        @method('PATCH')

        <button type="submit" class="btn btn-primary">
            @if ($status->pinned)
                Unpin
            @else
                Pin
            @endif
        </button>
    </form>
@endcan