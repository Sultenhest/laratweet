<?php

namespace Tests\Unit;

use Tests\TestCase;
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
}
