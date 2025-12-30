<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Penduduk\PendudukRepositoryInterface::class,
            \App\Repositories\Penduduk\PendudukRepository::class
        );

        $this->app->bind(
            \App\Repositories\MasterData\WilayahInterface::class,
            \App\Repositories\MasterData\WilayahRepository::class
        );
    }

    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
