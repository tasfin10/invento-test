<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index()             {
        $pageTitle = 'All Users';
        $users     = User::latest()->paginate(getPaginate());

        return view('admin.user.index', compact('pageTitle', 'users'));
    }

    function add() {
        $user      = null;
        $pageTitle = 'Add New User';
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        return view('admin.user.detail', compact('pageTitle', 'user', 'countries'));
    }

    function check() {
        $exist['data'] = false;
        $exist['type'] = null;

        if (request('email')) {
            $exist['data'] = User::where('email', request('email'))->exists();
            $exist['type'] = 'email';
        }
        if (request('mobile')) {
            $exist['data'] = User::where('mobile', request('mobile'))->exists();
            $exist['type'] = 'mobile';
        }
        if (request('username')) {
            $exist['data'] = User::where('username', request('username'))->exists();
            $exist['type'] = 'username';
        }

        return response($exist);
    }

    function details($id) {
        $user      = User::withCount(['flats', 'tenants', 'categories', 'bills'])->findOrFail($id);
        $pageTitle = 'Details - ' .$user->username;
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        return view('admin.user.detail', compact('pageTitle', 'user', 'countries'));
    }

    function update($id = 0) {
        if ($id) {
            $user = User::findOrFail($id);
        } else {
            $user = new User();
        }

        $countryData  = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryArray = (array)$countryData;
        $countries    = implode(',', array_keys($countryArray));
        $countryCode  = request('country');
        $country      = $countryData->$countryCode->country;
        $dialCode     = $countryData->$countryCode->dial_code;

        if (preg_match("/[^a-z0-9_]/", trim(request('username')))) {
            $toast[] = ['info', 'Usernames are limited to lowercase letters, numbers, and underscores'];
            $toast[] = ['error', 'Username must exclude special characters, spaces, and capital letters'];

            return back()->with('toasts', $toast)->withInput(request()->all());
        }

        $passwordValidation = $id ? 'nullable' : 'required';

        $this->validate(request(), [
            'username'  => 'required|string|max:40|unique:users,username,' . $id,
            'password'  => [$passwordValidation, 'min:6'],
            'firstname' => 'required|string|max:40',
            'lastname'  => 'required|string|max:40',
            'email'     => 'required|email|string|max:40|unique:users,email,' . $id,
            'mobile'    => 'required|string|max:40|unique:users,mobile,' . $id,
            'country'   => 'required|in:' . $countries,
        ]);

        if (request('password')) {
            $user->password = Hash::make(request('password'));
        }
        
        $user->username     = request('username');
        $user->mobile       = $dialCode.request('mobile');
        $user->country_name = $country;
        $user->country_code = $countryCode;
        $user->firstname    = request('firstname');
        $user->lastname     = request('lastname');
        $user->email        = request('email');
        $user->address      = [
                                'city'    => request('city')
                            ];
        $user->save();

        if (!$id) {
            notify($user, 'NEW_USER', [
            'username' => $user->username,
            'password' => request('password')
        ],['email']);
        }

        return toastBack('success', 'User details updated success');
    }

    function login($id) {
        Auth::loginUsingId($id);
        return to_route('user.home');
    }
}
