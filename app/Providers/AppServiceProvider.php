<?php

namespace App\Providers;

use App\View\Components\Footer;
use App\View\Components\Navbar;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('navbar', Navbar::class);
        Blade::component('footer', Footer::class);
    }
}
