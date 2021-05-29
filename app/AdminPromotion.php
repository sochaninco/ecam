<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPromotion extends Model
{
    protected $table = 'admin_promotion';
    protected $fillable = [
        'id',
        'name',
        'value',
        'value_type',
        'started_date',
        'finished_date',
        'image',
        'image_detail'
    ];
}
