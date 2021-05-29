<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'sma_brands';
    protected $fillable = [
        'id',
        'code',
        'name',
        'category_id',
        'image',
        'banner',
        'slug'
    ];
}
