<ul>
    @foreach ($achievements as $achievement)
        <li>
            @if ($awarded_achievements->contains($achievement))
                <strong>Awarded</strong>
            @endif
            {{ $achievement->name }}
        </li>
    @endforeach
</ul>