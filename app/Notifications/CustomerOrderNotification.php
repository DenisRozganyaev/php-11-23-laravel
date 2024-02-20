<?php

namespace App\Notifications;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\Contract\InvoicesServiceContract;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class CustomerOrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected InvoicesServiceContract $invoicesService)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(Order $order): MailMessage
    {
        logs()->info(self::class);

        $invoice = $this->invoicesService->generate($order);

        return (new MailMessage)
            ->greeting("Hello, $order->name $order->surname")
            ->line("Your order was created")
            ->lineIf(
                $order->status->name->value === OrderStatus::Paid->value,
                "And successfully paid!"
            )
            ->line('You can see your order details inside attached file')
            ->attach(
                Storage::disk('public')->path($invoice->filename),
                [
                    'as' => $invoice->filename,
                    'mime' => 'application/pdf'
                ]
            );
    }
}
