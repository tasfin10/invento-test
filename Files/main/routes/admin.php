<?php

use Illuminate\Support\Facades\Route;

Route::middleware('admin.guest')->namespace('Auth')->group(function () {
    // Admin Login and Logout Process
    Route::controller('LoginController')->group(function () {
        Route::get('/', 'loginForm')->name('login.form');
        Route::post('/', 'login')->name('login');
        Route::get('logout', 'logout')->withoutMiddleware('admin.guest')->middleware('admin')->name('logout');
    });

    // Admin Forgot Password and Verification Process
    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function() {
        Route::get('forgot', 'requestForm')->name('request.form');
        Route::post('forgot', 'sendResetCode');
        Route::get('verification/form', 'verificationForm')->name('code.verification.form');
        Route::post('verification/form', 'verificationCode');
    });

    // Admin Reset Password
    Route::controller('ResetPasswordController')->prefix('password')->name('password.')->group(function() {
        Route::get('reset/form/{email}/{code}', 'resetForm')->name('reset.form');
        Route::post('reset', 'resetPassword')->name('reset');
    });
});

// Operations for Admin
Route::middleware('admin')->group(function () {
    Route::controller('AdminController')->group(function() {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate');
        Route::post('password', 'passwordChange')->name('password.update');
    });

    // User Management
    Route::controller('UserController')->name('user.')->prefix('user')->group(function() {
        // User List
        Route::get('index', 'index')->name('index');

        // New User Add
        Route::get('add', 'add')->name('add');

        // Existing User Check
        Route::post('check', 'check')->name('check');

        // User Details Operation
        Route::get('details/{id?}', 'details')->name('details');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('login/{id}', 'login')->name('login');
    });

    // Tenant Management
    Route::prefix('tenant')->name('tenant.')->controller('TenantController')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store/{id?}', 'store')->name('store');
        Route::post('remove/{id?}', 'remove')->name('remove');
        Route::post('assign', 'assign')->name('assign');
    });
    
    // Setting
    Route::controller('SettingController')->group(function() {
        Route::prefix('setting')->group(function() {
            // Basic Setting
            Route::get('basic', 'basic')->name('basic.setting');
            Route::post('basic', 'basicUpdate');
            Route::post('system', 'systemUpdate')->name('basic.system.setting');
            Route::post('logo-favicon', 'logoFaviconUpdate')->name('basic.logo.favicon.setting');
        });

        // Cache Clear
        Route::get('cache-clear', 'cacheClear')->name('cache.clear');
    });

    // Email & SMS Setting
    Route::controller('NotificationController')->prefix('notification')->name('notification.')->group(function() {
        // Template Setting
        Route::get('universal', 'universal')->name('universal');
        Route::post('universal', 'universalUpdate');
        Route::get('templates','templates')->name('templates');
        Route::get('template/edit/{id}','templateEdit')->name('template.edit');
        Route::post('template/update/{id}','templateUpdate')->name('template.update');

        // Email Setting
        Route::get('email/setting', 'email')->name('email');
        Route::post('email/setting', 'emailUpdate');
        Route::post('email/test','testEmail')->name('email.test');

        // SMS Setting
        Route::get('sms/setting', 'sms')->name('sms');
        Route::post('sms/setting', 'smsUpdate');
        Route::post('sms/test','testSMS')->name('sms.test');
    });
});
