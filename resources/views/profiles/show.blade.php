{{ $profile->name }}
{{ $profile->username }}
{{ $profile->bio }}

@foreach ($profile->user->followers as $follower)
    {{ $follower->username }}
@endforeach

@foreach ($profile->user->following as $following)
    {{ $following->username }}
@endforeach