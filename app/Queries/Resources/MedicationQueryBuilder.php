<?php

namespace App\Queries\Resources;

use App\Models\Resources\Medications\Medication;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MedicationQueryBuilder
{
    public function paginate(int $perPage = 10, bool $withSum = false)
    {
        $medication = Medication::query();
        return QueryBuilder::for($medication)
        ->allowedFilters(
            AllowedFilter::callback('name', fn($query, $value) => $query->where('generic_name', 'like', "%$value%")
                ->orWhere('trade_name', 'like', "%$value%"))
        )
        ->when($withSum, function($query) {
            return $query->withSum('stocks', 'quantity');
        })
        ->paginate($perPage)
        ->withQueryString();
    }
}
