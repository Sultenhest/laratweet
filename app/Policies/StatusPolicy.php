<?php

namespace App\Policies;

use App\User;
use App\Status;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Status $status)
    {
        return $user->is($status->user);
    }

    public function delete(User $user, Status $status)
    {
        return $user->is($status->user);
    }
}
