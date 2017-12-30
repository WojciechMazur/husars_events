<?php

namespace App\Http\Controllers;

use App\Product;
use App\ShoppingCart;
use App\Http\Controllers\OrderController;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('models.products.products')->with('products', $products);
    }

    public function addToCart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session::has('shopping-cart') ? Session::get('shopping-cart') : null;
        $cart = new ShoppingCart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('shopping-cart', $cart);
        return redirect()->route('products.index');
    }

    public function editShoppingCart(Request $request ){

        $product = Product::find($request['id']);

        if(Session::has('shopping-cart')){
            $cart=Session::get('shopping-cart');
            $response = $cart->edit($product->id, $request['key'], $request['value']);
            $request->session()->put('shopping-cart', $cart);
            if($response!=null){
                return $response;
            }
        }
        return response(json_encode($cart), 200);
    }

    public function removeFromShoppingCart(Request $request, $id){
        $product = Product::find($id);

        if(Session::has('shopping-cart')) {
            $cart = Session::get('shopping-cart');
            $cart->remove($product->id);
            $request->session()->put('shopping-cart', $cart);
        }
        return redirect()->route('shop.shopping-cart');
    }

    public function getShoppingCart(){
        if(!Session::has('shopping-cart')){
            return view('models.products.shopping-cart', ['products'=>null]);
        }
        $oldCart = Session::get('shopping-cart');
        $cart = new ShoppingCart($oldCart);
        return view('models.products.shopping-cart', ['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice]);
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
        echo Product::find($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
