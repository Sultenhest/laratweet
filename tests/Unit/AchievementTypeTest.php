<?php

namespace Tests\Unit;

use App\Achievement;
use App\Achievements\AchievementType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AchievementTypeTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_it_persists_the_achievement_attributes_in_the_database()
    {
        $type = new FakeAchievementType();

        $achievement = Achievement::first();

        $this->assertEquals('Fake Achievement Type', $achievement->name);
        $this->assertEquals('Some description', $achievement->description);
        $this->assertEquals('fake-achievement-type.svg', $achievement->icon);
        $this->assertEquals('intermediate', $achievement->level);
    }

    public function test_it_sets_a_default_name()
    {
        $type = new FakeAchievementType();

        $this->assertEquals('Fake Achievement Type', $type->name());
    }

    public function test_it_sets_a_default_icon_name()
    {
        $type = new FakeAchievementType();

        $this->assertEquals('fake-achievement-type.svg', $type->icon());
    }

    public function test_it_sets_a_default_skill_level()
    {
        $type = new FakeAchievementType();

        $this->assertEquals('intermediate', $type->level());
    }
}

class FakeAchievementType extends AchievementType
{
    public function description()
    {
        return 'Some description';
    }

    public function qualifier($user)
    {
        return true;
    }
}