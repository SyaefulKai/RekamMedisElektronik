<?php

namespace App\Queries;

use App\Enums\CodeSystem;
use App\Models\Icd9;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Icd9QueryBuilder
{
    public function search(int $limit)
    {
        $query = Icd9::query();
        return QueryBuilder::for($query)
            ->allowedFilters(
                AllowedFilter::callback('query', function ($query, $value) {
                    $query->where(function ($q) use ($value) {
                        $q->where('code', 'LIKE', "%{$value}%")
                            ->orWhere('display', 'LIKE', "%{$value}%");
                    });
                })
            )
            ->limit($limit)
            ->get()
            ->map(fn($value) => [
                'code'    => $value->code,
                'system'  => CodeSystem::ICD9,
                'display' => $value->display,
            ]);
    }
}
