<?php

namespace App\Providers;

use App\Services\Diagnosis\DiagnosisSearchService;
use Illuminate\Support\ServiceProvider;

class DiagnosisProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DiagnosisSearchService::class, );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
