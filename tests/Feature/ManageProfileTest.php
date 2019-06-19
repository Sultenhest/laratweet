<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProfileTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_manage_profiles()
    {
        $profile = factory('App\Profile')->create();

        $this->get($profile->path())->assertRedirect('login');
        $this->get($profile->path().'/edit')->assertRedirect('login');
    }

    public function test_a_user_can_update_their_profile()
    {
        $profile = factory('App\Profile')->create();

        $this->actingAs($profile->user)
            ->patch($profile->path(), $attributes = [
                'name' => $this->faker->username,
                'body' => $this->faker->paragraph
            ])
            ->assertRedirect($profile->path());

        $this->get($profile->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('profiles', $attributes);
    }

    public function test_an_authenitcated_user_can_see_a_profile_of_others()
    {
        $this->signIn();

        $profile = factory('App\Profile')->create();

        $this->get($profile->path())->assertOk();
    }

    public function test_an_authenitcated_user_cannot_update_other_profiles()
    {
        $this->signIn();

        $profile = factory('App\Profile')->create();

        $this->patch($profile->path())->assertForbidden();
    }
}
