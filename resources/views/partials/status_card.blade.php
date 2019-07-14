<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">
            <strong>
                {{ $status->user->name }}
            </strong>

            <a href="{{ $status->user->path() }}">
                {{ $status->user->username }}
            </a>
            -
            <small>
                {{ $status->created_at->toFormattedDateString() }}

                @if( $status->updated_at->gt($status->created_at) )
                    | Modified on {{ $status->updated_at->toFormattedDateString() }}
                @endif
            </small>
        </h5>

        <p>{{ $status->body }}</p>

        <p class="d-inline">
            Tags:
            <ul class="d-inline list-inline">
                @foreach ($status->tags as $tag)
                    <li class="list-inline-item">
                        <a href="{{ $tag->path() }}">
                            {{ $tag->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </p>

        <div class="d-flex justify-content-between">
            <div>
                @if (url()->current() != 'http://laratweet.test' . $status->path())
                    <a href="{{ $status->path() }}" class="btn btn-info">Go to status</a>
                @endif
                
                @include('partials.like_status')

                <form method="POST" action="{{ $status->path() }}/reply" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">Reply</button>
                </form>
            </div>


            <div>
                @include('partials.pin')
            </div>
        </div>
    </div>
</div>