<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagePinnedTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_manage_pins()
    {
        $status = factory('App\Status')->create();

        $this->patch($status->path() . '/pin')->assertRedirect('login');
    }

    public function test_a_user_can_pin_their_statuses()
    {
        $status = factory('App\Status')->create();

        $this->assertFalse($status->pinned);

        $this->actingAs($status->user)
            ->get($status->path())
            ->assertSee('Pin');

        $this->actingAs($status->user)
            ->patch($status->path() . '/pin')
            ->assertRedirect($status->path());

        $this->assertTrue($status->fresh()->pinned);

        $this->actingAs($status->user)
            ->get($status->path())
            ->assertSee('Unpin');
    }

    public function test_a_user_cannot_pin_another_users_status()
    {
        $this->signIn();
        
        $status = factory('App\Status')->create();

        $this->assertFalse($status->pinned);

        $this->patch($status->path() . '/pin')->assertForbidden();

        $this->assertFalse($status->pinned);
    }
}
