<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionMember extends Model
{
    protected $table = 'transaction_membership';
    protected $fillable = [
        'id',
        'payment_type',
        'status',
        'package_id',
        'user_id',
        'phone',
        'wing_code',
    ];
}
