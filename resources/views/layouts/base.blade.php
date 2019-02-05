<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title','Blog')</title>

    <meta name="keywords" content="laravel-Blog"/>
    <meta name="description" content="@yield('description','laravel-Blog')"/>
    <meta name="author" content="13466320356@sina.com"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="{{asset('images/apple-touch-icon.png')}}">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    {{--token--}}
    <meta name="csrf-token" content="{{  csrf_token()  }}">
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{--<script src="js/app.js"></script>--}}
    {{--<script src="js/theme/theme.js"></script>--}}

    {{--<script src="js/vendor/modernizr.min.js"></script>--}}
    <script src="{{asset('js/vendor/jquery.js')}}"></script>
    @yield('styles')

</head>


<body>
<div class="body">

    @include('layouts.__header')
    <div role="main" class="main {{route_class().'-page'}}">

        <section class="page-header page-header-color page-header-quaternary page-header-more-padding" style="background-color: #060606;
                 border-bottom-color: #357dbb">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>@yield('subhead')</h1>
                        <ul class="breadcrumb breadcrumb-valign-mid">
                            <li><a href="#">home</a></li>
                            <li class="active">@yield('nav')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        @if(Auth::check()&&Auth::user()->verified==false)
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <strong>注册成功，验证邮件已发送到您的邮箱，请尽快验证！如果您未收到邮件请点击
                        <a href="{{route('register.show.verification')}}">手动验证</a>发送邮件到您的邮箱。
                    </strong>
                </div>
            </div>
        @endif
        @yield('content')
    </div>


    @include('layouts.__footer')

</div>

<script src="{{asset('js/vendor/jquery.appear.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery-cookie.min.js')}}"></script>
<script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('js/vendor/common.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery.validation.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery.easy-pie-chart.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery.gmap.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery.lazyload.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery.isotope.min.js')}}"></script>
<script src="{{asset('js/vendor/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/vendor/vide.min.js')}}"></script>

{{--<!-- Theme Base, Components and Settings -->--}}
<script src="{{asset('js/theme/theme.js')}}"></script>

{{--<!-- Theme Initialization Files -->--}}
<script src="{{asset('js/theme/theme.init.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
@yield('scripts')

</body>
</html>