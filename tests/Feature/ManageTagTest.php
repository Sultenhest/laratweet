<?php

namespace Tests\Feature;

use App\Status;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTagTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guest_cannot_manage_tags()
    {
        $tag = factory('App\Tag')->create();

        $this->get('/tag')->assertRedirect('login');
        $this->get($tag->path())->assertRedirect('login');
    }

    public function test_a_status_can_have_tags()
    {
        $this->signIn();

        $status = factory('App\Status')->create();
        $tag = factory('App\Tag')->create();

        $status->tags()->sync($tag->id);

        //$this->get($status->path())->assertSee($tag->name);

        $this->assertDatabaseHas('status_tag', [
            'status_id' => $status->id,
            'tag_id' => $tag->id
        ]);

        $this->assertDatabaseHas('tags', [
            'name' => $tag->name,
        ]);
    }

    public function test_a_user_can_see_all_tags()
    {
        $tags = factory('App\Tag', 3)->create();

        $this->signIn();
        $this->get('/tag')
            ->assertOk()
            ->assertSee($tags[0]->name)
            ->assertSee($tags[1]->name)
            ->assertSee($tags[2]->name);
    }

    public function test_a_user_can_see_all_statues_with_a_given_tag()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $tag = factory('App\Tag')->create();

        $statusOne = factory('App\Status')->create();
        $statusTwo = factory('App\Status')->create();

        $statusOne->tags()->sync($tag->id);
        $statusTwo->tags()->sync($tag->id);

        $this->get($tag->path())
            ->assertSee($tag->name)
            ->assertSee($statusOne->body)
            ->assertSee($statusTwo->body);
    }
}
