<?php

namespace App\Observers;

use App\Status;

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
        $status->recordActivity('created');
    }

    /**
     * Handle the status "updated" event.
     *
     * @param  \App\Status  $status
     * @return void
     */
    public function updated(Status $status)
    {
        $status->recordActivity('updated');
    }
}
