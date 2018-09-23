<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="{{Config::get('websettings.siteTitle')}} not found">
    <meta name="author" content="Zemenfes">
    <meta name="keyword" content="not,found">
    <title>404 ! not found</title>
    <!-- Icons-->
    <link href="{{asset('assets/admin/node_modules/@coreui/icons/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/node_modules/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/node_modules/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/node_modules/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/vendors/pace-progress/css/pace.min.css')}}" rel="stylesheet">
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('search')}}" method="get">
            <div class="clearfix">
                <h1 class="float-left display-3 mr-4">404</h1>
                <h4 class="pt-3">Oops! You're lost.</h4>
                <p class="text-muted">The page you are looking for was not found.</p>
            </div>
            <div class="input-prepend input-group">
                <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fa fa-search"></i>
              </span>
                </div>

                <input class="form-control form-inline" id="prependedInput" size="16" type="text" placeholder="What are you looking for?" name="q">
                <span class="input-group-append">
                <input class="btn btn-info form-inline" type="submit" value="SEARCH">
                </span>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('assets/admin/node_modules/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/pace-progress/pace.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/admin/node_modules/@coreui/coreui/dist/js/coreui.min.js')}}"></script>
</body>
</html>
