<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{mix('css/base.css')}}">
    <link rel="stylesheet" href="{{asset('/css/font-awesome.css')}}">
    @section('meta')
        @show

    <body>
    <div id="modal">
        <div id="modal-content"></div>
    </div>
    <div class="wrapper">
        @include('header')
        @include('topnav')

        <main class="content">
                @section('main-content')
                @show
        </main>

        <footer>
            @include('utils.author_logo')
            <span style="line-height: 55px">Copyright &copy; {{date("Y")}}</span>
        </footer>
    </div>
    </body>

    <script type="application/javascript" src="{{asset('js/jquery-3.2.1.js')}}"></script>
</html>
