<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopProduct extends Model
{
    protected $table = 'shop_products';
    protected $fillable = [
        'id',
        'user_id',
        'sku',
        'code',
        'name',
        'unit',
        'cost',
        'price',
        'category_id',
        'sub_category_id',
        'brand',
        'location',
        'premium_product',
        'promotion',
        'admin_promotion',
        'discount_rate',
        'shipping_type',
        'item_condition',
        'quantity',
        'detail',
        'image',
        'feature_image_detail',
        'feature_image_detail_1',
        'feature_image_detail_2',
        'feature_image_detail_3',
        'feature_image_detail_4',
        'video_upload',
        'video_url',
        'status'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function ShopProductThumbnail(){
        return $this->hasMany('App\Thumbnails','product_id');
    }
}
