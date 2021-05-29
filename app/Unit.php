<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'sma_units';
    protected $fillable = [
        'id',
        'code',
        'name',
        'base_unit',
    ];
}
