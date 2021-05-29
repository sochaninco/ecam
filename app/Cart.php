<?php
/**
 * Created by PhpStorm.
 * User: brath
 * Date: 01/21/18
 * Time: 4:30 PM
 */

namespace App;
use Session;


class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    public function add($item,$id,$qty,$product_from){
        $storedItem = ['id'=>$id,'product_from'=>$product_from,'quantity'=>0,'price'=>$item->price,'item'=>$item];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['quantity']++;
        $storedItem['price']=$item->price * $storedItem['quantity'];
        $this->items[$id]= $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }
    public function remove($id){

        $this->totalQty--;
    }
}