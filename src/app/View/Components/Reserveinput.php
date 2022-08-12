<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;
use App\Models\ShopTime;

class Reserveinput extends Component
{
    //予約時間データ用変数
    public $times;
    //店舗データ用変数
    public $shop;
    //店舗予約データ用変数
    public $reservation;
    //カウント用データ用変数
    public $count;


    public function __construct($shop,$reservation=null,$count='')
    {
        //営業時間データ作成
        $shoptime = ShopTime::where('shop_id', $shop->id)->first();
        $starttime =  new Carbon($shoptime->start_time);
        $endtime =  new Carbon($shoptime->end_time);
        $times[] = $starttime->format('H:i');
        while($starttime->format('H:i') !== $endtime->format('H:i')){
            $times[] = $starttime->addMinutes(30)->format('H:i');
        }

        $this->times = $times;
        $this->shop = $shop;
        $this->reservation = $reservation;
        $this->count = $count;
    }

    public function render()
    {
        return view('components.reserveinput');
    }
}
