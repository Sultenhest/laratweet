<?php

namespace Tests\Unit;

use App\Experience;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_a_path()
    {
        $user = factory('App\User')->create();

        $this->assertEquals("/user/{$user->username}", $user->path());
    }

    public function test_a_user_has_experience()
    {
        $user = $this->signIn();

        $this->assertInstanceOf(Experience::class, $user->experience);
    }

    public function test_a_profile_has_a_username()
    {
        $user = factory('App\User')->create();

        $this->assertNotNull($user->username);
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
