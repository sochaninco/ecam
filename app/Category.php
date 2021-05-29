<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'sma_categories';
    protected $fillable = [
        'id',
        'code',
        'name',
        'image',
        'image_mobile',
        'logo',
    ];
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function subcategory(){
        return $this->hasMany('App\SubCategory');
    }
}
