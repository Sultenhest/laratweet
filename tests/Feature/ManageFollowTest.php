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
        $user = factory('App\User')->create();

        $this->post($user->path() . '/follow')->assertRedirect('login');
    }

    public function test_a_user_can_follow_and_unfollow_another_user()
    {
        $jack = $this->signIn();
        $jane = factory('App\User')->create([
            'name' => 'jane',
            'username' => $this->faker->userName
        ]);

        $response = $this->actingAs($jack)
            ->post($jane->path() . '/follow');

        $this->assertDatabaseHas('follows', [
            'follower_user_id' => $jack->id,
            'followed_user_id' => $jane->id
        ]);

        $response->assertRedirect($jane->path());

        $this->actingAs($jane)
            ->post($jack->path() . '/follow');

        $this->actingAs($jack)
            ->post($jane->path() . '/follow');

        $this->assertDatabaseMissing('follows', [
            'follower_user_id' => $jack->id,
            'followed_user_id' => $jane->id
        ]);

        $this->assertDatabaseHas('follows', [
            'follower_user_id' => $jane->id,
            'followed_user_id' => $jack->id
        ]);
    }

    public function test_a_user_cannot_follow_himself()
    {
        $user = factory('App\User')->create();

        $response = $this->actingAs($user)
                        ->post($user->path() . '/follow')
                        ->assertForbidden();
    }
}
