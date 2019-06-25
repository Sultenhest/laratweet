<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageFollowTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_guest_cannot_manage_follows()
    {
        $profile = factory('App\Profile')->create();

        $this->post($profile->path() . '/follow')->assertRedirect('login');
    }

    public function test_a_user_can_follow_and_unfollow_another_user()
    {
        $follower = factory('App\Profile')->create();

        $followed = factory('App\Profile')->create();

        $response = $this->actingAs($follower->user)
                        ->post($followed->path() . '/follow');

        $this->assertDatabaseHas('follows', [
            'follower_user_id' => $follower->user->id,
            'followed_user_id' => $followed->user->id
        ]);

        $response->assertRedirect($followed->path());

        $this->actingAs($follower->user)
            ->post($followed->path() . '/follow');

        $this->assertDatabaseMissing('follows', [
            'follower_user_id' => $follower->user->id,
            'followed_user_id' => $followed->user->id
        ]);
    }

    public function test_a_user_cannot_follow_himself()
    {
        $profile = factory('App\Profile')->create();

        $response = $this->actingAs($profile->user)
                        ->post($profile->path() . '/follow')
                        ->assertForbidden();
    }
}
