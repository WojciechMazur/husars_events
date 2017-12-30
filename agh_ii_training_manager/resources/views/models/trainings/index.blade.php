@extends('layouts.base')
<head>
    <script>
        const user={!!$user=Auth::user() !!};
    </script>
</head>
<link rel="stylesheet" href="{{asset('/css/trainings.css')}}">
@section('title', 'Trainings')

@section('main-content')
    <div class="product-list">
        <table class="tbl-trainings">
            <tr>
                <th style="display: none">id</th>
                <th>Trainer</th>
                <th>Date</th>
                <th>Location</th>
                <th>Duration</th>
                <th>Limit</th>
                <th></th>
            </tr>
            @foreach($items as $item)
                <tr>
                    <td style="display: none">{{$item['id']}}</td>
                    <td>{{$item['trainer_details']['name']}} {{$item['trainer_details']['surname']}}</td>
                    <td>{{date('Y-m-d H:i', strtotime($item['date']))}}</td>
                    <td>{{$item['location']}}</td>
                    <td>{{$item['duration_minutes']}}m</td>
                    <td>{{$item['signed_in']}}/{{$item['capacity_limit']}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <script src="{{asset('/js/trainings.js')}}"></script>

@endsection