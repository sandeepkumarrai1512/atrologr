<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
  public function boot(): void
{
    // Share notifications globally to all views
    View::composer('*', function ($view) {

        // User-based notifications
        if (Auth::guard('web')->check()) {
            $userId = Auth::guard('web')->id(); // or just Auth::id()
            $userNotifications = DB::table('notification')
                ->where('userid', $userId)
                ->orderBy('id', 'desc')
                ->limit(20)
                ->get();

            $view->with('userNotifications', $userNotifications);
        }
    });
}
}