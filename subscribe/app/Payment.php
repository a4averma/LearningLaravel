<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'buyer_name', 'buyer_email', 'buyer_number', 'request_id', 'payment_id', 'status'
    ];
}
