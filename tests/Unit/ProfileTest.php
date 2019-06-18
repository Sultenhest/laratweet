<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_profile()
    {
        $profile = factory('App\Profile')->create();

        $this->assertInstanceOf('App\User', $profile->user);
    }
}
