@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div>
                    <p>{{ $profile->name }}</p>
                    <p>{{ $profile->username }}</p>
                    <p>{{ $profile->bio }}</p>

                   @can('canFollow', $profile)                 
                        <form method="POST" action="{{ $profile->path() }}/follow">
                            @csrf
                            @if ($profile->user->isFollowed())
                                <button type="submit" class="btn btn-danger">Unfollow {{ $profile->username }}</button>
                            @else
                                <button type="submit" class="btn btn-primary">Follow {{ $profile->username }}</button>
                            @endif
                        </form>
                    @endcan
                </div>

                <p><strong>Experience Points:</strong> {{ $profile->user->experience->points }}</p>

                <div>
                    <h4>Achievements</h4>
                    @include('partials.achievements')
                </div>
    
                <div>
                    <h4>Total followers: {{ count($followers) }}</h4>
                    <p>
                        @foreach ($profile->user->followers as $follower)
                            <a href="{{ $follower->profile->path() }}">
                                {{ $follower->profile->username }}
                            </a>,
                        @endforeach
                    </p>
                </div>

                <div>
                    <h4>Total followers: {{ count($following) }}</h4>
                    @foreach ($profile->user->following as $following)
                        <a href="{{ $following->profile->path() }}">
                            {{ $following->profile->username }}
                        </a>,
                    @endforeach
                </div>
            </div>

            <div class="col-md-8">
                @foreach($statuses as $status)
                    @include('partials.status_card')
                @endforeach
            </div>
        </div>
    </div>
@endsection