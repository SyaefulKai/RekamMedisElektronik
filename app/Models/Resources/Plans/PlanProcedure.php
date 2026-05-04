<?php

namespace App\Models\Resources\Plans;

use Illuminate\Database\Eloquent\Model;

use App\Models\Resources\Plans\Plan;
use App\Models\Resources\Procedure;


class PlanProcedure extends Model
{
    protected $table = 'plan_procedures';

    protected $fillable = [
        'code',
        'system',
        'display',
        'name'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
