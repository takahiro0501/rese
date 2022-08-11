<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopTime extends Model
{
    protected $fillable = [
        'shop_id',
        'start_time',
        'end_time'
    ];

}
