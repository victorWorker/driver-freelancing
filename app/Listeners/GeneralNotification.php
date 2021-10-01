<?php

namespace App\Listeners;

use App\Events\GeneralEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GeneralNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  GeneralEvent  $event
     * @return void
     */
    public function handle(GeneralEvent $event)
    {
        //
    }
}
