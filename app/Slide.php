<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slide_promotion';
    protected $fillable = [
        'id',
        'product_id',
        'type',
        'image',
        'external_link',
        'open_new_tab',
        'status',
    ];
}
