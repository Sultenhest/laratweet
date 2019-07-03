<?php

namespace Tests\Feature;

use App\Status;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityFeedTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_creating_a_status_generates_activity()
    {
        $status = factory(Status::class)->create();

        $this->assertCount(1, $status->activity);

        $this->assertEquals('created', $status->activity[0]->description);
    }

    public function test_updating_a_status_generates_activity()
    {
        $status = factory(Status::class)->create();

        $status->update(['body' => 'changed']);

        $this->assertCount(2, $status->activity);
        $this->assertEquals('updated', $status->activity->last()->description);
    }
}
