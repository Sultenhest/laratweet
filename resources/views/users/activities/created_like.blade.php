@component('partials.card')
    @slot('heading')
        <div class="d-flex">
            <div style="width:44px; height:44px" class="bg-secondary rounded"></div>
            <div class="ml-1">
                <div class="mb-0">
                    {{ $user->name }} - 
                    <a class="text-muted" href="{{ $user->path() }}">
                        {{ $user->username }}
                    </a>
                </div>
                <small class="text-muted">
                    {{ $record->created_at->toFormattedDateString() }}

                    @if( $record->updated_at->gt($record->created_at) )
                        | Modified on {{ $record->updated_at->toFormattedDateString() }}
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