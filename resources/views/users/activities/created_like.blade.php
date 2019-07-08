@component('users.activities.activity')
    @slot('heading')
        <strong>
            {{ $user->name }}
        </strong>

        <a href="{{ $user->path() }}">
            {{ $user->username }}
        </a>
        -
        <small>
            {{ $record->created_at->toFormattedDateString() }}

            @if( $record->updated_at->gt($record->created_at) )
                | Modified on {{ $record->updated_at->toFormattedDateString() }}
            @endif
        </small>
    @endslot

    @slot('body')
        Liked:
        <a href="/status/{{ $record->subject->liked_id }}" class="btn btn-info">Go to status</a>
    @endslot

    @slot('bottom')
    @endslot
@endcomponent