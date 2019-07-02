@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.status_card')

                @foreach ($status->replies as $reply)
                    {{ $reply->body }}
                @endforeach

                @if ($status->parent)
                    {{ $status->parent }}
                @endif
            </div>
        </div>
    </div>
@endsection