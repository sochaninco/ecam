<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sma_subcategories';
    protected $fillable = [
        'id',
        'category_id',
        'code',
        'name',
        'image',
    ];
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
