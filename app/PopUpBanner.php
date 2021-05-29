<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopUpBanner extends Model
{
    protected $table = 'pop_up_banner';
    protected $fillable = [
        'id',
        'image',
        'url',
        'status'
    ];
}
