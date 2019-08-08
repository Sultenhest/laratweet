<ul class="list-group mb-4">
    @foreach ($achievements as $achievement)
        <li class="list-group-item">
            @if ($awarded_achievements->contains($achievement))
                <span class="badge badge-success">Awarded</span>
            @endif
            {{ $achievement->name }}
        </li>
    @endforeach
</ul>