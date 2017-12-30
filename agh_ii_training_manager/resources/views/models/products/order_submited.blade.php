@extends('layouts.base')
@section('title', 'Order summary')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/css/product_tiles.css')}}">
@stop

@section('main-content')
    <?php $user = Auth::user();
          $order =\App\Order::find($order_id); ?>

    <div id="order-summary">
        <span>Order ID: {{$order_id}}</span><br>
        <span>Status: {{$order->status['description']}}</span>
        @if($order->status['id']<=2)
            @component('utils.payment_info', ['order_id' => $order_id, 'amount'=>$order->total_price])@endcomponent
        @endif
    </div>
   <table >
        <caption>Order #{{$order_id}}</caption>
       <tr>
           <th>Product</th>
           <th>Quantity</th>
           <th>Price [PLN]</th>
           <th>Value [PLN]</th>
       </tr>
           @foreach(\App\Order::all()->find($order_id)->orderItems()->get()->toArray() as $item)
               <?php $product=\App\Product::all()->find($item['product_id']);?>
               <tr>
                   <td> {{$product['name']}} </td>
                   <td> {{$quantity=$item['order_items_quantity']}}</td>
                   <td> {{$price=$product['price']}}</td>
                   <td> {{$price*$quantity}}</td>
               </tr>
           @endforeach
   </table>
   <span id="totalPrice">
       Total price: <strong>{{$order->total_price}} PLN</strong>
   </span>


    <script type="application/javascript" src="{{asset('/js/shop.js')}}"></script>
@endsection