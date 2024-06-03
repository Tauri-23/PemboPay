<?php

namespace App\Providers;

use App\Contracts\IComputePayrollService;
use App\Contracts\IGenerateEmpIdService;
use App\Contracts\IGenerateFilenameService;
use App\Contracts\IGenerateIdService;
use App\Contracts\IGenerateOTPService;
use App\Contracts\ILoggedService;
use App\Contracts\IPrepareCalendarData;
use App\Contracts\IPrepareCalendarDataService;
use App\Contracts\IRetrieveIdService;
use App\Contracts\IRetrieveService;
use App\Contracts\IRetrieveWhereService;
use App\Contracts\ISaveAccountantLogsDBService;
use App\Contracts\ISendEmailService;
use App\Services\ComputePayrollService;
use App\Services\GenerateEmpIdService;
use App\Services\GenerateFilenameService;
use App\Services\GenerateIdService;
use App\Services\GenerateOTPService;
use App\Services\LoggedService;
use App\Services\prepareCalendarDataService;
use App\Services\RetrieveService;
use App\Services\SaveAccountantLogsDBService;
use App\Services\SendEmailService;
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
        $this->app->bind(IGenerateFilenameService::class, GenerateFilenameService::class);
        $this->app->bind(IGenerateOTPService::class, GenerateOTPService::class);
        $this->app->bind(IGenerateEmpIdService::class, GenerateEmpIdService::class);

        //Process Payroll
        $this->app->bind(IComputePayrollService::class, ComputePayrollService::class);

        // Emails
        $this->app->bind(ISendEmailService::class, SendEmailService::class);

        // Add Logs To DB
        $this->app->bind(ISaveAccountantLogsDBService::class, SaveAccountantLogsDBService::class);

        $this->app->bind(IPrepareCalendarDataService::class, prepareCalendarDataService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
