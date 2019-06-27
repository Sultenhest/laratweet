<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExperienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_experience_belongs_to_a_user()
    {
        $user = $this->signIn();

        $this->assertInstanceOf('App\Experience', $user->experience);
    }

    public function test_a_user_has_zero_experience_points_on_registration()
    {
        $user = $this->signIn();

        $this->assertEquals(0, $user->experience->points);
    }
}
