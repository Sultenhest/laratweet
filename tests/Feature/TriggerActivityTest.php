<?php

namespace Tests\Feature;

use App\Status;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TriggerActivityTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_creating_a_status()
    {
        $this->signIn();

        $status = factory(Status::class)->create();

        $this->assertCount(1, $status->activity);

        $this->assertEquals('created_status', $status->activity[0]->type);
    }

    public function test_liking_a_status()
    {
        $this->signIn();

        $status = factory(Status::class)->create();

        $like = $status->like();

        $this->assertCount(1, $like->activity);
        $this->assertEquals('created_like', $like->activity->last()->type);
    }

    public function pinning_a_status()
    {
        $this->signIn();

        $status = factory(Status::class)->create();

        $this->actingAs($status->user)
            ->patch($status->path() . '/pin');

        $this->assertCount(3, $status->activity);
        $this->assertEquals('pinned', $status->activity->last()->type);
    }
/*
    public function gaining_achievement()
    {
        $user = $this->signIn();

        $user->awardExperience(1000);

        $this->assertCount(1, $user->achievements);

        $this->assertCount(2, $user->activity);
        $this->assertEquals('gained_achievement', $user->activity->last()->description);
    }*/
}
