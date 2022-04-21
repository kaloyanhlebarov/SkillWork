<?php

namespace App\Providers;

use App\Interfaces\Services\CompanyRecordService;
use App\Services\CompanyRecordServices\Clearbit;
use Illuminate\Support\ServiceProvider;

class CompanyRecordServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // We can create a config file for the service if we want different services in the different enviroments
        $this->app->bind(CompanyRecordService::class, Clearbit::class);
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
