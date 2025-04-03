<?php

namespace App\Providers;

use App\Repositories\Contracts\IUserRepo;
use App\Repositories\UserRepo;
use App\Service\Contracts\IUserService;
use App\Service\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepo::class, UserRepo::class);
        $this->app->bind(IUserService::class,UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
