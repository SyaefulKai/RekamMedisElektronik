<?php

namespace App\Queries\Resources;

use App\Models\Resources\Patient;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PatientQueryBuilder
{
    public function paginate(int $perPage)
    {
        $query = Patient::query();
        return QueryBuilder::for($query)
        ->allowedFilters(
            AllowedFilter::partial('name')
        )
        ->paginate($perPage)
        ->withQueryString();
    }
}
