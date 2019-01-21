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
                                <a id="editAvatar" href="javascript:void(0)" onclick="capture(this)"><img
                                            class="icon-featured" src="{{$user->img}}"/></a>
                                <h4 class="text-uppercase"><a href="{{route('users.show',[$user])}}">{{$user->name}}</a>
                                </h4>
                                <hr>
                                <h5>个人简介</h5>
                                <p style="margin: 0px 0px 5px 0px;text-align: left">{{$user->introduction??'这家伙很懒什么都没有'}}</p>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>注册于：</h5>
                                        <p>{{$user->created_at->diffForHumans()}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>活跃于：</h5>
                                        <p>fff</p>
                                    </div>
                                </div>
                                <a class="btn btn-secondary mr-xs mb-sm"><i class="fa fa-plus-square"></i> 关注 Ta</a>
                                <a type="button" class="btn btn-tertiary mr-xs mb-sm"><i class="fa fa-envelope-o"></i>
                                    发私信</a>
                            </div>
                        </div>

                        <div class="featured-box featured-box-secondary featured-box-effect-2">
                            <div class="box-content">

                                <h4>个人资料</h4>
                                <ul id="ulactive" class="nav nav-list mb-xlg">
                                    @auth
                                        @if(Auth::user()->id==$user->id)
                                            <li>
                                                <a id="editBasic" href="javascript:void(0)"
                                                   onclick="capture(this)">基本资料</a>
                                            </li>
                                            <li>
                                                <a id="editPwd" href="javascript:void(0)"
                                                   onclick="capture(this)">修改密码</a>
                                            </li>
                                            <li>
                                                <a id="editAvatar" href="javascript:void(0)" onclick="capture(this)">上传头像</a>
                                            </li>
                                            <li>
                                                <a id="editAvatar" href="javascript:void(0)" onclick="capture(this)">消息通知</a>
                                            </li>
                                        @endif
                                    @endauth
                                    <li>
                                        <a id="#" href="javascript:void(0)"
                                           onclick="capture(this)">Ta 的公开资料</a>
                                    </li>
                                    <li>
                                        <a id="#" href="javascript:void(0)"
                                           onclick="capture(this)">Ta 发布的文章</a>
                                    </li>
                                    <li>
                                        <a id="#" href="javascript:void(0)"
                                           onclick="capture(this)">Ta 发布的问答</a>
                                    </li>
                                    <li>
                                        <a id="#" href="javascript:void(0)"
                                           onclick="capture(this)">Ta 发表的回复</a>
                                    </li>
                                    <li>
                                        <a id="#" href="javascript:void(0)"
                                           onclick="capture(this)">Ta 关注的用户</a>
                                    </li>
                                    <li>
                                        <a id="zan" href="javascript:void(0)"
                                           onclick="ck(this)">Ta 点赞的文章</a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </aside>
                </div>
            </div>
            <div class="col-md-9">
                <div class="featured-box featured-box-primary" style="min-height:865px;*height:100%;_height:400px;">
                    <div id="edit" class="box-content">
                        <div class="col-md-12">

                            <h4>发布的话题</h4>
                            @if(count($topics)>0)
                                <ul class="list list-icons list-primary">
                                    @foreach($topics as $topic)
                                        <li class="appear-animation animated fadeInUp appear-animation-visible "
                                            data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                            style="text-align:left">
                                            <i class="fa fa-check"></i>
                                            <a href="{{$topic->link()}}">{{$topic->title}}</a>
                                            <span style="float:right">
                                            <span class="appear-animation animated fadeInUp appear-animation-visible "
                                                  data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                {{$topic->reply_count}} 回复
                                            </span>
                                            -
                                            <span class="appear-animation animated fadeInUp appear-animation-visible "
                                                  data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                {{$topic->created_at->diffForHumans()}}
                                            </span>
                                        </span>
                                        </li>
                                        <hr>
                                    @endforeach
                                    {{$topics->links()}}
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function ck(data) {
            all = $("#ulactive").children('li');
            all.removeClass('active');
            let li = $(data).parent();
            li.addClass('active');
        }

        @auth
        function capture(data) {
            all = $("#ulactive").children('li');
            all.removeClass('active');
            let li = $(data).parent();
            li.addClass('active');

            axios.post('{{route('users.edit',[$user])}}', {
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
                    } else if (error.response.status === 403) {
                        swal({
                            text: '您没有权限进行此项错作哦',
                            icon: 'error',
                            button: '确定',
                        })
                    }
                });
        }
        @endauth
    </script>
@endsection