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
                    <div class="card-header">Visit some users</div>

                    <div class="card-body">
                        @foreach($users as $user)
                            <a href="{{ $user->path() }}">
                                {{ $user->username }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
