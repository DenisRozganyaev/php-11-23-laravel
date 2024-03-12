<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminCreatedOrderNotification;
use App\Notifications\CustomerOrderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class OrderCreateNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Order $order)
    {
        $this->onQueue('notifications');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logs()->info(__CLASS__ . ": Notify customer");
        $this->order->notify(app()->make(CustomerOrderNotification::class));
        logs()->info(__CLASS__ . ": Notify admins");
        Notification::send(
            User::role('admin')->get(),
            app()->make(AdminCreatedOrderNotification::class, ['order' => $this->order])
        );
    }
}
