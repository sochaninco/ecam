<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','parent_id','user_role','activated','phone','address','city','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function PageShop(){
        return $this->hasOne('App\PageShops','user_id','id');
    }
    public function PaymentInfo(){
        return $this->hasMany('App\PaymentInfo');
    }
    public function posSale(){
        return $this->hasMany('App\PosSale','biller','id');
    }

}
