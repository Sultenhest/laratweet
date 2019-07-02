@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($statuses as $status)
                    @include('partials.status_card')
                @endforeach
            </div>
        </div>
    </div>
@endsection