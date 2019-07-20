<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }

    public static function feed($user_ids = [], $take = 50)
    {
        return static::whereIn('user_id', $user_ids)
            ->latest()
            ->with('subject')
            ->take($take)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('Y-m-d');
            });
    }
}
