<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table = 'packages';
    protected $fillable = [
        'id',
        'name',
        'price',
        'no_product',
        'auto_renew',
        'renew',
        'featured_ads',
        'ads_general',
        'ads_specific',
        'ads_custom',
        'shop_info'
    ];
}
