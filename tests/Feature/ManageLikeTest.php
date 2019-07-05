<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageLikeTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_guest_cannot_like_a_status()
    {
        $status = factory('App\Status')->create();

        $this->assertEquals(0, $status->likes()->count());

        $this->post($status->path() . '/like')->assertRedirect('/login');

        $this->assertEquals(0, $status->likes()->count());
    }

    public function test_authenticated_user_can_like_a_status()
    {
        $status = factory('App\Status')->create();

        $user = $this->signIn();

        $this->assertEquals(0, $status->likesCount());

        $this->post($status->path() . '/like');

        $this->assertEquals(1, $status->fresh()->likesCount());

        $this->assertEquals(1, $user->fresh()->likes()->count());
    }

    public function test_an_authenticated_user_can_like_and_unlike_a_status()
    {
        $user = $this->signIn();

        $status = factory('App\Status')->create();
        
        $this->assertFalse($status->isLiked());

        $status->like();
        
        $this->assertEquals(1, $status->likes()->count());

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'liked_id' => $status->id,
            'liked_type' => get_class($status)
        ]);

        $this->assertTrue($status->isLiked());

        $status->unlike();

        $this->assertEquals(0, $status->likes()->count());

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'liked_id' => $status->id,
            'liked_type' => get_class($status)
        ]);

        $this->assertFalse($status->isLiked());
    }
}
