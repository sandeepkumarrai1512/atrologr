<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'transaction_id',
        'user_id',
        'amount',
        'status',
        'paid_at'
    ];
}
