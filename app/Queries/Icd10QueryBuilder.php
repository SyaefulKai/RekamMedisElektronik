<?php

namespace App\Queries;

use App\Models\Icd10;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Icd10QueryBuilder
{
    public function paginate(int $perPage)
    {
        $query = Icd10::query();

        return QueryBuilder::for($query)
            ->allowedFilters(
                AllowedFilter::callback('icd10_query', function ($query, $value) {
                    $query->where(function ($q) use ($value) {
                        $q->where('icd10_en', 'LIKE', "%{$value}%")
                            ->orWhere('icd10_id', 'LIKE', "%{$value}%")
                            ->orWhere('icd10_code', 'LIKE', "%{$value}%");
                    });
                })
            )
            ->paginate($perPage)
            ->withQueryString();
    }
}
