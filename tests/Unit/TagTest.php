<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_tag_has_a_name()
    {
        $tag = factory('App\Tag')->create();

        $this->assertNotNull($tag->name);
    }

    public function test_tag_has_a_path()
    {
        $tag = factory('App\Tag')->create();

        $this->assertEquals("/tag/{$tag->name}", $tag->path());
    }
}
