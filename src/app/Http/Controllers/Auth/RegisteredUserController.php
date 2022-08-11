<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;

class RegisteredUserController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }

    //ユーザ登録処理
    public function store(RegisterRequest $request)
    {
        //ユーザ作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //認証メール送信
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('auth.mailsend');
    }
}
