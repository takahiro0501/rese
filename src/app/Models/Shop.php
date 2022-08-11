<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Shop extends Model
{

    protected $fillable = [
        'area_id',
        'genre_id',
        'shop_name',
        'overview',
        'img'
    ];

    //areaTBLに対して、1対1のリレーション定義
    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

    //genruTBLに対して、1対1のリレーション定義
    public function genre(){
        return $this->belongsTo('App\Models\Genre');
    }

    //reservationTBLに対して、1対多のリレーション定義
    public function reservations(){
        return $this->hasMany('App\Models\Reservation');
    }

    //reservationTBLに対して、1対多のリレーション定義
    public function shoptime(){
        return $this->hasMany('App\Models\ShopTime');
    }

    //店舗データに紐づく口コミ数をカウントする
    public function ratingCount()
    {
        $count = 0;
        $reservations = Reservation::where('shop_id', $this->id )->get();
        foreach($reservations as $reservation) {
            if( isset($reservation->rating ) ){
                $count++;
            }
        }
        return $count;
    }
    
}
