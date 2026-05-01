<?php

namespace App\Services\Diagnosis\Contracts;

use App\Queries\Icd10QueryBuilder;

interface DiagnosisSearch
{
    /**
     * Make sure to use 'query' filter in the query builder
     */
    public function search(int $limit);
}
