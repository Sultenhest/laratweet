<?php

namespace Tests\Unit;

use App\Status;
use App\Activity;

use Carbon\Carbon;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_triggers_activity_when_a_status_is_created()
    {
        $this->signIn();

        $status = factory(Status::class)->create();

        $this->assertDatabaseHas('activities', [
            'user_id' => auth()->id(),
            'subject_id' => $status->id,
            'subject_type' => 'App\Status',
            'type' => 'created_status',
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $status->id);
    }

    public function test_it_fetches_a_feed_for_any_user()
    {
        $this->signIn();

        factory(Status::class, 2)->create(['user_id' => auth()->id()]);

        auth()->user()->activity()->first()->update([
            'created_at' => Carbon::now()->subWeek()
        ]);

        $feed = Activity::feed(auth()->user());

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }
}
