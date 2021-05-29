<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosSaleDetail extends Model
{
    protected $table = 'pos_sale_details';
    protected $fillable = [
        'pos_sale_id',
        'product_id',
        'product_code',
        'product_name',
        'product_type',
        'option_id',
        'net_price',
        'unit_price',
        'quantity',
        'warehouse_id',
        'item_tax',
        'tax_rate_id',
        'tax',
        'discount',
        'item_discount',
        'subtotal',
        'real_unit_price',
        'sale_item_id',
        'product_unit',
        'product_unit_code',
        'unit_quantity',
        'comment'
    ];

    public function posSale(){
        return $this->belongsTo('App\PosSale');
    }
}
