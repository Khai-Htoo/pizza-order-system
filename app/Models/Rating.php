<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['rating_id', 'user_id', 'product_id',
        'rating_count', 'message'];
}
