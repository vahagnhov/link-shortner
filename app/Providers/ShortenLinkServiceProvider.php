<?php

namespace App\Providers;

use App\Repositories\Interfaces\ShortenLinkRepositoryInterface;
use App\Repositories\ShortenLinkRepository;
use Illuminate\Support\ServiceProvider;

class ShortenLinkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ShortenLinkRepositoryInterface::class,
            ShortenLinkRepository::class
        );
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
