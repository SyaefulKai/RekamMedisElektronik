<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $fillable = [
        'code',
        'system',
        'display',
        'name',
    ];
}
