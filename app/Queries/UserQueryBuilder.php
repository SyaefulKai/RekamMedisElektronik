<?php

namespace App\Queries;

use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserQueryBuilder
{
    public function paginate(int $perPage)
    {
        $query = User::query()->with('roles', 'practitioner');
        return QueryBuilder::for($query)
            ->allowedFilters(
                AllowedFilter::partial('name')
            )
            ->paginate($perPage)
            ->withQueryString();
    }
}
