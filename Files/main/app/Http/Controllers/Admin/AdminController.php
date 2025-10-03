<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Flat;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;

class AdminController extends Controller
{
    function dashboard() {
        $pageTitle     = 'Dashboard';

        $widget = [
            'totalUsers'   => User::count(),
            'totalTenants' => Tenant::count(),
            'totalFlats' => Flat::count(),
            'totalBills' => Bill::count(),
        ];

        return view('admin.page.dashboard', compact('pageTitle', 'widget'));
    }

    function profile() {
        $pageTitle = 'Profile';
        $admin     = auth('admin')->user();
        return view('admin.page.profile', compact('pageTitle', 'admin'));
    }

    function profileUpdate() {
        $this->validate(request(), [
            'name'     => 'required|max:40',
            'email'    => 'required|email|max:40',
            'username' => 'required|max:40',
            'contact'  => 'required|max:40',
            'address'  => 'required|max:255',
            'image'    => [File::types(['png', 'jpg', 'jpeg'])],
        ]);

        $admin = auth('admin')->user();

        if (request()->hasFile('image')) {
            try {
                $admin->image = fileUploader(request('image'), getFilePath('adminProfile'), getFileSize('adminProfile'), $admin->image);
            } catch (\Exception $exp) {
                return toastBack('error', 'Image upload failed');
            }
        }

        $admin->name     = request('name');
        $admin->email    = request('email');
        $admin->username = request('username');
        $admin->contact  = request('contact');
        $admin->address  = request('address');
        $admin->save();

        return toastBack('success', 'Profile update success');
    }

    function passwordChange() {
        $this->validate(request(), [
            'current_password' => 'required',
            'password'         => 'required|min:6',
        ]);

        $admin = auth('admin')->user();

        if (!Hash::check(request('current_password'), $admin->password)) return toastBack('error', 'Current password mismatched !!');

        $admin->password = Hash::make(request('password'));
        $admin->save();

        return toastBack('success', 'Password change success');
    }
}
