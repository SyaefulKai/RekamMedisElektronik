<?php

namespace App\Services\Diagnosis;

use App\Services\Diagnosis\Contracts\DiagnosisSearch;

class DiagnosisSearchService
{
    public function __construct(
        protected array $sources
    ){}

    public function search(int $limit)
    {
        /**
         * Class yg implement DiagnosisSearch harus ada filter query
         */
        return collect($this->sources)
        ->flatMap(fn(DiagnosisSearch $source) => $source->search(
            limit: $limit
        ))
        ->take($limit)
        ->values();
    }
}
