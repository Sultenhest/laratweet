<?php

namespace Tests\Unit;

use App\Achievements\AchievementType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AchievementTypeTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_it_set_a_default_name()
    {
        $type = new FakeAchievementType();

        $this->assertEquals('Fake Achievement Type', $type->name());
    }
}

class FakeAchievementType extends AchievementType
{
    public $description = 'fake description';

    public $icon = 'fake-icon.svg';

    public function qualifier($user)
    {
        return true;
    }
}