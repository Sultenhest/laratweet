<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'text'
    ];

    public function path()
    {
        return "/profile/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
