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
}
