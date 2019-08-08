@can('delete', $status)
    <form method="POST" action="{{ $status->path() }}">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>
@endcan