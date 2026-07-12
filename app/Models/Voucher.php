<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'start_date',
        'end_date',
        'status'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}