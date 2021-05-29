<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    protected $table = 'payment_infos';
    protected $fillable = [
        'id',
        'order_id',
        'payment_method',
        'name',
        'sender_phone',
        'wing_code',
        'bank_name',
        'account_name',
        'account_number'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
