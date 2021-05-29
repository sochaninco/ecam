<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterType extends Model
{
    protected $table = 'footer_types';
    protected $fillable = [
        'id',
        'name',
        'status',
    ];
    public function FooterPage(){
        return $this->hasMany('App\FooterPage','footer_type_id','id');
    }
}
