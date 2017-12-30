@extends('layouts.base')
@section('title', 'User profile')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/css/profile.css')}}">
@stop

@section('main-content')
    <div id="customer-info">
        <h2>Contact details</h2>
        <span>{{$profile['first_name']}}
            @if($profile['second_name']!= null)
                {{$profile['second_name']}}
            @endif
            {{$profile['surname']}}
        </span><br>
        <span>{{$profile['address']}}, {{$profile['zip-code']}} {{$profile['city']}}<br>
        {{$profile['state']}} {{$profile['country']}}</span><br>

        <span>Phone: {{$profile['phone']}}</span><br>
        <span>E-mail: {{$profile['email']}}</span><br>
    </div>

    <div id="profile-orders">
        <h2>Recent orders</h2>
        @if(!$orders->isEmpty())
            <ul>
                <ol class="order-item-label">
                    <span class="recent-orders-id"><b>Order ID</b></span>
                    <span class="recent-orders-status"><b>Status</b></span>
                    <span class="recent-orders-created"><b>Last update</b></span>
                    <span class="recent-orders-value"><b>Value</b></span>
                </ol>
            @foreach($orders as $order)
                <li class="order-item">
                    <span class="recent-orders-id">{{$order['id']}}</span>
                    <span class="recent-orders-status">{{\App\Order::find($order['id'])->status['description']}}</span>
                    <span class="recent-orders-created">{{$order['updated_at']}}</span>
                    <span class="recent-orders-value">{{$order['total_price']}} PLN</span>
                    <span class="btn-expend"></span>
                    <ul>
                        <ol class="order-item-details collapsable">
                            <span class="orders-item-name"><b>Product name</b></span>
                            <span class="orders-item-price"><b>Price</b></span>
                            <span class="orders-item-quantity"><b>Quantity</b></span>
                        </ol>
                        @foreach($order->orderItems as $item)
                            <li class="order-item-details collapsable">
                                <?php $product=$item->product; ?>
                                <span class="orders-item-name">{{$product['name']}}</span>
                                <span class="orders-item-price">{{$product['price']}} PLN</span>
                                <span class="orders-item-quantity">{{$item['order_items_quantity']}}</span>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            </ul>
        @else
            <span style="width: 100%">No recent orders</span>
        @endif
    </div>

    <div id="profile-trainings">
        <h2>Reservations for training</h2>
        @if(!empty($trainings))
            <ul>
                <ol id="traing-item-labels">
                    <span class="training-date"><b>Date</b></span>
                    <span class="training-location"><b>Location</b></span>
                    <span class="training-limit"><b>Current limit</b></span>
                    <span class="btn-expend"></span>
                </ol>
                @foreach($trainings as $training)
                    <li class="training-item">
                        <span class="training-id" style="display: none">{{$training['reservation_id']}}</span>
                        <span class="training-date">{{substr($training['date'],0,16)}}</span>
                        <span class="training-location">{{$training['location']}}</span>
                        <span class="training-limit">{{$training['signed_in']}}/{{$training['capacity_limit']}}</span>
                        <span class="btn-expend"></span>
                        <ul class="training-details">
                                @php($trainer=App\Trainer::find($training['trainer_id']))
                                <li class="collapsable"><span class="trainer">Trainer: <b>{{$trainer['name']}} {{$trainer['surname']}} </b></span></li>
                                <li class="collapsable"><span class="trainer-spec">Specialization: <b>{{$trainer['specialization']}}</b></span></li>
                            <li class="collapsable"><span class="training-duration>">Duration: <b>{{$training['duration_minutes']}} minutes</b></span> </li>
                                <li class="collapsable"><span class="training-description">{{$training['description']}}</span></li>
                            <li class="collapsable"><button class="fa fa-times-circle-o btn-remove-training-reservation" aria-hidden="true" value="{{$training['reservation_id']}}"> Remove reservation</button></li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        @else
            <span style="width: 100%;text-align: center">No training reservations</span>
        @endif

        <h2>Past trainings</h2>
        @if(!empty($trainings_past))
            <ul>
                <ol id="traing-item-labels">
                    <span class="training-date"><b>Date</b></span>
                    <span class="training-location"><b>Location</b></span>
                    <span class="training-limit"><b>Current limit</b></span>
                    <span class="btn-expend"></span>
                </ol>
                @foreach($trainings_past as $training)
                    <li class="training-item">
                        <span class="training-id" style="display: none">{{$training['id']}}</span>
                        <span class="training-date">{{substr($training['date'],0,16)}}</span>
                        <span class="training-location">{{$training['location']}}</span>
                        <span class="training-limit">{{$training['signed_in']}}/{{$training['capacity_limit']}}</span>
                        <span class="btn-expend"></span>
                        <ul class="training-details">
                            @php($trainer=App\Trainer::find($training['trainer_id']))
                            <li class="collapsable"><span class="trainer">Trainer: <b>{{$trainer['name']}} {{$trainer['surname']}} </b></span></li>
                            <li class="collapsable"><span class="trainer-spec">Specialization: <b>{{$trainer['specialization']}}</b></span></li>
                            <li class="collapsable"><span class="training-duration>">Duration: <b>{{$training['duration_minutes']}} minutes</b></span> </li>
                            <li class="collapsable"><span class="training-description">{{$training['description']}}</span></li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        @else
            <span style="width: 100%;text-align: center">No past trainings</span>
        @endif
    </div>

    <script src="{{asset('/js/expandable_list.js')}}"></script>
    <script src="{{asset('/js/profile.js')}}"></script>
@endsection