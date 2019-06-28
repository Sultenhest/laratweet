<?php

namespace App;

use App\Events\UserEarnedExperience;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experience';

    protected $fillable = ['points'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function awardExperience($points)
    {
        $this->increment('points', $points);

        UserEarnedExperience::dispatch($this->user, $points, $this->points);

        return $this;
    }

    public function stripExperience($points)
    {
        $this->decrement('points', $points);

        return $this;
    }
}
