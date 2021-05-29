<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosSaleTmp extends Model
{
    protected $table = 'pos_sale_tmp';
    protected $fillable = [
        'id',
        'product_id',
        'price',
        'qty',
        'user_id'
    ];
}
