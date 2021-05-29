<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'sma_products';
    protected $fillable = [
        'id',
        'type',
        'code',
        'name',
        'second_name',
        'barcode_symbology',
        'cost',
        'price',
        'image',
        'quantity',
        'alert_quantity',
        'cf1',
        'cf2',
        'cf3',
        'cf4',
        'cf5',
        'cf6',
        'category_id',
        'subcategory_id',
        'details',
        'product_details',
        'unit',
        'weight',
        'featured',
        'hide',
        'hide_pos',
        'sale_unit',
        'purchase_unit',
        'slug',
        'views',

    ];
    public function product(){
        return $this->hasOne('App\Category');
    }
    public function ProductThumnail(){
        return $this->hasMany('App\ProductThumnail');
    }
}
