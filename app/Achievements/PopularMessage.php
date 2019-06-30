<?php

namespace App\Achievements;

class PopularMessage extends AchievementType
{
    public function description()
    {
        return 'You got 10 likes on a status.';
    }

    public function qualifier($user)
    {
        return false;
    }
}
