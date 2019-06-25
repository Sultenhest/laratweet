<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageLikeTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_an_authenticated_user_can_like_and_unlike_a_status()
    {
        $user = $this->signIn();

        $status = factory('App\Status')->create();

        $response = $this->post($status->path() . '/like');

        $response->assertRedirect($status->path());

        $this->assertEquals(1, $status->likes());

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'status_id' => $status->id
        ]);

        $response = $this->post($status->path() . '/like');

        $response->assertRedirect($status->path());

        $this->assertEquals(0, $status->likes());

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'status_id' => $status->id
        ]);
    }

    public function test_a_guest_cannot_like_a_status()
    {
        $status = factory('App\Status')->create();

        $this->assertEquals(0, $status->likes());

        $this->post($status->path() . '/like')->assertRedirect('/login');

        $this->assertEquals(0, $status->likes());
    }
}
