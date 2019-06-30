<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Achievement;
use App\Achievements\Achievements;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AchievementTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_it_has_a_name()
    {
        $achievement = factory('App\Achievement')->create([
            'name' => 'Some name'
        ]);

        $this->assertEquals('Some name', $achievement->name);
    }

    public function test_it_has_a_description()
    {
        $achievement = factory('App\Achievement')->create([
            'description' => 'Some description'
        ]);

        $this->assertEquals('Some description', $achievement->description);
    }

    public function test_it_has_an_icon()
    {
        $achievement = factory('App\Achievement')->create([
            'icon' => 'some-icon.svg'
        ]);

        $this->assertEquals('some-icon.svg', $achievement->icon);
    }

    public function test_it_returns_a_custom_achievements_collection()
    {
        $this->assertInstanceOf(Achievements::class, Achievement::all());
    }

    public function test_it_can_filter_achievements_down_to_only_those_that_a_given_user_has_been_awarded()
    {
        $user = $this->signIn();
        $achievements = factory('App\Achievement', 2)->create();

        $achievements[0]->awardTo($user);

        $this->assertCount(1, Achievement::all()->for($user));
    }
}
