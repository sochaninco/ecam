<?php
/**
 * Created by PhpStorm.
 * User: brath
 * Date: 03/31/18
 * Time: 2:15 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'type',
        'description',
    ];
}