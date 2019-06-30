<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_a_profile()
    {
        $profile = factory('App\Profile')->create();
        $user = $profile->user;

        $this->assertInstanceOf('App\Profile', $user->profile);
    }

    public function test_a_user_has_statuses()
    {
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->statuses);
    }

    public function test_a_user_can_follow_and_get_followed()
    {
        $jack = $this->signIn();
        $jane = factory('App\User')->create([
            'name' => 'jane'
        ]);

        $jane->addFollower($jack);

        $this->assertCount(1, $jack->following);
        $this->assertCount(1, $jane->followers);
    }
}
