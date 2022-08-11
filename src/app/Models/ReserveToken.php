<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveToken extends Model
{
    protected $fillable = [
        'reservation_id',
        'token'
    ];
}
