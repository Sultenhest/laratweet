@component('partials.card')
    @slot('heading')
        <div class="d-flex">
            <div style="width:44px; height:44px" class="bg-secondary rounded"></div>
            <div class="ml-1">
                <div class="mb-0">
                    {{ $status->user->name }} - 
                    <a class="text-muted" href="{{ $status->user->path() }}">
                        {{ $status->user->username }}
                    </a>
                </div>
                <small class="text-muted">
                    {{ $status->created_at->toDayDateTimeString() }}

                    @if( $status->updated_at->gt($status->created_at) )
                        | Modified on {{ $status->updated_at->toDayDateTimeString() }}
                    @endif
                </small>
            </div>
        </div>
    @endslot

    @slot('body')

        <p class="lead mb-0">{{ $status->body }}</p>

        <p class="d-inline">
            Tags:
            <p class="d-inline">
                @foreach ($status->tags as $tag)
                    <a href="{{ $tag->path() }}">{{ $tag->name }}</a>,
                @endforeach
            </p>
        </p>
    @endslot

    @slot('bottom')
        <div class="d-flex">
            @include('statuses.partials.like_status')

            <button type="submit" class="btn btn-sm  btn-primary">Reply</button>

            @include('statuses.partials.pin')
        </div>
    @endslot
@endcomponent