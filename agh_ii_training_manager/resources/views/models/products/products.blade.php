@extends('layouts.base')
<link rel="stylesheet" href="{{asset('/css/product_tiles.css')}}">
@section('title', 'Products')

@section('main-content')
      <div class="product-grid product-grid--flexbox">
        <div class="product-grid__wrapper">
            <!-- Product list start here -->
        @foreach($products as $product)
            @component('.models.products.product_tile', ['product'=> $product])

            @endcomponent
        @endforeach


        </div>
    </div>

@endsection