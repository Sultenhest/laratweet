<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserEarnedExperience
{
    use Dispatchable, SerializesModels;

    public $user;
    public $points;
    public $totalPoints;

    public function __construct($user, $points, $totalPoints)
    {
        $this->user = $user;
        $this->points = $points;
        $this->totalPoints = $totalPoints;
    }
}
