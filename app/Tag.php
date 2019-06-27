<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function path()
    {
        return "/tag/{$this->name}";
    }

    public function statuses()
    {
        return $this->belongsToMany(Status::class)->latest('updated_at');
    }
}
