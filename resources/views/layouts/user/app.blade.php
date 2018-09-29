<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="ADMASINA.COM - Free ebook download and reads online">
    <meta name="author" content="ADMASINA">
    <meta name="keyword" content="admasina,ebook,free ebook,download ebook">
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
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{route('index')}}">
        <img class="navbar-brand-full" src="{{asset(Config::get('websettings.siteLogo'))}}" width="89" height="25" alt="Logo">
        <img class="navbar-brand-minimized" src="{{asset(Config::get('websettings.siteLogo'))}}" width="30" height="30" alt="ICON">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav ml-auto">
        @if(Auth::check())
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="d-down-none">Logged as</span> <img class="img-avatar" src="{{asset('storage/'.Auth::user()->image)}}" alt="{{Auth::user()->name}}">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>
                <a class="dropdown-item" href="{{route('user.profile.show')}}">
                    <i class="fa fa-user"></i> Profile</a>
                <a class="dropdown-item" href="{{route('user.profile.edit')}}">
                    <i class="fa fa-wrench"></i> Settings</a>
                <a class="dropdown-item" href="{{route('user.password.edit')}}">
                    <i class="fa fa-usd"></i> Change Password
                </a>
                <div class="divider"></div>
                <a class="dropdown-item" href="javascript:void(0)" id="logout-link">
                    <i class="fa fa-lock"></i> Logout</a>
            </div>
        </li>
        @endif
    </ul>

</header>
<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('index')}}">
                        <i class="fa fa-home" style="color: grey"></i> Home
                    </a>
                </li>
         @if(Auth::check())

             @if(Auth::user()->role_id == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.dashboard')}}">
                                <i class="fa fa-user-secret text-muted"></i> Admin
                            </a>
                        </li>
                 @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.profile.show')}}">
                            <i class="fa fa-user text-muted"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.profile.edit')}}">
                            <i class="fa fa-wrench text-muted"></i> Edit Profile
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.password.edit')}}">
                            <i class="fa fa-usd text-muted"></i> Change Password
                        </a>
                    </li>
         @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">
                            <i class="fa fa-lock text-muted"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">
                            <i class="fa fa-user text-muted"></i> Register
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">
                <a href="{{route('user.profile.show')}}">User</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>

        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn"></div>
            @include('layouts.admin.notice')
            @yield('content')
        </div>
    </main>
    <aside class="aside-menu">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">
                    <i class="icon-list"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                    <i class="icon-speech"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                    <i class="icon-settings"></i>
                </a>
            </li>
        </ul>
    </aside>
</div>
<footer class="app-footer">
    <div>
        <a href="{{route('index')}}">{{Config::get('websettings.siteTitle')}}</a>
        <span>&copy; 2018 .</span>
    </div>
</footer>
<!-- CoreUI and necessary plugins-->
<script src="{{asset('assets/admin/node_modules/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/pace-progress/pace.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/@coreui/coreui/dist/js/coreui.min.js')}}"></script>

<script>
    $("#logout-link").click(function () {

        let logoutForm = document.createElement('form'),
            logoutURL = `{{route('logout')}}`,
            csrfInput = document.createElement('input'),
            methodInput = document.createElement('input')
        logoutForm.style.display = 'none';
        logoutForm.method = 'POST'
        logoutForm.action = logoutURL
        csrfInput.name = `_token`
        csrfInput.value = `{{csrf_token()}}`
        methodInput.name = `_method`
        methodInput.value = `POST`
        logoutForm.appendChild(csrfInput)
        logoutForm.appendChild(methodInput)
        document.body.appendChild(logoutForm)
        logoutForm.submit()
    })
</script>
@stack('script')
</body>
</html>
