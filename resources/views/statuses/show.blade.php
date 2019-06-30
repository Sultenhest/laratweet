@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{ $status->body }}

                    @foreach ($status->tags as $tag)
                        {{ $tag->name }}
                    @endforeach

                    @foreach ($status->replies as $reply)
                        {{ $reply->body }}
                    @endforeach

                    @if ($status->parent)
                        {{ $status->parent }}
                    @endif

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
                </div>
            </div>
        </div>
    </div>
@endsection