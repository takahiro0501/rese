<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;
use App\Models\ShopTime;

class SelectTime extends Component
{

    public $msg;
    public $times;
    public $dt;

    public function __construct($msg, $id=null)
    {
        //店舗情報update時にDBのデータを取得
        if(isset($id) && $msg == 'start'){
            $shoptime = ShopTime::where('shop_id', $id)->first();
            $dt = substr($shoptime->start_time,0,5);
        } elseif (isset($id) && $msg == 'end'){
            $shoptime = ShopTime::where('shop_id', $id)->first();
            $dt = substr($shoptime->end_time,0,5);
        } else {
            $dt = null;
        }

        //営業時間データ作成
        $starttime =  new Carbon('00:00');
        $endtime =  new Carbon('23:30');
        $times[] = $starttime->format('H:i');
        while($starttime->format('H:i') !== $endtime->format('H:i')){
            $times[] = $starttime->addMinutes(30)->format('H:i');
        }

        $this->dt = $dt;
        $this->msg = $msg;
        $this->times = $times;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-time');
    }
}
