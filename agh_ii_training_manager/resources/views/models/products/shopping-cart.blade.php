@extends('layouts.base')
@section('title', 'Shopping Cart')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/css/product_tiles.css')}}">
@stop

@section('main-content')

    @if(Session::has('shopping-cart'))
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price [PLN]</th>
            <th>Value [PLN]</th>
            <th></th>
        </tr>
        @if($products!=null)
            @foreach($products as $product)
              <tr>
                  <td><a
                        href="{{route('products.show', ['$product' => $product['item']['attributes']['id']])}}">
                        {{$product['item']['attributes']['name']}}
                      </a>
                  </td>
                  <td class="col-quantity">
                      <input name="quantity-input" id="quantity-item-{{$product['item']['attributes']['id']}}" type="number" min="0"
                                 max="100" value="{{$product['quantity']}}">

                      <button class="btn-quantity-submit fa fa-check-circle-o" aria-hidden="true" value="&#xf05d"> </button>
                  </td>
                  <td>{{$product['item']['attributes']['price']}}</td>
                  <td>{{$product['value']}}</td>
                  <td><form method="post"  action="{{route('shop.shopping-cart.item.remove', ['id' => $product['item']['attributes']['id']])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                      <button> <i class="fa fa-trash-o" aria-hidden="true"></i> </button>
                      </form>
                  </td>
              </tr>
            @endforeach
        @endif
    </table>
    <span id="totalPrice">Total price: <strong>{{$totalPrice}} PLN</strong> </span>
    <button class="btn-submit" id="btn-submit-order">Submit order</button>
    @else
        <h1> Please add something to cart first :( </h1>
    @endif

    <script type="application/javascript" src="{{asset('/js/shop.js')}}"></script>
@endsection