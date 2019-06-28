<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements');
    }

    public function awardTo(User $user)
    {
        $this->users()->attach($user);
    }
}
