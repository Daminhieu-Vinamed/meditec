<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dist/images/favicon.png')}}">
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('dist/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
    <title> @yield('title')</title>
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        @include('layout.header')
        @yield('content')
    </div>
    <script src="{{ asset('dist/js/swalalert2@11.js') }}"></script>
    <script src="{{ asset('dist/js/notification.js') }}"></script>
    <script src="{{asset('dist/js/jquery.min.js')}}"></script>
    <script src="{{asset('dist/js/custom.min.js')}}"></script>
    <script src="{{asset('dist/js/waves.js')}}"></script>
    <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('dist/js/select2.min.js') }}"></script>
    @stack('js')
</body>
</html>