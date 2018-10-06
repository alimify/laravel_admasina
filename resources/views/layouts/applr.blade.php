<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Icons-->
    <link href="{{asset('assets/admin/node_modules/@coreui/icons/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/node_modules/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/node_modules/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/node_modules/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/vendors/pace-progress/css/pace.min.css')}}" rel="stylesheet">
    @stack('css')
</head>
<body class="app flex-row align-items-center">

@yield('content')
<!--
<footer class="app-footer">
    <div>
        <a href="{{route('index')}}">{{Config::get('websettings.siteTitle')}}</a>
        <span>&copy; 2018 .</span>
    </div>
</footer>
-->
<script src="{{asset('assets/admin/node_modules/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/pace-progress/pace.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/@coreui/coreui/dist/js/coreui.min.js')}}"></script>

@stack('script')
</body>
