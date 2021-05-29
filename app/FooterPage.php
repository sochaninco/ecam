<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterPage extends Model
{
    protected $table = 'footer_pages';
    protected $fillable = [
        'id',
        'name',
        'footer_type_id',
        'url',
        'description',
        'image',
    ];
    public function FooterType(){
        return $this->belongsTo('App\FooterType');
    }
}
