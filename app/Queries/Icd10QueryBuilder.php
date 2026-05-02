<?php

namespace App\Queries;

use App\Enums\CodeSystem;
use App\Models\Icd10;
use App\Services\Diagnosis\Contracts\DiagnosisSearch;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Icd10QueryBuilder implements DiagnosisSearch
{
    public function search(int $limit)
    {
        return QueryBuilder::for(Icd10::query())
            ->allowedFilters(
                AllowedFilter::callback('query', function ($query, $value) {
                    $query->where(function ($q) use ($value) {
                        $q->where('icd10_en', 'LIKE', "%{$value}%")
                            ->orWhere('icd10_id', 'LIKE', "%{$value}%")
                            ->orWhere('icd10_code', 'LIKE', "%{$value}%");
                    });
                })
            )
            ->limit($limit)
            ->get()
            ->map(fn($value) => [
                'code'    => $value->icd10_code,
                'system'  => CodeSystem::ICD10,
                'display' => $value->icd10_id,
            ]);
    }
}
