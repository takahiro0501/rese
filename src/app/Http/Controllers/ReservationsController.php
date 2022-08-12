<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;


class ReservationsController extends Controller
{
    //予約情報Insertメソッド
    public function store(ReservationRequest $request)
    {
        //ログインしていない場合は、ログイン画面へ遷移
        if( !Auth::check() ){
            return redirect()->route('login');
        }
        //Insertデータ作成
        $user_id = Auth::id();
        $item = [
            'user_id' => $user_id,
            'shop_id' => $request->id,
            'start_at' => $request->date.' '.$request->time,
            'num_of_users' => Reservation::reserveNumber($request->number)
        ];
        //Insert実行
        Reservation::create($item);

        return view('thanks',['msg' => __('thanks.reserve') , 'btn' => __('thanks.reserveBtn') ]);
    }

    //予約情報updateメソッド
    public function update(ReservationRequest $request)
    {
        //updateデータ作成
        $user_id = Auth::id();
        $item = [
            'start_at' => $request->date.' '.$request->time,
            'num_of_users' => Reservation::reserveNumber($request->number)
        ];

        //update実行
        Reservation::where('id', $request->id)->update($item);

        return view('thanks',['msg' => __('thanks.reserveRe') , 'btn' => __('thanks.reserveReBtn') ]);
    }

}
