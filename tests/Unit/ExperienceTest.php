<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Events\UserEarnedExperience;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExperienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_announcement_is_made_when_experience_is_earned()
    {
        Event::fake();

        $this->signIn()->awardExperience(100);

        Event::assertDispatched(UserEarnedExperience::class, function ($event) {
            return auth()->user()->is($event->user) && $event->points == 100 && $event->totalPoints == 100;
        });
    }

    public function test_a_user_has_zero_experience_points_on_registration()
    {
        $user = $this->signIn();

        $this->assertEquals(0, $user->points);
    }
}
