<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageCenter extends Model
{
    protected $table = 'message_center';
    protected $fillable = [
        'id',
        'customer_name',
        'email',
        'title',
        'description',
        'user_id',
        'shop_id',
        'product_from',
        'product_id',
        'message_type',
    ];
}
