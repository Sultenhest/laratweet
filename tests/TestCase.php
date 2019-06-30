<?php

namespace Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    protected function signIn($user = null)
    {
        $user = $user ?: factory('App\User')->create();
        
        $user->profile()->create([
            'name' => $user->name,
            'username' => 'sultenhest'
        ]);

        $user->experience()->create([]);

        $this->actingAs($user);

        return $user;
    }
}
