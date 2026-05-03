<?php

namespace App\Queries\Resources;

use App\Models\Resources\Procedure;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProcedureQueryBuilder
{
    public function paginate(int $perPage)
    {
        $query = Procedure::query()->with('user');
        return QueryBuilder::for($query)
            ->allowedFilters(
                AllowedFilter::partial('name')
            )
            ->paginate($perPage)
            ->withQueryString();
    }
}
