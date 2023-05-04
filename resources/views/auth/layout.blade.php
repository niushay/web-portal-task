<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{url("assets/images/ico/favicon.png")}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/bootstrap.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/bootstrap-extended.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/colors.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/components.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/themes/dark-layout.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/themes/bordered-layout.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/themes/semi-dark-layout.css")}}">


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/core/menu/menu-types/vertical-menu.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/plugins/forms/form-validation.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/pages/page-auth.css")}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url("assets/css/style.css")}}">
    <!-- END: Custom CSS-->

    <script src="{{url('assets/js/jquery.min.js')}}"></script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v2">
                <div class="auth-inner row m-0">
                    <!-- Left Text-->
                    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                            <img class="img-fluid" src="@yield('cover_image')" alt="Login V2" />
                        </div>
                    </div>
                    <!-- /Left Text-->
                    <!-- Form-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @yield('content')
                        </div>
                    </div>
                    <!-- /Form-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

<!-- BEGIN: Vendor JS-->
<script src="{{url("assets/js/vendors.min.js")}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{url("assets/js/jquery.validate.min.js")}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{url("assets/js/app-menu.js")}}"></script>
<script src="{{url("assets/js/app.js")}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
@yield('page_js')
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->

</html>
