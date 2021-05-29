<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariants extends Model
{
    protected $table = 'sma_product_variants';
    protected $fillable = [
        'id',
        'product_id',
        'name',
        'cost',
        'price',
        'quantity'
    ];
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
