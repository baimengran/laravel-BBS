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

                        <div class="featured-box featured-box-primary featured-box-effect-6">
                            <div class="box-content">
                                <a id="editAvatar" href="javascript:void(0)" onclick="capture(this)"><img class="icon-featured" src="{{$user->img}}"/></a>
                                <h4 class="text-uppercase">{{$user->name}}</h4>
                                <hr>
                                <h5 style="margin:0px 0px 5px 0px;text-align: left">个人简介</h5>
                                <p style="margin: 0px 0px 5px 0px;text-align: left">{{$user->introduction??'这家伙很懒什么都没有'}}</p>
                                <hr>
                                <h5 style="margin: 0px 0px 5px 0px;text-align: left">注册于</h5>
                                <p style="margin: 0px 0px 5px 0px;text-align: left">{{$user->created_at->diffForHumans()}}</p>
                                <p><a href="/" class="lnk-primary learn-more">Learn More <i
                                                class="fa fa-angle-right"></i></a></p>
                            </div>
                        </div>

                        <div class="featured-box featured-box-secondary featured-box-effect-2">
                            <div class="box-content">

                                <h4>个人资料</h4>
                                <ul class="nav nav-list mb-xlg">
                                    <li><a id="editBasic" href="javascript:void(0)" onclick="capture(this)">基本资料</a>
                                    </li>
                                    <li><a id="editPwd" href="javascript:void(0)" onclick="capture(this)">修改密码</a></li>
                                    <li><a id="editAvatar" href="javascript:void(0)" onclick="capture(this)">上传头像</a>
                                    </li>
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
                <div class="featured-box featured-box-primary" style="min-height:865px;*height:100%;_height:400px;">
                    <div id="edit" class="box-content">
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>
        function capture(data) {
            // console.log(data.id)
            axios.post('{{route('users.edit',[Auth::user()->id])}}', {
                reque: data.id
            })
                .then(function (response) {

                    $('#edit').empty().append(response.data);
                })
                .catch(function (error) {
                    if (error.response.status === 419 || error.response.status === 404) {
                        swal({
                            text: '页面活动以过期，请刷新页面后重试',
                            icon: 'warning',
                            button: '确定',
                        }).then(function (isconfirm) {
                            if (isconfirm === true) {
                                window.location.reload();
                            }
                        });
                    }
                });
        }


    </script>
@endsection