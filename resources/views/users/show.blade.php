@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div>
                    <img src="{{url('/images/default.jpg')}}" class="img-fluid img-thumbnail"/>
                    <div class="lead">
                        <h1>
                            {{ $user->name }} - 
                            <small class="text-muted">{{ $user->username }}</small>
                        </h1>
                    </div>

                    <p><strong>Biography: </strong>{{ $user->bio }}</p>

                    @can('canFollow', $user)                 
                        <form method="POST" action="{{ $user->path() }}/follow" class="mb-4">
                            @csrf
                            @if ($user->isFollowed())
                                <button type="submit" class="btn btn-outline-primary btn-block">Unfollow {{ $user->username }}</button>
                            @else
                                <button type="submit" class="btn btn-primary btn-block">Follow {{ $user->username }}</button>
                            @endif
                        </form>
                    @endcan

                    @can('update', $user)
                        <a href="{{ $user->path() }}/edit" class="mb-4 btn btn-primary btn-block">
                            Update Profile
                        </a>
                    @endcan
                </div>

                @component('partials.card')
                    @slot('heading')
                        Achievements
                    @endslot

                    @slot('body')
                        @include('users.partials.achievements')
                    @endslot

                    @slot('bottom')
                        <p class="mb-0"><strong>Experience Points:</strong> {{ $user->points }}</p>
                    @endslot
                @endcomponent

                @component('partials.card')
                    @slot('heading')
                        Total followers: {{ count($followers) }}
                    @endslot

                    @slot('body')
                        @foreach ($user->followers as $follower)
                            {{ $loop->first ? '' : ', ' }}
                            <a href="{{ $follower->path() }}">
                                {{ $follower->username }}
                            </a>
                        @endforeach
                    @endslot

                    @slot('bottom')
                    @endslot
                @endcomponent

                @component('partials.card')
                    @slot('heading')
                        Total following: {{ count($following) }}
                    @endslot

                    @slot('body')
                        @foreach ($user->following as $following)
                            {{ $loop->first ? '' : ', ' }}
                            <a href="{{ $following->path() }}">
                                {{ $following->username }}
                            </a>
                        @endforeach
                    @endslot

                    @slot('bottom')
                    @endslot
                @endcomponent
            </div>

            <div class="col-md-8">
                @can('update', $user)
                    <div class="card mb-3">
                        <div class="card-body" data-toggle="modal" data-target="#statusModal">
                            Add new status
                        </div>

                        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="statusModalTitle">Create new status</h5>
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
                @endcan

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