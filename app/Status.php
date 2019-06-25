<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'body'
    ];

    public function path()
    {
        return "/status/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function isLiked()
    {
        $like = $this->likes()->whereUserId( auth()->user()->id )->get();
        return !is_null($like) ? true : false;
    }

    public function parent()
    {
        return $this->belongsTo(Status::class);
    }

    public function replies()
    {
        return $this->hasMany(Status::class);
    }
}
