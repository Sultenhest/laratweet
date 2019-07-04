<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $status = factory('App\Status')->create();

        $this->assertEquals('/status/' . $status->id, $status->path());
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $status = factory('App\Status')->create();

        $this->assertInstanceOf('App\User', $status->user);
    }

    /** @test */
    public function it_can_be_pinned()
    {
        $status = factory('App\Status')->create();

        $this->assertFalse($status->pinned);

        $status->togglePin();

        $this->assertTrue($status->fresh()->pinned);
    }

    /** @test */
    public function it_can_be_unpinned()
    {
        $status = factory('App\Status')->create(['pinned' => true]);

        $status->togglePin();

        $this->assertFalse($status->fresh()->pinned);
    }
}
