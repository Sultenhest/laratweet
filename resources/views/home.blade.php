@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($statuses as $status)
                    {{ $status }}
                @endforeach
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Visit some profiles</div>

                    <div class="card-body">
                        @foreach($profiles as $profile)
                            <a href="{{ $profile->path() }}">
                                {{ $profile->username }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
