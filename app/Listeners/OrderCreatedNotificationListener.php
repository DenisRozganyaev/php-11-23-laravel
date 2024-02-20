<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Jobs\OrderCreateNotifyJob;

class OrderCreatedNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        logs()->info('run the job');
        OrderCreateNotifyJob::dispatch($event->order);
    }
}
