<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouses extends Model
{
    protected $table = 'sma_warehouses';
    protected $fillable = [
        'id',
        'code',
        'name',
        'address',
    ];

    public function posSale(){
        return $this->hasMany('App\PosSale','warehouse_id','id');
    }
}
