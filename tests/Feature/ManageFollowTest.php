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
        $jack = $this->signIn();
        $jane = factory('App\User')->create([
            'name' => 'jane'
        ]);

        $jane->profile()->create([
            'name' => $this->faker->name,
            'username' => $this->faker->userName
        ]);

        $response = $this->actingAs($jack)
            ->post($jane->profile->path() . '/follow');

        $this->assertDatabaseHas('follows', [
            'follower_user_id' => $jack->id,
            'followed_user_id' => $jane->id
        ]);

        $response->assertRedirect($jane->profile->path());

        $this->actingAs($jane)
            ->post($jack->profile->path() . '/follow');

        $this->actingAs($jack)
            ->post($jane->profile->path() . '/follow');

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
        $profile = factory('App\Profile')->create();

        $response = $this->actingAs($profile->user)
                        ->post($profile->path() . '/follow')
                        ->assertForbidden();
    }
}
