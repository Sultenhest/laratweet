<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $secondUser)
    {
        return $user->is($secondUser);
    }

    public function canFollow(User $user, User $secondUser)
    {
        return $user->isNot($secondUser);
    }
}
