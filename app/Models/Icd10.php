<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icd10 extends Model
{
    protected $fillable = [
        'icd10_code',
        'icd10_en',
        'icd10_id'
    ];
}
