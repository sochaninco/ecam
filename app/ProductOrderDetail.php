<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrderDetail extends Model
{
    protected $table = 'product_order_details';
    protected $fillable = [
        'product_from',
        'user_id',
        'shop_id',
        'product_id',
        'qty',
        'price',
        'amount',
        'order_status',
        'status',
    ];

    public function ProductOrder(){
        return $this->belongsTo('App\ProductOrder');
    }
}
