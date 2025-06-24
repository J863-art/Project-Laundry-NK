<?php

namespace App\Providers;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;

use Illuminate\Support\ServiceProvider;

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

public function boot()
{
    // Custom URL untuk password reset khusus pemilik
    ResetPassword::createUrlUsing(function ($notifiable, string $token) {
        return url(route('owner.password.reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()], false));
    });
}
}
