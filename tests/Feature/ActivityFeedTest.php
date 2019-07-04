<?php

namespace Tests\Feature;

use App\Status;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityFeedTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_creating_a_status_records_activity()
    {
        $status = factory(Status::class)->create();

        $this->assertCount(1, $status->activity);

        $this->assertEquals('created', $status->activity[0]->description);
    }

    public function test_updating_a_status_records_activity()
    {
        $status = factory(Status::class)->create();

        $status->update(['body' => 'changed']);

        $this->assertCount(2, $status->activity);
        $this->assertEquals('updated', $status->activity->last()->description);
    }

    public function test_liking_a_status_records_activity()
    {
        $this->signIn();

        $status = factory(Status::class)->create();

        $status->toggleLike();

        $this->assertCount(2, $status->activity);
        $this->assertEquals('added_like', $status->activity->last()->description);
    }

    public function test_pining_a_status_records_activity()
    {
        $status = factory(Status::class)->create();

        $this->actingAs($status->user)
            ->patch($status->path() . '/pin');

        $this->assertCount(3, $status->activity);
        $this->assertEquals('pinned', $status->activity->last()->description);
    }
/*
    public function test_gaining_achievement_records_activity()
    {
        $user = $this->signIn();

        $user->awardExperience(1000);

        $this->assertCount(1, $user->achievements);

        $this->assertCount(2, $user->activity);
        $this->assertEquals('gained_achievement', $user->activity->last()->description);
    }*/
}
