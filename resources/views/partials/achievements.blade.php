@foreach ($achievements as $achievement)
    @if ($awarded_achievements->contains($achievement))
        Awarded
    @endif
    {{ $achievement->name }}
@endforeach