<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description',
        'image', 'price', 'view_count', 'waiting_time'];
}
