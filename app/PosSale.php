<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosSale extends Model
{
    protected $table = 'pos_sales';
    protected $fillable = [
        'reference_no',
        'customer_id',
        'customer',
        'biller_id',
        'biller',
        'warehouse_id',
        'note',
        'staff_note',
        'total',
        'product_discount',
        'order_discount_id',
        'discount_type',
        'total_discount',
        'order_discount',
        'product_tax',
        'order_tax_id',
        'order_tax',
        'total_tax',
        'shipping',
        'grand_total',
        'sale_status',
        'payment_status',
        'payment_term',
        'due_date',
        'total_items',
        'paid',
        'return_id',
        'surcharge',
        'return_sale_ref',
        'sale_id',
        'return_sale_total',
        'payment_method',
        'user_id'
    ];

    public function posSaleDetail(){
        return $this->hasMany('App\PosSaleDetail');
    }
    public function user(){
        return $this->belongsTo('App\User','biller','id');
    }
    public function warehouse(){
        return $this->belongsTo('App\Warehouses','warehouse_id','id');
    }
}
