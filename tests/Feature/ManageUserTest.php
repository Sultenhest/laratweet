<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageUserTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_manage_users()
    {
        $user = factory('App\User')->create();

        $this->get($user->path())->assertRedirect('login');
        $this->get($user->path().'/edit')->assertRedirect('login');
    }

    public function test_a_user_can_update_their_info()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)
            ->patch($user->path(), $attributes = [
                'bio' => $this->faker->paragraph
            ])
            ->assertRedirect($user->path());

        $this->get($user->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('users', $attributes);
    }

    public function test_an_authenticated_user_can_see_the_info_of_other_users()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $user = factory('App\User')->create();

        //$this->get($user->path())->assertOk();
    }

    public function test_an_authenticated_user_cannot_update_other_users_info()
    {
        $this->signIn();

        $user = factory('App\User')->create();

        $this->patch($user->path())->assertForbidden();
    }
}
