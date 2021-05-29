<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $table = 'product_orders';
    protected $fillable = [
        'user_id',
        'payment_method',
        'payment_status',
        'shipping_cost',
        'amount',
        'discount',
        'total',
        'order_status',
        'buyer_message',
        'status',
    ];
    public function ProductOrderDetail(){
        return $this->hasMany('App\ProductOrderDetail');
    }
    public function Product(){
        return $this->belongsTo('App\Product');
    }

}
