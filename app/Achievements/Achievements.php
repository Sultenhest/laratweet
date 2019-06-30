<?php

namespace App\Achievements;

use Illuminate\Database\Eloquent\Collection;

class Achievements extends Collection
{
    public function for($user)
    {
        return $user->achievements;
    }
}