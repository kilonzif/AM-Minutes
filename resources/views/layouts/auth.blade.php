<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'AM')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
          rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors.css') }}">
@stack('css-vendors')
{{--<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/icheck/icheck.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/icheck/custom.css') }}">--}}
<!-- END VENDOR CSS-->

    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/apps.css') }}">
@stack('css-plugins')
<!-- END STACK CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/login-register.css') }}">
    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- END Custom CSS-->

    <!-- Jquery-->
    <script src="{{ asset('vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- Jquery Ends-->
</head>
<body>
<div id="app">
    @yield('content')
</div>

<!-- ////////////////////////////////////////////////////////////////////////////-->
<!-- BEGIN VENDOR JS-->
@stack('vendors-scripts')
<!-- BEGIN VENDOR JS-->

<!-- BEGIN STACK JS-->
<script src="{{ asset('js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/core/app.js') }}" type="text/javascript"></script>
@stack('core-scripts')
<!-- END STACK JS-->

<!-- BEGIN PAGE LEVEL JS-->
{{--<script src="{{ asset('js/scripts/forms/form-login-register.js') }}" type="text/javascript"></script>--}}
@stack('end-scripts')
<!-- END PAGE LEVEL JS-->
</body>
</html>
