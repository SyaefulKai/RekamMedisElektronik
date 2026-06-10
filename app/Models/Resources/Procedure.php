<?php

namespace App\Models\Resources;

use App\Models\Resources\Plans\Plan;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $fillable = [
        'code',
        'system',
        'display',
        'name',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
