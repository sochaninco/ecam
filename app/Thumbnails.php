<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thumbnails extends Model
{
    protected $table = 'thumbnails';
    protected $fillable = [
        'id',
        'image',
        'product_id',
        'user_id'
    ];

    public function shopProduct(){
        return $this->belongsTo('App\ShopProduct');
    }
}
