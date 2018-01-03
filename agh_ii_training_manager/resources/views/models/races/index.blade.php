@extends('layouts.base')
<head>
    @if(Auth::user()!=null)
        <script>
            const user={!!$user=Auth::user()!!};
        </script>
    @endif
</head>
<link rel="stylesheet" href="{{asset('/css/races.css')}}">
@section('title', 'Races')

@section('main-content')
    @php(dump($items))
    <div class="product-list">
        <table class="tbl-races">
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Distance</th>
                <th>Date</th>
            </tr>
            @foreach($items as $item)
                <tr>
                    <td style="display: none">{{$item['id']}}</td>
                    <td style="text-align: left">{{$item['name']}}</td>
                    <td style="text-align: left">{{$item['location']}}</td>
                    <td style="text-align: center">{{$item['distance']}}</td>
                    <td style="text-align: center">{{date('Y-m-d', strtotime($item['date']))}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <script src="{{asset('/js/user/races.js')}}"></script>

@endsection