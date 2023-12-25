<?php

namespace App\Providers;

use App\Services\AddMoneyService;
use App\Services\AddMoneyServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AddMoneyServiceInterface::class,
            AddMoneyService::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
