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
                    @include('partials.achievements')
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
                @foreach($activities as $date => $activity)
                    <h3 class="page-header">{{ $date }}</h3>
                    @foreach($activity as $record)
                        @include("users.activities.{$record->type}", ['activity' => $record])
                    @endforeach
                @endforeach
                {{--
                @foreach($statuses as $status)
                    @include('partials.status_card')
                @endforeach
                --}}
            </div>
        </div>
    </div>
@endsection