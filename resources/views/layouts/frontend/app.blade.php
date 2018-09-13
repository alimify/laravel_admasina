<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">


    <!-- Font -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


    <!-- Stylesheets -->

    <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/swiper.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/ionicons.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    @stack('css')
</head>
<body >

<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="{{route('index')}}" class="logo"><img src="images/logos.png" alt="Logo Image"></a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="">BOOK</a></li>
            <li><a href="">ARTICLE</a></li>
            <li><a href="{{route('aboutus')}}">ABOUT US</a></li>
            <li><a href="{{route('privacy')}}">PRIVACY</a></li>
            <li><a href="{{route('contactus')}}">CONTACT US</a></li>
            <li><a href="{{route('language')}}">LANGUAGE</a></li>
        </ul><!-- main-menu -->

        <div class="src-area">
            <form>
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input class="src-input" type="text" placeholder="Type of search">
            </form>
        </div>

    </div><!-- conatiner -->
</header>

@include('layouts.admin.notice')
@yield('content')

<footer>

    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h4 class="font-weight-bold">About US</h4>
                    {!!html_entity_decode(Config::get('system.setting.footeraboutus'))!!}
                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h4 class="title"><b>Useful Links</b></h4>
                    {!!html_entity_decode(Config::get('system.setting.footerusefullinks'))!!}
                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h4 class="title"><b>Social Links</b></h4>
                    {!!html_entity_decode(Config::get('system.setting.footersociallinks'))!!}
                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

        </div><!-- row -->
    </div><!-- container -->
</footer>


<!-- SCIPTS -->

<script src="{{asset('frontend/js/jquery-3.1.1.min.js')}}"></script>

<script src="{{asset('frontend/js/tether.min.js')}}"></script>

<script src="{{asset('frontend/js/bootstrap.js')}}"></script>

<script src="{{asset('frontend/js/swiper.js')}}"></script>

<script src="{{asset('frontend/js/scripts.js')}}"></script>
@stack('script')
</body>
</html>