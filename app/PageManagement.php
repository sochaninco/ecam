<?php
/**
 * Created by PhpStorm.
 * User: brath
 * Date: 07/07/18
 * Time: 2:58 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class PageManagement extends Model
{
    protected $table = 'page_management';
    protected $fillable = [
        'id',
        'block',
        'status',
    ];
}
