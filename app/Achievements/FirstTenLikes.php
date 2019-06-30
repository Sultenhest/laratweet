<?php

namespace App\Achievements;

class FirstTenLikes extends AchievementType
{
    public function description()
    {
        return 'You like things.';
    }

    public function qualifier($user)
    {
        return $user->likes()->count() >= 10;
    }
}
