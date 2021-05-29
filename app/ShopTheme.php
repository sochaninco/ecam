<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopTheme extends Model
{
    protected $table = 'shop_themes';
    protected $fillable = [
        'id',
        'shop_type',
        'theme_banner',
        'theme_banner_small',
        'status',
    ];
}
