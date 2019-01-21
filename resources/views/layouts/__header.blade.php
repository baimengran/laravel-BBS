<header id="header"
        data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 57, 'stickySetTop': '-57px', 'stickyChangeLogo': true}">
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-logo">
                        <a href="{{route('home')}}">
                            <img alt="Porto" width="111" height="54" data-sticky-width="82" data-sticky-height="40"
                                 data-sticky-top="33" src="{{asset('images/logo.png')}}">
                        </a>
                    </div>
                </div>
                <div class="header-column">
                    <div class="header-row">
                        <nav class="header-nav-top">
                            @guest
                                <ul class="nav nav-pills">
                                    <li class="hidden-xs">
                                        <a href="{{route('register')}}"><i class="fa fa-angle-right"></i> 注册</a>
                                    </li>
                                    <li class="hidden-xs">
                                        <a href="{{route('login')}}"><i class="fa fa-angle-right"></i> 登录</a>
                                    </li>
                                </ul>
                            @else
                                <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
                                    <nav>
                                        <ul class="nav nav-pills" id="mainNav">
                                            <li class="dropdown dropdown-mega dropdown-mega-signin signin logged"
                                                id="headerAccount">
                                                <a class="dropdown-toggle"
                                                   href="{{route('users.show',[Auth::user()])}}">
                                                    <i class="fa fa-user"></i> {{Auth::user()->name}}
                                                    <i class="fa fa-caret-down"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <div class="dropdown-mega-content">

                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="user-avatar">
                                                                        <div class="img-thumbnail">
                                                                            <img src="{{Auth::user()->img}}"
                                                                                 alt="">
                                                                        </div>
                                                                        <p><strong>{{Auth::user()->name}}</strong></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <ul class="list-account-options">
                                                                        <li>
                                                                            <a href="{{route('users.show',[Auth::user()])}}">个人中心</a>
                                                                        </li>
                                                                        <li>
                                                                            <form id="logout"
                                                                                  action="{{ route('logout') }}"
                                                                                  method="POST">
                                                                                {{ csrf_field() }}
                                                                            </form>
                                                                            <a href="#" class="btn"
                                                                               onclick="$('#logout').submit()"
                                                                               role="button">退出</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                        </nav>

                        @endguest
                    </div>
                    <div class="header-row">
                        <div class="header-nav">
                            {{--导航图标开始--}}
                            <ul class="header-social-icons social-icons hidden-xs">
                                <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank"
                                                                     title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank"
                                                                    title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank"
                                                                     title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                            {{--导航图标结束--}}

                            <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
                                <nav>
                                    <ul class="nav nav-pills" id="mainNav">

                                        <li class="{{active_class(if_route('home'))}}">
                                            <a href="{{route('home')}}">Home</a>
                                        </li>


                                        {{--简单导航开始--}}
                                        <li class="dropdown dropdown-full-color dropdown-primary dropdown-mega ">
                                            <a class="dropdown-toggle " href="#">
                                                预留导航1
                                                <i class="fa fa-caret-down"></i></a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <div class="dropdown-mega-content">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <span class="dropdown-mega-sub-title ">简单导航 1</span>
                                                                <ul class="dropdown-mega-sub-nav">
                                                                    <li class="active">
                                                                        <a href="#">选项</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <span class="dropdown-mega-sub-title">简单导航 2</span>
                                                                <ul class="dropdown-mega-sub-nav">
                                                                    <li><a href="#">选项</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <span class="dropdown-mega-sub-title">简单导航 3</span>
                                                                <ul class="dropdown-mega-sub-nav">
                                                                    <li><a href="#l">选项</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <span class="dropdown-mega-sub-title">简单导航 4</span>
                                                                <ul class="dropdown-mega-sub-nav">
                                                                    <li><a href="#">选项</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        {{--简单导航结束--}}

                                        {{--橙色多级导航开始--}}
                                        <li class="dropdown dropdown-full-color dropdown-secondary {{active_class(if_route('topics.index')||if_route('categories.show'))}}">
                                            <a class="dropdown-toggle" href="{{route('topics.index')}}">
                                                话题
                                                <i class="fa fa-caret-down"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                {{--//{{dd($categories)}}--}}
                                                @if(isset($categoryTree))
                                                    @foreach($categoryTree as $categories)
                                                        @each('layouts.__category_list',$categories,'category')
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                        {{--橙色多级导航结束--}}

                                        {{--蓝色多级导航开始--}}
                                        <li class="dropdown dropdown-full-color dropdown-tertiary ">
                                            <a class="dropdown-toggle" href="#">
                                                预留导航3
                                                <i class="fa fa-caret-down"></i></a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-submenu ">
                                                    <a class="" href="#">选项1<i class="fa fa-caret-down"></i></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">选项1-1</a></li>
                                                    </ul>
                                                </li>

                                                <li class="dropdown-submenu">
                                                    <a href="#">选项2<i class="fa fa-caret-down"></i></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">选项2-1</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        {{--蓝色多级导航结束--}}

                                        {{--黑色多级导航开始--}}
                                        <li class="dropdown dropdown-full-color dropdown-quaternary">
                                            <a class="dropdown-toggle" href="#">
                                                预留导航4
                                                <i class="fa fa-caret-down"></i></a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-submenu">
                                                    <a href="#">选项1<i class="fa fa-caret-down"></i></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">选项1-1</a></li>
                                                        <li><a href="#">选项1-2</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        {{--黑色多级导航结束--}}

                                        {{--蓝色白底简单导航开始--}}
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" href="#">
                                                预留导航5
                                                <i class="fa fa-caret-down"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">选项1</a></li>
                                            </ul>
                                        </li>
                                        {{--蓝色白底简单导航结束--}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
