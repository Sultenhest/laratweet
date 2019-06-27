<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageExperienceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_gain_experience_on_status_creation()
    {
        $user = $this->signIn();

        $this->assertEquals(0, $user->experience->points);

        $this->post('/status', [
            'body' => $this->faker->sentence
        ]);
        
        $this->assertEquals(100, $user->experience->points);
    }

    public function test_a_user_lose_experience_on_status_deletion()
    {;
        $user = $this->signIn();

        $this->post('/status', [
            'body' => $this->faker->sentence
        ]);

        $this->assertEquals(100, $user->experience->points);

        $this->actingAs($user)
            ->delete('/status/1')
            ->assertRedirect('/');

        $this->assertEquals(0, $user->experience->points);
    }
}
