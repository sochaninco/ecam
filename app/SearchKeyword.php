<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchKeyword extends Model
{
    protected $table = 'search_keywords';
    protected $fillable = [
        'id',
        'label_promo',
        'type',
        'shop',
        'product_by_shop',
        'keyword',
        'link_to',
        'category_id',
        'sub_category_id'

    ];
}
