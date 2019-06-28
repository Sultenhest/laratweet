{{ $profile->name }}
{{ $profile->username }}
{{ $profile->bio }}

@foreach ($achievements as $achievement)
    @if ($awarded_achievements->contains($achievement))
        Awarded
    @endif
    {{ $achievement->name }}
@endforeach

@foreach ($profile->user->followers as $follower)
    {{ $follower->username }}
@endforeach

@foreach ($profile->user->following as $following)
    {{ $following->username }}
@endforeach