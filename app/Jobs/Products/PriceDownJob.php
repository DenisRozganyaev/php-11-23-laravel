<?php

namespace App\Jobs\Products;

use App\Models\Product;
use App\Notifications\PriceDownNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class PriceDownJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Product $product)
    {
        $this->onQueue('notifications');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->product->followers()->wherePivot('exist', true)->chunk(3, function(Collection $users) {
            logs()->info('Price send');
            sleep(5);
            Notification::send(
                $users,
                app()->make(PriceDownNotification::class, ['product' => $this->product])
            );
        });
    }
}
