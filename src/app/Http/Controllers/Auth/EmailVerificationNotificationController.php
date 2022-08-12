<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

//認証メール送信メソッド
class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request)
    {
        //既に認証済みの場合
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', 'verification-link-sent');
    }
}
