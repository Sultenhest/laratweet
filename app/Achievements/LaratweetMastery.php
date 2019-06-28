<?php

namespace App\Achievements;

class LaratweetMastery extends AchievementType
{
    public $description = 'You are finished with your learning, padawan';
    
    public $icon = 'master.svg';

    public function qualifier($user)
    {
        return $user->experience->points >= 10000;
    }
}
