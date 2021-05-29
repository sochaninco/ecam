<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseProductVariants extends Model
{
    protected $table = 'sma_warehouses_products_variants';
    protected $fillable = [
        'id',
        'product_id',
        'warehouse_id',
        'quantity',
        'rack',
    ];
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
