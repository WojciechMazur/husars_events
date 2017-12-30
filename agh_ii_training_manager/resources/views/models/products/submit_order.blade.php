@extends('layouts.base')
@section('title', 'Submit order')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/css/product_tiles.css')}}">
@stop

@section('main-content')
    <?php $user = Auth::user();?>

    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price [PLN]</th>
            <th>Value [PLN]</th>
        </tr>
        @if($cart!=null)

            @foreach($cart->items as $product)
                <tr>
                    <td> {{$product['item']['attributes']['name']}} </td>
                    <td> {{$product['quantity']}}</td>
                    <td> {{$product['item']['attributes']['price']}}</td>
                    <td> {{$product['value']}}</td>
                </tr>
            @endforeach
        @endif
    </table>
    <span id="totalPrice">Total price: <strong>{{$cart->totalPrice}} PLN</strong> </span>

    <form method="post" action="{{route('post.shop.shopping-cart.submit')}}">
        {{csrf_field()}}
            <div class="form-group">
                <label for="first_name">First name</label>
                <input class="form-control" name="first_name" id="first_name" type="text" value="{{(isset($old) ? $old['first_name'] : $user ? $user['first_name']  : "")}}" required>
            </div>

            <div class="form-group">
                <label for="second_name">Second name</label>
                <input class="form-control"  name="second_name" id="second_name" type="text" value="{{isset($old) ? $old['second_name'] :$user ? $user['second_name'] : ""}}">
            </div>

            <div class="form-group">
                <label for="surname">Surname</label>
                <input class="form-control"  name="surname" id="surname" type="text" value="{{(isset($old) ? $old['surname'] : $user ? $user['surname'] :  "")}}" required>
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <input class="form-control" name="country" id="country" type="text" value="{{(isset($old) ? $old['country']:$user ? $user['country'] :  "")}}">
            </div>

            <div class="form-group">
                <label for="state">State</label>
                <input class="form-control" name="state" id="state" type="text" value="{{isset($old) ? $old['state']:$user ? $user['state'] : ("")}}">
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input class="form-control" name="city" id="city" type="text" value="{{(isset($old) ? $old['city']:$user ? $user['city'] : "")}}" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input class="form-control" name="address" id="address" type="text" value="{{(isset($old) ? $old['address']:$user ? $user['address'] :"")}}" required>
            </div>

            <div class="form-group">
                <label for="zip-code">Zip code</label>
                <input class="form-control" name="zip-code" id="zip-code" type="text" value="{{(isset($old) ? $old['zip-code']:$user ? $user['zip-code'] : "")}}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input class="form-control" name="phone" id="phone" type="tel" value="{{(isset($old) ? $old['phone']:$user ? $user['phone'] : "")}}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" name="email" id="email" type="email" value="{{(isset($old) ? $old['email']:$user ? $user['email'] : "")}}" required>
            </div>

            <div class="form-group">
                <label for="nip">NIP</label>
                <input class="form-control" name="nip" id="nip" type="text" value="{{(isset($old) ? $old['nip']:$user ? $user['nip'] : "")}}">
            </div>

                <div class="form-group">
                <label for="additional_info">Additional informations</label>
                <input class="form-control" name="additional_info" id="additional_info" type="text">
            </div>
        <button type="submit" class="btn-submit" id="btn-submit-order">Submit order</button>
    </form>


    <script type="application/javascript" src="{{asset('/js/user/shop.js')}}"></script>
@endsection