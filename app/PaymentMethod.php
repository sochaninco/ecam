<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';
    protected $fillable = [
        'id',
        'name',
        'description',
        'logo',
        'account_number',
        'status'
    ];
}
