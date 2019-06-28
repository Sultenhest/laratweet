<?php

namespace App\Listeners;

use App\Events\UserEarnedExperience;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AwardAchievements
{
    public function handle(UserEarnedExperience $event)
    {
        /*
        $achievementIdsToAwardTheUser = app('achievements')->filter(function ($achievement) use ($event) {
            return $achievement->qualifier($event->user);
        })->map(function ($achievement) {
            return $achievement->modelKey();
        });

        $event->user->achievements()->sync($achievementIdsToAwardTheUser);
        */
        $event->user->achievements()->sync(
            app('achievements')->filter->qualifier($event->user)->map->modelKey()
        );
    }
}
