<?php

namespace App\Jobs\Products;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductExistsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ExistsJob implements ShouldQueue
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
        Notification::send(
            $this->product->followers()->wherePivot('exist', true)->get(),
            app()->make(ProductExistsNotification::class, ['product' => $this->product])
        );
    }
}
