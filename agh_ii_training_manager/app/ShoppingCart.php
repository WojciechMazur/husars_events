<?php

namespace App;


class ShoppingCart
{
    public $items;
    public $totalQuantity =0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items=$oldCart->items;
            $this->totalQuantity=$oldCart->totalQuantity;
            $this->totalPrice=$oldCart->totalPrice;
        }
    }

    public function add($item, $id){
        $storedItem = ['quantity'=>0, 'value' => $item->price, 'item'=>$item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['quantity']++;
        $storedItem['value']= (float)$item->price * (int)$storedItem['quantity'];
        $this->items[$id] = $storedItem;
        $this->totalQuantity++;
        $this->totalPrice+= $item->price;
    }

    public function edit($id, $key, $value){
        if($key=='quantity' && $value==0)
            $this->remove($id);
        if($this->items && array_key_exists($id, $this->items)){
            $edited = $this->items[$id];
            $edited[$key] = $value;
            $this->items[$id]=$edited;

            $totalQuantity=0;
            $totalPrice=0;
            foreach ($this->items as $item){
                $item['value']=(float)$item['item']['attributes']['price']*(int)$item['quantity'];
                $totalQuantity+=$item['quantity'];
                $totalPrice+=$item['value'];
                $this->items[$item['item']['attributes']['id']]=$item;
            }

            $this->totalPrice=$totalPrice;
            $this->totalQuantity=$totalQuantity;
        }
    }

    public function remove($id){
        if($this->items && array_key_exists($id, $this->items)){
            unset($this->items[$id]);
        }

        $totalQuantity=0;
        $totalPrice=0;
        foreach ($this->items as $item){
            $item['value']=$item['item']['attributes']['price']*$item['quantity'];
            $totalQuantity+=$item['quantity'];
            $totalPrice+=$item['value'];
        }

        $this->totalPrice=$totalPrice;
        $this->totalQuantity=$totalQuantity;
    }
}
