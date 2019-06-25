<?php

namespace Tests\Feature;

use App\Status;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageStatusTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_statuses()
    {
        $status = factory('App\Status')->create();

        $this->post('/status', $status->toArray())->assertRedirect('login');
        $this->post($status->path() . '/reply', $status->toArray())->assertRedirect('login');
        $this->get('/status')->assertRedirect('login');
        $this->get('/status/create')->assertRedirect('login');
        $this->get($status->path())->assertRedirect('login');
        $this->get($status->path().'/edit')->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_status()
    {
        $this->signIn();
        $this->get('/status/create')->assertOk();

        $attributes = ['body' => $this->faker->sentence];

        $response = $this->post('/status', $attributes);

        $status = Status::where($attributes)->first();

        $response->assertRedirect($status->path());

        $this->get($status->path())->assertSee($attributes['body']);
    }

    /** @test */
    public function a_user_can_update_a_status()
    {
        $status = factory('App\Status')->create();

        $this->actingAs($status->user)
            ->patch($status->path(), $attributes = [
                'body' => 'Changed'
            ])
            ->assertRedirect($status->path());

        $this->get($status->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('statuses', $attributes);
    }

    /** @test */
    public function a_user_can_delete_one_of_their_statuses()
    {
        $user = $this->signIn();

        $attributes = ['body' => $this->faker->sentence];

        $status = $user->statuses()->create($attributes);

        $this->actingAs($user)
            ->delete($status->path())
            ->assertRedirect('/');

        $this->assertDatabaseMissing('statuses', $attributes);
    }

    /** @test */
    public function an_authenticated_user_can_see_a_status_of_others()
    {
        $this->signIn();

        $status = factory('App\Status')->create();

        $this->get($status->path())->assertOk();
    }

    /** @test */
    public function an_authenticated_user_cannot_update_statuses_of_others()
    {
        $this->signIn();

        $status = factory('App\Status')->create();

        $this->patch($status->path())->assertForbidden();
    }

    /** @test */
    public function an_authenticated_user_cannot_delete_statuses_of_others()
    {
        $this->signIn();

        $status = factory('App\Status')->create();

        $this->delete($status->path())->assertForbidden();
    }

    /** @test */
    public function a_status_requires_a_body()
    {
        $this->signIn();

        $attributes = factory('App\Status')->raw(['body' => '']);

        $this->post('/status', $attributes)->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_status_can_get_replies()
    {
        $this->withoutExceptionHandling();

        $status = factory('App\Status')->create();

        $user = $this->signIn();

        $attributes = ['body' => $this->faker->sentence];

        $response = $this->actingAs($user)
            ->post($status->path() . '/reply', $attributes);

        $this->assertDatabaseHas('statuses', $attributes);

        $this->get($status->path())->assertSee($attributes['body']);
    }
}
