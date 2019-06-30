<?php

namespace App;

use App\Achievements\Achievements;
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

    public function newCollection(array $models = [])
    {
        return new Achievements($models);
    }
}
