<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (OrderStatus::cases() as $case) {
            \App\Models\OrderStatus::firstOrCreate(['name' => $case->value]);
        }
    }
}
