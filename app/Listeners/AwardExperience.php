<?php

namespace App\Listeners;

use App\Events\StatusCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AwardExperience
{
    public function handle(StatusCreated $event)
    {
        $event->user->experience->awardExperience(100);
    }
}
