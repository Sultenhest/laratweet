<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    public function liked()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
