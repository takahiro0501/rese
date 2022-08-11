<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ShopMakeRequest;
use App\Http\Requests\ShopUpdateRequest;
use App\Models\Shop;
use App\Models\User;
use App\Models\Role;
use App\Models\Reservation;
use App\Models\ShopTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShopMail;


class ManagerController extends Controller
{

    //店舗代表者ホーム画面表示
    public function index()
    {
        //権限確認の為、ログインユーザ取得
        $user = Auth::user();
        
        return view('admin.shop-manager-home',compact('user'));
    }

    //店舗作成画面表示
    public function shop()
    {
        return view('admin.shop-manager-make');
    }

    //店舗作成メソッド
    public function store(ShopMakeRequest $request)
    {
        //AWSs3へ画像アップロード
        $file = $request->file('file');
        $path = Storage::disk('s3')->putFile('image', $file, 'public');
        $url = Storage::disk('s3')->url($path);

        //店舗情報Insert
        $shop = Shop::create([
            'area_id' => $request->area ,
            'genre_id' => $request->genre ,
            'shop_name' => $request->name ,
            'overview' => $request->overview ,
            'img' => $url
        ]);

        //店舗営業時間Insert
        $shoptime = ShopTime::create([
            'shop_id' => $shop->id,
            'start_time' => $request->start ,
            'end_time' => $request->end ,
        ]);


        //作成した店舗情報の権限作成
        $role = Role::create([
            'shop_id' => $shop->id,
            'name' => $shop->shop_name
        ]);

        //作成した権限を店舗代表者に割り当て
        $user = User::where('id', Auth::id())
                    ->update(['role_id' => $role->id]);

        return redirect()->route('manager.home');
    }

    //店舗情報更新画面表示
    public function update()
    {
        //店舗権限情報の取得
        $user = Auth::user();
        $shop = Shop::find($user->role->shop_id);

        return view('admin.shop-manager-update', compact('shop'));
    }

    //店舗情報更新メソッド
    public function updateExec(ShopUpdateRequest $request)
    {
        dd($request->file('file'));

        //対象のショップデータ取得
        $shop = Shop::find($request->id);
        if( !empty($request->file('file')) ){
            
            //既存画像の削除処理
            $str = $shop->img;
            $img = mb_substr($str, mb_strrpos($str, 'amazonaws.com/') + 14, mb_strlen($str));
            $bool = Storage::disk('s3')->delete($img);

            //AWSs3への画像アップロード
            $file = $request->file('file');
            $path = Storage::disk('s3')->putFile('image', $file, 'public');
            $url = Storage::disk('s3')->url($path);
            
        }

        //updateデータ
        $item = [
            'area_id' => $request->area,
            'genre_id' => $request->genre,
            'shop_name' => $request->name,
            'overview' => $request->overview
        ];
        if(isset($url)){
            $item += array('img' => $url);
        }

        //update実行
        Shop::where('id', $request->id)->update($item);

        //営業時間変更
        $dt = [
            'start_time' => $request->start,
            'end_time' => $request->end
        ];
        
        ShopTime::where('shop_id', $request->id)->update($dt);

        return redirect()->route('manager.home');
    }

    //予約情報確認画面表示
    public function reservation(Request $request)
    {

        //セッション情報が残っていれば破棄する
        $request->session()->forget('_old_input');

        //予約時間データ作成
        $time =  new Carbon('2018-01-01 23:30');
        for( $i=0 ; $i<48 ; $i++ ){
            $times[] = $time->addMinutes(30)->format('H:i');
        }

        //予約データ取得
        $user = Auth::user();
        $reservations = Reservation::where('shop_id',$user->role->shop_id)->orderBy('start_at','asc')->get();

        return view('admin.shop-manager-reservation', compact('times','reservations'));
    }

    //予約情報画面検索メソッド
    public function search(Request $request)
    {

        //時間データ作成
        $time =  new Carbon('2018-01-01 23:30');
        for( $i=0 ; $i<48 ; $i++ ){
            $times[] = $time->addMinutes(30)->format('H:i');
        }

        //検索データ取得
        $number = $request->number;
        $date = $request->date;
        $time = $request->time;
                
        //クエリ準備
        $query = Reservation::query();
        
        //権限のある店舗データのみ
        $shop_id = Auth::user()->role->shop_id;
        $query->where('shop_id', '=', $shop_id);

        //登録日」を検索条件に含める
        if(!empty($date)){
            $query->where('start_at', 'like', $date.'%');
        }
        //「予約時間」を検索条件に含める
        if(!empty($time)){
            $query->where('start_at', 'like', '%'.$time.':00');
        }
        //「予約人数」を検索条件に含める
        if(!empty($number)){
            $query->where('num_of_users', '=' , $number);            
        }

        //時間順にソートして実行
        $reservations = $query->orderBy('start_at','asc')->get();

        //検索結果をセッションデータに書き込む
        $request->session()->put([
            '_old_input' => [
                'number' => $number,
                'date' => $date,
                'time' => $time
            ]
        ]);

        return view('admin.shop-manager-reservation', compact('times','reservations'));
    }

    //メール送信画面表示
    public function mail($user_id)
    {  
        $user = User::find($user_id);
        return view('admin.shop-manager-mail',compact('user'));
    }

    //メール送信メソッド
    public function send(Request $request)
    {
        $details = [
            'title' => $request->title,
            'name' => $request->name,
            'body' => $request->msg,
        ];

        Mail::to($request->email)->send(new ShopMail($details));

        return view('admin.shop-manager-mailsend');
        
    }

}
