<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'username', 'bio'
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function path()
    {
        return "/profile/{$this->username}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
