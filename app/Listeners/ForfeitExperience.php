<?php

namespace App\Listeners;

use App\Events\StatusDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForfeitExperience
{
    public function handle(StatusDeleted $event)
    {
        $event->user->experience->stripExperience(100);
    }
}
