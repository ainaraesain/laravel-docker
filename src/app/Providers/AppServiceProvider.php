<?php

namespace App\Providers;

use App\Infrastructure\Database\ElocuentUserDataSource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ElocuentUserDataSource::class, function () {
            return new ElocuentUserDataSource();
        });
    }
}
