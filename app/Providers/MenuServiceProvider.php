<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Concerns\InteractsWithMenus;

class MenuServiceProvider extends ServiceProvider
{
    public const MAIN_NAVIGATION = 'main_navigation';
    public const UTILITY_NAVIGATION = 'utility_navigation';
    public const FOOTER_NAVIGATION = 'footer_navigation';
    public const FOOTER_UTILITY_NAVIGATION = 'footer_utility_navigation';
    public const SOCIAL_NAVIGATION = 'social_navigation';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(InteractsWithMenus::class, function () {
            return new InteractsWithMenus();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
