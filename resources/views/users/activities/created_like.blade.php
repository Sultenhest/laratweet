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
        <p>Liked the status:</p>
        @component('users.activities.activity')
            @slot('heading')
                <strong>
                    {{ $record->subject->liked->user->name }}
                </strong>

                <a href="{{ $record->subject->liked->user->path() }}">
                    {{ $record->subject->liked->user->username }}
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
                {{ $record->subject->liked->body }}
            @endslot

            @slot('bottom')
                @if (url()->current() != 'http://laratweet.test' . $record->subject->liked->path())
                    <a href="{{ $record->subject->liked->path() }}" class="btn btn-info">Go to status</a>
                @endif
            @endslot
        @endcomponent
    @endslot

    @slot('bottom')
    @endslot
@endcomponent