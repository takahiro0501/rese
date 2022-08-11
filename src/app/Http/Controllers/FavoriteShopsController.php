<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoriteShopsController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->favorite_shops()->attach($request->shop_id) ;

        return back();
    }

    public function destory(Request $request)
    {
        $user = Auth::user();
        $user->favorite_shops()->detach($request->shop_id) ;

        return back();
    }

}
