<?php

namespace App\Providers;

use App\Contracts\IAuthenticateService;
use App\Contracts\IComputePayrollService;
use App\Contracts\IGenerateIdService;
use App\Contracts\ILoggedService;
use App\Contracts\IRetrieveIdService;
use App\Contracts\IRetrieveService;
use App\Contracts\IRetrieveWhereService;
use App\Services\AuthenticateService;
use App\Services\ComputePayrollService;
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
        $this->app->bind(IRetrieveIdService::class, RetrieveService::class);
        $this->app->bind(IRetrieveWhereService::class, RetrieveService::class);

        //Generate Random Ids Services
        $this->app->bind(IGenerateIdService::class, GenerateIdService::class);

        //Process Payroll
        $this->app->bind(IComputePayrollService::class, ComputePayrollService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
