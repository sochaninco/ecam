<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorySlide extends Model
{
    protected $table = 'category_slides';
    protected $fillable = [
        'id',
        'category_id',
        'product_id',
        'slide_type',
        'image',
        'page',
        'style_display',
        'url',
        'open_new_tab',
        'status',
    ];
}
