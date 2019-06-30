<?php

namespace App\Achievements;

class LaratweetMastery extends AchievementType
{
    public function description()
    {
        return 'You are now a master... of something... nice... i guess';
    }

    public function qualifier($user)
    {
        return $user->experience->points >= 100000;
    }
}
