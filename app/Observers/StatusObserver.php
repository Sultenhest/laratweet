<?php

namespace App\Observers;

use App\Status;
use App\Activity;

class StatusObserver
{
    /**
     * Handle the status "created" event.
     *
     * @param  \App\Status  $status
     * @return void
     */
    public function created(Status $status)
    {
        $this->recordActivity($status, 'created');
    }

    /**
     * Handle the status "updated" event.
     *
     * @param  \App\Status  $status
     * @return void
     */
    public function updated(Status $status)
    {
        $this->recordActivity($status, 'updated');
    }

    protected function recordActivity($status, $type)
    {
        Activity::create([
            'status_id' => $status->id,
            'description' => $type
        ]);
    }
}
