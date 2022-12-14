<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingsController extends Controller
{
    //評価画面表示
    public function index($rservation_id,$shop_name)
    {
        return view('rating',['id' => $rservation_id ,'shop_name' => $shop_name ]);
    }

    //評価データInsert
    public function store(Request $request)
    {
        $item = [
            'reservation_id' => $request->id, 
            'rating' => $request->rate, 
            'comment' => $request->comment, 
        ];
        Rating::create($item);

        return view('thanks',['msg' => __('thanks.rating') , 'btn' => __('thanks.ratingBtn') ]);
    }

}
