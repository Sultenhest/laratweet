<?php

namespace App\Listeners;

use App\Events\UserEarnedExperience;

class AwardAchievements
{
    public function handle(UserEarnedExperience $event)
    {
        $this->scanForAwards($event->user);
    }

    public function scanForAwards($user)
    {
        $user->achievements()->sync(
            app('achievements')->filter->qualifier($user)->map->modelKey()
        );
    }
}
