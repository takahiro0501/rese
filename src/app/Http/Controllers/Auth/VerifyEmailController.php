<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    //メール認証メソッド
    public function __invoke(EmailVerificationRequest $request)
    {
        //既に認証済みの場合は,home画面へ遷移
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }
        //メール認証処理
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        return view('auth.verify-complete');
    }
    //メール認証成功画面
    public function index()
    {
        return view('auth.verify-email');
    }
}
