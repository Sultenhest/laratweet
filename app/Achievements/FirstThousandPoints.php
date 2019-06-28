<?php

namespace App\Achievements;

class FirstThousandPoints extends AchievementType
{
    public $description = 'Great job! You are on your way.';

    public function qualifier($user)
    {
        return $user->experience->points >= 1000;
    }
}
