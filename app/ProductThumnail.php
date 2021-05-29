<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductThumnail extends Model
{
    protected $table = 'sma_product_photos';
    protected $fillable = [
        'id',
        'product_id',
        'photo',
    ];
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
