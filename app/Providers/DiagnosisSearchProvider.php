<?php

namespace App\Providers;

use App\Queries\Icd10QueryBuilder;
use App\Services\Diagnosis\DiagnosisSearchService;
use Illuminate\Support\ServiceProvider;

class DiagnosisSearchProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DiagnosisSearchService::class, fn() => new DiagnosisSearchService([
            new Icd10QueryBuilder()
        ]));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
