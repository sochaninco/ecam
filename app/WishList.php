<?php
/**
 * Created by PhpStorm.
 * User: brath
 * Date: 04/07/18
 * Time: 4:20 PM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
use Session;

class WishList extends Model
{
    public $items = null;
    public $totalQty = 0;
//    public function __construct($oldWish)
//    {
//        if($oldWish){
//            $this->items = $oldWish->items;
//            $this->totalQty = $oldWish->totalQty;
//        }
//    }
//    public function add($item,$id,$product_from){
//        $storedItem = ['id'=>$id,'product_from'=>$product_from,'quantity'=>0,'item'=>$item];
//        if($this->items){
//            if(array_key_exists($id,$this->items)){
//                $storedItem = $this->items[$id];
//            }
//        }
//        $storedItem['quantity']++;
//        $this->items[$id]= $storedItem;
//        $this->totalQty++;
//    }
//    public function remove($id){
//
//        $this->totalQty--;
//    }
    protected $table = 'wishlists';
    protected $fillable = [
        'id',
        'user_id',
        'shop_id',
        'product_from',
        'product_id',
    ];
}