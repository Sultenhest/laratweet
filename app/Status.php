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
        return $this->belongsToMany(User::class, 'likes')->latest('created_at');
    }

    public function isLiked() {
        $like = $this->likes()->whereUserId( Auth::id() )->first();
        return  !is_null($like) ? true : false;
    }
}
