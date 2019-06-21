<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_profile_has_a_path()
    {
        $profile = factory('App\Profile')->create();

        $this->assertEquals("/profile/{$profile->username}", $profile->path());
    }

    public function test_a_profile_has_a_user()
    {
        $profile = factory('App\Profile')->create();

        $this->assertInstanceOf('App\User', $profile->user);
    }
}
