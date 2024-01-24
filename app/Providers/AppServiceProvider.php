<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\userService;
use App\Services\postService;
use App\Services\userServiceInterface;
use App\Services\postServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(userServiceInterface::class, userService::class);
        $this->app->bind(postServiceInterface::class, postService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
