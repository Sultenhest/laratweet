@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div>
                    <p>{{ $user->name }}</p>
                    <p>{{ $user->username }}</p>
                    <p>{{ $user->bio }}</p>

                   @can('canFollow', $user)                 
                        <form method="POST" action="{{ $user->path() }}/follow">
                            @csrf
                            @if ($user->isFollowed())
                                <button type="submit" class="btn btn-danger">Unfollow {{ $user->username }}</button>
                            @else
                                <button type="submit" class="btn btn-primary">Follow {{ $user->username }}</button>
                            @endif
                        </form>
                    @endcan
                </div>

                <p><strong>Experience Points:</strong> {{ $user->points }}</p>

                <div>
                    <h4>Achievements</h4>
                    @include('users.partials.achievements')
                </div>
    
                <div>
                    <h4>Total followers: {{ count($followers) }}</h4>
                    <p>
                        @foreach ($user->followers as $follower)
                            <a href="{{ $follower->path() }}">
                                {{ $follower->username }}
                            </a>,
                        @endforeach
                    </p>
                </div>

                <div>
                    <h4>Total following: {{ count($following) }}</h4>
                    @foreach ($user->following as $following)
                        <a href="{{ $following->path() }}">
                            {{ $following->username }}
                        </a>,
                    @endforeach
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body" data-toggle="modal" data-target="#exampleModalLong">
                        Add new status
                    </div>

                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Create new status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/status">
                                        @include('statuses.form', [
                                            'status' => new App\Status,
                                            'buttonText' => 'Create Status'
                                        ])
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($activities as $date => $activity)
                    <h3 class="page-header">{{ $date }}</h3>
                    @foreach($activity as $record)
                        @include("users.activities.{$record->type}", [
                            'user' => $user,
                            'activity' => $record
                        ])
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection