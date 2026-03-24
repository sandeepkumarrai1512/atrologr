<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


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
        Route::middleware('web')
            ->middleware([
                // your global middlewares if any
            ])
            ->group(function () {
                // route groups here if needed
            });
    
        // Register custom middleware
        Route::aliasMiddleware('admin.auth', \App\Http\Middleware\RedirectIfNotAdmin::class);
    }

}
