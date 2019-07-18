@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header"><h3>{{ $tag->name }}</h3></div>
                </div>

                @foreach($statuses as $status)
                    @include('statuses.partials.status_card')
                @endforeach

                {{ $statuses->links() }}
            </div>
        </div>
    </div>
@endsection