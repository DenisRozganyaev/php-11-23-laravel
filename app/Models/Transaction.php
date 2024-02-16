<?php

namespace App\Models;

use App\Enums\PaymentSystem;
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'payment_system', 'status'];

    protected $casts = [
        'status' => TransactionStatus::class,
        'payment_system' => PaymentSystem::class
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
