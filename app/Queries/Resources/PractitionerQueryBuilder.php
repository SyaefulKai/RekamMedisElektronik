<?php

namespace App\Queries\Resources;

use App\Models\Resources\Practitioner;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PractitionerQueryBuilder
{
    public function paginate(int $perPage)
    {
        $query = Practitioner::query()->with('user');
        return QueryBuilder::for($query)
            ->allowedFilters(
                AllowedFilter::callback('name', function ($query, $value) {
                    $query->join('users', 'users.id', '=', 'practitioners.user_id')
                        ->where('users.name', 'like', "%{$value}%");
                })
            )
            ->paginate($perPage)
            ->withQueryString();
    }
}
