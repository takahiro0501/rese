<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;

class ShopsController extends Controller
{
    //Home画面表示('/'でアクセスされた時)
    public function home()
    {
        return redirect()->route('home');
    }

    //Home画面表示('/home'でアクセスされた時)
    public function index(Request $request)
    {   
        //home画面の必要データ取得
        $shops = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();

        //セッション情報が残っていれば破棄する
        $request->session()->forget('_old_input');

        return view('home', compact('shops','areas','genres'));
    }

    //Home画面検索
    public function search(Request $request)
    {
        //ドロップダウンメニュー取得
        $areas = Area::all();
        $genres = Genre::all();

        //クエリ準備
        $query = Shop::query();

        //エリア検索
        if($request->area_id !== '0'){
            $query->Where('area_id', $request->area_id);
        }

        //ジャンル検索
        if($request->genre_id !== '0'){
            $query->Where('genre_id', $request->genre_id);
        }

        //キーワード検索
        if($request->has('keyword')){
            $query->where('shop_name', 'like', '%'. $request->keyword .'%');
        }

        //クエリ実行
        $shops = $query->get();

        //セッションに書き込む
        $request->session()->put([
            '_old_input' => [
                'area_id' => $request->area_id,
                'genre_id' => $request->genre_id,
                'keyword' => $request->keyword,
            ]
        ]);

        return view('home', compact('shops','areas','genres'));
    }

    //店舗詳細ページ表示
    public function detail($shop_id,$reservation_id=null)
    {
        //対象店舗データ取得
        //評価機能に伴い、予約データ・評価データを結合
        $shop = Shop::where('id', $shop_id)->with(['reservations.rating'])->first();
        
        //レビュー数を取得
        $ratingCount = $shop->ratingCount();

        //再予約の場合は予約データを取得しViewへ
        if( isset($reservation_id) ) {
            $reservation = Reservation::find($reservation_id);
            return view('detail',compact('shop','ratingCount','reservation'));
        }

        return view('detail',compact('shop','ratingCount'));
    }

}
