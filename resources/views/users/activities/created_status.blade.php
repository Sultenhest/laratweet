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
        {{ $record->subject->body }}

        <p class="d-inline">
            Tags:
            <ul class="d-inline list-inline">
                @foreach ($record->subject->tags as $tag)
                    <li class="list-inline-item">
                        <a href="{{ $tag->path() }}">
                            {{ $tag->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </p>
    @endslot

    @slot('bottom')
        @if (url()->current() != 'http://laratweet.test' . $record->subject->path())
            <a href="{{ $record->subject->path() }}" class="btn btn-info">Go to status</a>
        @endif
        
        @include('partials.like_status', [
            'status' => $record->subject
        ])

        <form method="POST" action="{{ $record->subject->path() }}/reply" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-primary">Reply</button>
        </form>
    @endslot
@endcomponent