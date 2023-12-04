<?php

namespace App\Providers;
use App\Services\BookmarkService;

use Illuminate\Support\ServiceProvider;

class BookmarkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BookmarkService::class, function ($app) {
            return new BookmarkService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
