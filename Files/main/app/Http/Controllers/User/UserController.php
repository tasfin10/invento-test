<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function home() {
        $pageTitle = 'Dashboard';
        $user = User::where('id', auth()->id())->withCount(['flats', 'tenants', 'categories', 'bills'])->first();

        return view($this->activeTheme . 'user.page.dashboard', compact('pageTitle', 'user'));
    }

    function profile() {
        $pageTitle = 'Profile Update';
        $user = auth()->user();
        return view($this->activeTheme. 'user.page.profile', compact('pageTitle', 'user'));
    }

    function password() {
        $pageTitle = 'Password Change';
        return view($this->activeTheme . 'user.page.password', compact('pageTitle'));
    }

    function passwordChange() {

        $this->validate(request(), [
            'current_password' => 'required',
            'password'         => 'required|min:6',
        ]);

        $user = auth()->user();

        if (!Hash::check(request('current_password'), $user->password)) return toastBack('error', 'Current password mismatched !!');

        $user->password = Hash::make(request('password'));
        $user->save();

        return toastBack('success', 'Password change success');
    }
}
