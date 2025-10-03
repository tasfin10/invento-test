<?php

use Illuminate\Support\Facades\Route;

Route::controller('WebsiteController')->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('placeholder-image/{size}', 'placeholderImage')->name('placeholder.image');

    // Cookie
    Route::get('cookie/accept', 'cookieAccept')->name('cookie.accept');
    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');
});
