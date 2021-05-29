<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseProducts extends Model
{
    protected $table = 'sma_warehouses_products';
    protected $fillable = [
        'id',
        'product_id',
        'warehouse_id',
        'quantity',
        'rack',
    ];
}
