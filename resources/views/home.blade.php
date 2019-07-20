@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($activities as $date => $activity)
                    <h3 class="page-header">{{ $date }}</h3>
                    @foreach($activity as $record)
                        @include("users.activities.{$record->type}", [
                            'user' => $record->subject->user,
                            'activity' => $record
                        ])
                    @endforeach
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
