@extends('layouts.base')
<head>
    @if(Auth::user()!=null)
        <script>
            const user={!!$user=Auth::user()!!};
        </script>
    @endif
</head>
<link rel="stylesheet" href="{{asset('/css/trainings.css')}}">
@section('title', 'Trainings')

@section('main-content')
    <div class="product-list">
        <table class="tbl-trainings">
            <tr>
                <th>Trainer</th>
                <th>Date</th>
                <th>Location</th>
                <th>Duration</th>
                <th>Limit</th>
            </tr>
            @foreach($items as $item)
                <tr>
                    <td style="display: none">{{$item['id']}}</td>
                    <td style="text-align: left;">{{$item['trainer_details']['name']}} {{$item['trainer_details']['surname']}}</td>
                    <td style="text-align: center">{{date('Y-m-d H:i', strtotime($item['date']))}}</td>
                    <td style="text-align: left">{{$item['location']}}</td>
                    <td style="text-align: center">{{$item['duration_minutes']}}m</td>
                    <td style="text-align: center">{{$item['signed_in']}}/{{$item['capacity_limit']}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <script src="{{asset('/js/user/trainings.js')}}"></script>

@endsection