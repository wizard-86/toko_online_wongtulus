<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        Voucher::insert([
            [
                'code' => 'WELCOME10',
                'discount' => 10,
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'code' => 'DISKON20',
                'discount' => 20,
                'start_date' => now(),
                'end_date' => now()->addMonths(1),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}