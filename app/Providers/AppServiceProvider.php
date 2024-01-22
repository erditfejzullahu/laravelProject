<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\userServiceInterface;
use App\Services\userService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(userServiceInterface::class, userService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
