<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //adminログイン画面
    public function login()
    {
        return view('auth.admin-login');
    }

    //adminログイン
    public function store(LoginRequest $request)
    {
        
        if (! Auth::attempt($request->only('email', 'password'))) {
            //ログイン失敗時
            throw ValidationException::withMessages([
                'authfail' => '認証に失敗しました。メールアドレス又はパスワードが違います。'
            ]);
        }
        $request->session()->regenerate();

        return redirect()->route('admin.route');
    }

    //ルート振り分け
    public function adminRoute(Request $request)
    {
        //権限により表示ページを振り分ける
        if($request->user()->can('manager')){
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('manager.home');
        }
    }

    public function index(Request $request)
    {
        $shopManagers = User::where('role_id', '>', 1)->orderBy('updated_at','desc')->get();
        $shops = Shop::all();
        return view('admin.manager-home',compact('shopManagers','shops'));

    }

    public function create(RegisterRequest $request)
    {

        //ユーザ作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);

        //権限を一時的にダミーデータと結びつける
        User::where('id', $user->id )->update(['role_id' => 2]);

        return redirect()->route('admin.home');
    }

    //ログアウト処理
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }


}
