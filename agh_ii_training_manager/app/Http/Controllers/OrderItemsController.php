<?php

namespace App\Http\Controllers;

use App\OrderItem;
use App\Product;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return OrderItem[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        $items = OrderItem::all();
        return $items;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return OrderItem|OrderItem[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|int
     */
    public function update(Request $request, $id)
    {
        $item = OrderItem::find($id);
        $response['item']=$item;
        if($request['order_items_quantity']!=null){
            $oldQuantity= $item['order_items_quantity'];
            $itemPrice= Product::find($item['product_id'])['price'];
            $response['item_price']=$itemPrice;
            if($request['order_items_quantity']<=0){
                return $this->destroy($id);
            }
            $item['order_items_quantity']=$request['order_items_quantity'];
            $order = $item->order()->first();
            $order['total_price']=$order['total_price']-$itemPrice*($oldQuantity-$request['order_items_quantity']);
            $order['updated_at']=date('Y-m-d H:i:s');
            $order->save();
            $response['order']=$order;
        }
        $item->save();
        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response|int
     */
    public function destroy($id)
    {
        return OrderItem::destroy($id);
    }

}
