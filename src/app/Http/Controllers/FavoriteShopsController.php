<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoriteShopsController extends Controller
{
    //お気に入り店舗登録メソッド
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->favorite_shops()->attach($request->shop_id) ;

        return back();
    }
    //お気に入り店舗削除メソッド
    public function destory(Request $request)
    {
        $user = Auth::user();
        $user->favorite_shops()->detach($request->shop_id) ;

        return back();
    }

}
