<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>About Me | Porto - Responsive HTML5 Template 5.7.2</title>

    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="Porto - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/app.css">
    {{--<script src="js/app.js"></script>--}}
    {{--<script src="js/theme/theme.js"></script>--}}

    {{--<script src="js/vendor/modernizr.min.js"></script>--}}


</head>


<body>
<div class="body">

    @include('layouts.__header')
    <div role="main" class="main">

        <section class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li class="active">@yield('nav')</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h1>@yield('subhead')</h1>
                    </div>
                </div>
            </div>
        </section>
        @yield('content');
    </div>


    @include('layouts.__footer')

</div>
<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/jquery.appear.min.js"></script>
<script src="js/vendor/jquery.easing.min.js"></script>
<script src="js/vendor/jquery-cookie.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/vendor/common.min.js"></script>
<script src="js/vendor/jquery.validation.min.js"></script>
<script src="js/vendor/jquery.easy-pie-chart.min.js"></script>
<script src="js/vendor/jquery.gmap.min.js"></script>
<script src="js/vendor/jquery.lazyload.min.js"></script>
<script src="js/vendor/jquery.isotope.min.js"></script>
<script src="js/vendor/owl.carousel.min.js"></script>
<script src="js/vendor/jquery.magnific-popup.min.js"></script>
<script src="js/vendor/vide.min.js"></script>

{{--<!-- Theme Base, Components and Settings -->--}}
<script src="js/theme/theme.js"></script>

{{--<!-- Theme Initialization Files -->--}}
<script src="js/theme/theme.init.js"></script>
<script src="js/app.js"></script>

</body>
</html>