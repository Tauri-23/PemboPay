<?php

namespace App\Providers;

use App\Contracts\IAuthenticateService;
use App\Contracts\IGenerateIdService;
use App\Contracts\ILoggedService;
use App\Contracts\IRetrieveService;
use App\Services\AuthenticateService;
use App\Services\GenerateIdService;
use App\Services\LoggedService;
use App\Services\RetrieveService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ILoggedService::class, LoggedService::class);

        //Retriever Services
        $this->app->bind(IRetrieveService::class, RetrieveService::class);

        //Generate Random Ids Services
        $this->app->bind(IGenerateIdService::class, GenerateIdService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
