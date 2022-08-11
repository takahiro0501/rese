<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {

        //既に認証済みの場合は,home画面へ遷移
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        //認証処理
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return view('auth.verify-complete');
    }

    public function index()
    {
        return view('auth.verify-email');
    }
}
