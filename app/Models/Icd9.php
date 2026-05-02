<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icd9 extends Model
{
    protected $fillable = [
        'code',
        'display',
        'version'
    ];
}
