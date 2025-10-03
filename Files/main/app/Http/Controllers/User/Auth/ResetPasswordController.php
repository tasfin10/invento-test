<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    function resetForm($verCode = null) {
        $pageTitle = 'Account Recovery';
        $email     = session('fpass_email');

        if (PasswordReset::where('code', $verCode)->where('email', $email)->count() != 1) {
            $toast[] = ['error', 'Invalid verification code'];
            return to_route('user.password.request.form')->withToasts($toast);
        }

        return view($this->activeTheme . 'user.auth.password.reset')->with(
            ['code' => $verCode, 'email' => $email, 'pageTitle' => $pageTitle]
        );
    }

    function resetPassword() {
        $this->validate(request(), [
            'code'     => 'required|int',
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $email     = request('email');
        $checkCode = PasswordReset::where('code', request('code'))->where('email', $email)->orderBy('created_at', 'desc')->first();

        if (!$checkCode) {
            $toast[] = ['error', 'Invalid verification code'];
            return to_route('user.password.request.form')->withToasts($toast);
        }

        $user           = User::where('email', $email)->first();
        $user->password = Hash::make(request('password'));
        $user->save();

        $userIpInfo      = getIpInfo();
        $userBrowserInfo = osBrowser();

        notify($user, 'PASS_RESET_DONE', [
            'operating_system' => $userBrowserInfo['os_platform'],
            'browser'          => $userBrowserInfo['browser'],
            'ip'               => $userIpInfo['ip'],
            'time'             => $userIpInfo['time']
        ],['email']);

        $toast[] = ['success', 'Password reset successfully'];
        return to_route('user.login.form')->withToasts($toast);
    }
}
