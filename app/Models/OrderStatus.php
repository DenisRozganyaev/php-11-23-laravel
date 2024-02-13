<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];

    protected $casts = [
        'name' => \App\Enums\OrderStatus::class
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function name(): Attribute
    {
        return Attribute::get(fn() => $this->name->value);
    }
}
