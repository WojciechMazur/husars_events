<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\OrderStatusCode;
use App\Product;
use App\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSubmitOrderView(){
        $cart = new ShoppingCart(Session::get('shopping-cart'));
        return view('models.products.submit_order', ['cart'=>$cart]);
    }

    public function submitOrderView(Request $request)
    {
        app('debugbar')->warning($request);
        $this->validate($request, [
            'first_name'    => 'required|string|max:255',
            'second_name'   => 'string|nullable|max:255',
            'surname'       => 'required|string|max:255',
            'address'       => 'required|string|min:8',
            'city'          => 'required|string',
            'state'         => 'required|string',
            'country'       => 'required|string',
            'phone'         => 'required|digits_between:6,10',
            'email'         => 'required|string|email|max:255',
            'zip-code'      => 'required|alpha_dash',
            'nip'           => 'nullable|alpha_dash',
            'additional_information' => 'nullable|string'
        ]);

        return $this->checkout($request);


    }

    public function checkout(Request $request)
    {
        if(Session::has('shopping-cart')) {
            $cart = new ShoppingCart(Session::get('shopping-cart'));
        }else{
            throw new BadRequestHttpException('No cart in current session');
        }

        $order = new Order();
        $order->customer_id=Auth::user()->id;
        $order->status_code=OrderStatusCode::where('description', 'Created')->first()->id;
        $order->total_price=$cart->totalPrice;
        $order->first_name=$request['first_name'];
        $order->second_name=$request['second_name'];
        $order->surname=$request['surname'];
        $order->address=$request['address'];
        $order->city=$request['city'];
        $order->country=$request['country'];
        $order->state=$request['state'];
        $order->phone=$request['phone'];
        $order->email=$request['email'];
        $order->zip_code=$request['zip-code'];
        $order->nip=$request['nip'];
        $order->additional_information=$request['additional_information'];

        $order->save();

        foreach ($cart->items as $item){
            $id =$item['item']->id;
            $orderItem = new OrderItem();
            $orderItem->order_id=$order->id;
            $orderItem->product_id=$id;
            $orderItem->order_items_quantity=$item['quantity'];
            $orderItem->save();
            $cart->remove($id);
        }

        $order->status_code=OrderStatusCode::where('description', 'Unpaid')->first()->id;
        $order->save();
        $request->session()->put('shopping-cart', $cart);

        return view('models.products.order_submited')->with('order_id', $order->id);
    }

    public function statusCodes(){
        return OrderStatusCode::all();
    }

    public function statusCodeDescription($code){
        return OrderStatusCode::find($code);
    }

    public function orderItems($id){
        $order = Order::find($id);
        $orderItems = $order->orderItems()->get();
        foreach ($orderItems->all() as $item){
            $item['product']=Product::find($item['product_id']);
        }
        return $orderItems;
    }

    public function index()
    {
        return Order::all();
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
        return Order::find($id);
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order['order_details']=$request['order_details'];
        $order['status_code']=$request['status'];
        $order['first_name']=$request['first_name'];
        $order['second_name']=$request['second_name'];
        $order['surname']=$request['surname'];
        $order['email']=$request['email'];
        $order['phone']=$request['phone'];
        $order['country']=$request['country'];
        $order['state']=$request['state'];
        $order['city']=$request['city'];
        $order['address']=$request['address'];
        $order['zip_code']=$request['zip_code'];
        $order->save();
        return view('admin.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|int
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if($order==null)
            return Response::HTTP_NOT_FOUND;
        return Order::destroy($id);
    }

}
