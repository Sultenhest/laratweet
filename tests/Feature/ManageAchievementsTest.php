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
        
        $user->awardExperience(1000);

        $this->assertCount(1, $user->achievements);
    }

    public function test_an_achievement_badge_is_unlocked_once_a_users_experience_points_reach_10000()
    {
        $user = $this->signIn();
        
        $user->awardExperience(1000);

        $this->assertCount(1, $user->achievements);

        $user = $user->fresh();
        
        $user->awardExperience(99000);

        $this->assertCount(2, $user->achievements);
    }

    public function test_an_achievement_badge_is_unlocked_once_a_user_likes_10_statuses()
    {
        $user = $this->signIn();

        $statuses = factory('App\Status', 10)->create();

        foreach ($statuses as $status) {
            $status->toggleLike();
        }

        $this->assertCount(10, $user->likes);

        $this->assertCount(2, $user->achievements);
    }

    public function test_an_achievement_badge_is_unlocked_once_a_user_gets_10_followers()
    {
        $user = $this->signIn();

        $this->assertCount(0, $user->followers);

        $followers = factory('App\User', 10)->create();

        foreach ($followers as $follower) {
            $user->addFollower($follower);
        }

        $user = $user->fresh();

        $this->assertCount(10, $user->followers);

        $this->assertCount(2, $user->achievements);
    }

    public function an_achievement_badge_is_unlocked_once_a_user_gets_10_likes_on_a_status()
    {
        $status = factory('App\Status')->create();
        
        for ($x = 0; $x <= 9; $x++) {
            $this->signIn();
            $status->like();
        }

        $this->assertCount(10, $status->likes);

        $this->assertCount(0, $status->user->achievements);
    }
}
