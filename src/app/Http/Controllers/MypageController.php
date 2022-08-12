<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\ReserveToken;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Stripe\Stripe;
use Stripe\Charge;


class MypageController extends Controller
{
    //Mypage画面表示
    public function index()
    {
        //ユーザ情報取得
        $user = Auth::user();
        $name = $user->name;

        //予約情報取得
        //評価機能実装に伴い、現在時刻を基準にデータを分割
        $now = Carbon::now()->toDateTimeString();
        $pasts = Reservation::where([
            ['user_id', '=' , $user->id],
            ['start_at', '<' , $now ]
        ])->orderBy('start_at', 'asc')->get();
        
        $futures = Reservation::where([
            ['user_id', '=' , $user->id],
            ['start_at', '>=' , $now ]
        ])->orderBy('start_at', 'asc')->get();
        
        //お気に入り情報取得
        $favorites = $user->favorite_shops()->get();
        
        return view('mypage',compact('name','pasts','futures','favorites'));
    }

    //予約削除メソッド
    public function destory($reservation_id)
    {
        //対象予約データの削除
        Reservation::destroy($reservation_id);

        return redirect()->route('mypage');
    }

    //QRコード発行メソッド
    public function qr($reservation_id)
    {
        //トークンとしてUUIDを発行
        $token = Uuid::uuid4();
        //トークンをDBへ書き込む
        ReserveToken::create([
            'reservation_id' => $reservation_id,
            'token' => $token
        ]);
        //生成したトークンで制限時間付きURLを生成
        $url = URL::temporarySignedRoute(
            'qr.verify',
            Carbon::now()->addMinutes(30),
            ['token' => $token]
        );

        return view('Qr',['url'=> $url]);
    }

    //QR照合メソッド
    public function qrVerify(Request $request)
    {
        $token = $request->token;
        //期限内かチェック
        if ( $request->hasValidSignature()) {
            //トークン照合チェック
            $reserveToken = ReserveToken::where('token', $token)->first();
            if(!empty($reserveToken)){
                //トークン照合後、削除
                ReserveToken::where('token', $token)->delete();
                //照合情報update
                Reservation::where('id',$reserveToken->reservation_id)->update(['visited' => 1]);
                //照合完了後、予約データ取得
                $reservation = Reservation::where('id',$reserveToken->reservation_id)->first();

                return view('QrVerify', ['reservation' => $reservation]);
            }
        } 
        //照合不可の場合
        return view('QrVerify');
    }

    //決済画面表示
    public function payment($reservation_id)
    {
        return view('payment',['reservation_id' => $reservation_id ]);
    }

    //決済処理メソッド
    public function pay(Request $request)
    {
        //決済処理
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $stripeToken = $request->stripeToken;
            $charge = Charge::create([
                'source' => $stripeToken,
                'amount' => $request->money,
                'currency' => 'jpy',
            ]);
        } catch (Error $e) {
            echo $e->getMessage();
        }
        //決済フラグ書き換え
        Reservation::where('id',$request->id)->update(['payment' => 1]);

        return view('thanks',['msg' => __('thanks.payment') , 'btn' => __('thanks.paymentBtn') ]);
    }

}
