<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->namespace('User\Auth')->name('user.')->group(function () {
    // User Login and Logout Process
    Route::controller('LoginController')->group(function () {
        Route::get('login', 'loginForm')->name('login.form');
        Route::post('login', 'login')->name('login');
        Route::get('logout', 'logout')->withoutMiddleware('guest')->middleware('auth')->name('logout');
    });

    // Forgot Password
    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function() {
        Route::get('forgot', 'requestForm')->name('request.form');
        Route::post('forgot', 'sendResetCode');
        Route::get('verification/form', 'verificationForm')->name('code.verification.form');
        Route::post('verification/form', 'verificationCode');
    });

    // Reset Password
    Route::controller('ResetPasswordController')->prefix('password/reset')->name('password.')->group(function() {
        Route::get('form/{token}', 'resetForm')->name('reset.form');
        Route::post('/', 'resetPassword')->name('reset');
    });
});

Route::middleware('auth')->name('user.')->group(function () {
    Route::namespace('User')->group(function () {
        // User Operation

        Route::controller('UserController')->group(function() {
            // KYC Dashboard
            Route::get('dashboard', 'home')->name('home');

            // Profile Information
            Route::get('profile/update', 'profile')->name('profile');

            // Password Change
            Route::get('change/password', 'password')->name('change.password');
            Route::post('change/password', 'passwordChange');
        });

        // Flat Manager
        Route::prefix('flat')->name('flat.')->controller('FlatController')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::post('store/{id?}', 'store')->name('store');
            Route::post('remove/{id?}', 'remove')->name('remove');
            Route::post('assign/{id?}', 'assignTenantToFlat')->name('assign');
        });

        // Bill Manager
        Route::prefix('bill')->name('bill.')->controller('BillController')->group(function () {
            // Bill Category Manager
            Route::get('categories', 'categories')->name('categories');
            Route::post('category/store/{id?}', 'categoryStore')->name('category.store');

            // Bill Manager
            Route::get('index/{flatId}', 'billIndex')->name('index');
            Route::post('add/{flatId}', 'addBill')->name('add');
            Route::post('mark/paid/{billId}', 'markPaid')->name('mark.paid');
        });
    });
});
