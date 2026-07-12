<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@wongtulus.com',
            'phone' => '081234567890',
            'address' => 'Surabaya',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}