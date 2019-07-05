<?php

namespace Tests\Unit;

use App\Status;
use App\Activity;

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
}
