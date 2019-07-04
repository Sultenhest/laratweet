<?php

namespace App\Achievements;

class FirstThousandPoints extends AchievementType
{
    public function description()
    {
        return 'Great job! You are on your way.';
    }

    public function qualifier($user)
    {
        return $user->points >= 1000;
    }
}
