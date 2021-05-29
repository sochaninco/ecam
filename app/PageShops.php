<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageShops extends Model
{
    protected $table = 'page_shops';
    protected $fillable = [
        'id',
        'user_id',
        'shop_name',
        'shop_email',
        'phone',
        'address',
        'city',
        'website',
        'shop_image',
        'shop_image_small',
        'shop_logo',
        'description',
        'shop_theme',
        'promotion_status',
        'status'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
