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

    public function test_it_can_sort_achievements_according_to_a_skill_level ()
    {
        factory('App\Achievement')->create(['level' => 'advanced']);
        factory('App\Achievement')->create(['level' => 'beginner']);
        factory('App\Achievement')->create(['level' => 'intermediate']);

        $achievements = Achievement::all();

        $this->assertEquals(['beginner', 'intermediate', 'advanced'], Achievement::all()->sortByLevel()->pluck('level')->all());
        $this->assertEquals(['advanced', 'intermediate', 'beginner'], Achievement::all()->sortByLevelDesc()->pluck('level')->all());
    }

    public function test_it_can_return_percentage_of_completed_achievements()
    {
        $user = $this->signIn();
        $achievements = factory('App\Achievement', 10)->create();

        $this->assertEquals(0.0, Achievement::all()->for($user)->asPercentageOfTotalAvailable());

        $user = $user->fresh();

        $achievements[0]->awardTo($user);
        $achievements[1]->awardTo($user);
        $achievements[2]->awardTo($user);
        $achievements[3]->awardTo($user);

        $this->assertEquals(40.0, Achievement::all()->for($user)->asPercentageOfTotalAvailable());
    }
}
