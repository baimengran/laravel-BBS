@extends('layouts.base')
@section('nav','个人中心')
@section('subhead','个人中心')
@section('title','修改密码')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <div class="pin-wrapper" >
                    <aside class="sidebar" id="sidebar" data-plugin-sticky=""
                           data-plugin-options="{'minWidth': 991, 'containerSelector': '.container', 'padding': {'top': 110}}"
                           style="width: 262.5px;">

                        <div class="featured-box featured-box-primary featured-box-effect-1" style="height: 358px;">
                            <div class="box-content">
                                <a href="#"><i class="icon-featured fa fa-user"></i></a>
                                <h4 class="text-uppercase">{{Auth::user()->name}}</h4>
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
                                <p><a href="/" class="lnk-primary learn-more">Learn More <i class="fa fa-angle-right"></i></a></p>
                            </div>
                        </div>

                        <div class="featured-box featured-box-secondary featured-box-effect-2" >
                            <div class="box-content">

                                <h4>个人资料</h4>
                                <ul class="nav nav-list mb-xlg">
                                    <li><a href="{{route('users.edit',Auth::user())}}">修改密码</a></li>
                                    <li class="active">
                                        <a href="#">Photos (4)</a>
                                        <ul>
                                            <li><a href="#">Animals</a></li>
                                            <li class="active"><a href="#">Business</a></li>
                                            <li><a href="#">Sports</a></li>
                                            <li><a href="#">People</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Videos (3)</a></li>
                                    <li><a href="#">Lifestyle (2)</a></li>
                                    <li><a href="#">Technology (1)</a></li>
                                </ul>



                            </div>
                        </div>

                    </aside>
                </div>
            </div>
            <div class="col-md-9">

                <h2>Lorem ipsum dolor</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam
                    posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta
                    tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus.
                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero
                    ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales,
                    nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec
                    scelerisque ligula mollis lobortis.</p>

                <div class="sticky-container">
                    <div class="row">
                        <div class="col-md-8">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque
                                eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia.
                                Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis
                                faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et
                                ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra
                                leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices
                                sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis
                                lobortis.</p>

                        </div>
                        <div class="col-md-4">
                            <div class="pin-wrapper" style="height: 206.609px;">
                                <div class="center" data-plugin-sticky=""
                                     data-plugin-options="{'minWidth': 991, 'containerSelector': '.sticky-container', 'padding': {'top': 110}}"
                                     style="width: 262.484px;">
                                    <img class="pull-right img-responsive" width="300" height="211" src="img/device.png"
                                         alt="">
                                    <strong>(Sticky Within a Container)</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam
                    posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta
                    tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus.
                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero
                    ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales,
                    nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec
                    scelerisque ligula mollis lobortis.</p>

            </div>

        </div>

    </div>
@endsection