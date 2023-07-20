<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
        'total',
        'order_code',
    ];
}
