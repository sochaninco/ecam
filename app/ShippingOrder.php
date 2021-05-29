<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingOrder extends Model
{
    protected $table = 'shipping_order';
    protected $fillable = [
        'id',
        'order_id',
        'tracking_no',
        'status',
    ];
}
