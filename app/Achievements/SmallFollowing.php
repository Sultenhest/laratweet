<?php

namespace App\Achievements;

class SmallFollowing extends AchievementType
{
    public function description()
    {
        return 'Somebody is following you..';
    }

    public function qualifier($user)
    {
        return $user->followers()->count() >= 10;
    }
}
