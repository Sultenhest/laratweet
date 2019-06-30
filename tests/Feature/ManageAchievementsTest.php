<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageAchievementsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_be_assigned_any_achievement_badge()
    {
        $user = $this->signIn();

        $achievement = factory('App\Achievement')->create();

        $achievement->awardTo($user);

        $this->assertCount(1, $user->achievements);
        $this->assertTrue($user->achievements[0]->is($achievement));
    }

    public function test_an_achievement_badge_is_unlocked_once_a_users_experience_points_reach_1000()
    {
        $user = $this->signIn();
        
        $user->experience->awardExperience(1000);

        $this->assertCount(1, $user->achievements);
    }

    public function test_an_achievement_badge_is_unlocked_once_a_users_experience_points_reach_10000()
    {
        $user = $this->signIn();
        
        $user->experience->awardExperience(1000);

        $this->assertCount(1, $user->achievements);

        $user = $user->fresh();
        
        $user->experience->awardExperience(99000);

        $this->assertCount(2, $user->achievements);
    }
}
