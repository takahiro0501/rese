<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    //ログイン
    public function store(LoginRequest $request)
    {

        if (! Auth::attempt($request->only('email', 'password'))) {
            
            //ログイン失敗時
            throw ValidationException::withMessages([
                'authfail' => '認証に失敗しました。メール又はパスワードが違います。'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    //ログアウト処理
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

}
