<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $setting                        = bs();
        $activeTheme                    = activeTheme();
        $shareToView['setting']         = $setting;
        $shareToView['activeTheme']     = $activeTheme;
        $shareToView['activeThemeTrue'] = activeTheme(true);
        $shareToView['emptyMessage']    = 'No data found';

        view()->share($shareToView);

        if ($setting->enforce_ssl) {
            \URL::forceScheme('https');
        }

        Paginator::useBootstrapFour();
    }
}
