<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="{{ url('css/datatables.min.css') }}" rel="stylesheet">
    <title>Sklep Sportowy</title>
  </head>
  <body>
    {{--@include('layouts.navbar')--}}
    @include('layoutsHome.navbar')
    @yield('carusel')
    @yield('content')
    @include('layoutsHome.footer')
    <script src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/datatables.min.js') }}"></script>
    @yield('script')
  </body>
</html>