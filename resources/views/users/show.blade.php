@extends('layouts.base')
@section('nav','个人中心')
@section('subhead','个人中心')
@section('title','个人中心')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <div class="pin-wrapper">
                    <aside class="sidebar" id="sidebar" data-plugin-sticky=""
                           data-plugin-options="{'minWidth': 991, 'containerSelector': '.container', 'padding': {'top': 110}}"
                           style="width: 262.5px;">

                        <div class="featured-box featured-box-primary featured-box-effect-1" style="height: 358px;">
                            <div class="box-content">
                                <a href="#"><i class="icon-featured fa fa-user"></i></a>
                                <h4 class="text-uppercase">{{Auth::user()->name}}</h4>
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
                                <p><a href="/" class="lnk-primary learn-more">Learn More <i
                                                class="fa fa-angle-right"></i></a></p>
                            </div>
                        </div>

                        <div class="featured-box featured-box-secondary featured-box-effect-2">
                            <div class="box-content">

                                <h4>个人资料</h4>
                                <ul class="nav nav-list mb-xlg">
                                    <li><a id="edPw" href="javascript:view(0)" onclick="capture(this)">修改密码</a></li>
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
                <div id="edit" class="featured-box featured-box-primary" style="min-height:865px;*height:100%;_height:400px;">
                </div>
            </div>

        </div>

    </div>
    <script>
        function capture(data) {
            console.log(data.id)
            axios.post('{{route('users.edit',[Auth::user()])}}', {
                reque: data.id
            })
                .then(function (response) {

                    $('#edit').empty().append(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    </script>
@endsection