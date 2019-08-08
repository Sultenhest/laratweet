@component('partials.card')
    @slot('heading')
        <div class="d-flex">
            <img src="{{url('/images/default.jpg')}}" width="50px" class="img-fluid img-thumbnail"/>
            <div class="ml-1">
                <div class="mb-0">
                    {{ $record->subject->user->name }} - 
                    <a class="text-muted" href="{{ $record->subject->user->path() }}">
                        {{ $record->subject->user->username }}
                    </a>
                </div>
                <small class="text-muted">
                    {{ $record->created_at->toDayDateTimeString() }}

                    @if( $record->updated_at->gt($record->created_at) )
                        | Modified on {{ $record->updated_at->toDayDateTimeString() }}
                    @endif
                </small>
            </div>
        </div>
    @endslot

    @slot('body')
        <p class="lead">Liked a status:</p>

        @include("statuses.partials.status_card", [
            'status' => $record->subject->liked,
        ])
    @endslot

    @slot('bottom')
    @endslot
@endcomponent