<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rating;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'shop_id',
        'start_at',
        'num_of_users'
    ];

    protected $dates = [
        'start_at'
    ];

    //店舗詳細ページの評価領域用にユーザ名を追加する
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return User::where('id',$this->user_id)->first('name');
    }

    //shopsTBLに対して、1対1のリレーション定義
    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }

    //usersTBLに対して、1対1のリレーション定義
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //ratingTBLに対して、1対1のリレーション定義
    public function rating(){
        return $this->hasOne('App\Models\Rating');
    }

    //予約人数データの編集
    //10人以上の場合は、99を設定する。
    public static function reserveNumber($number)
    {
        if(strpos($number,'以上')){
            return 99;
        } else {
            return (int) str_replace('人', '', $number);
        }
        
    }

    //予約情報から評価データの有無を確認する
    public function is_rating()
    {
        return Rating::where([
            [ 'reservation_id' , $this->id ]
        ])->exists();
    }
}