@extends('layouts.base')
@section('title','403')
@section('subhead','权限错误')

@section('content')
<div class="container">
    <section class="page-not-found">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                <div class="page-not-found-main">
                    <h2>403 <i class="fa fa-file"></i></h2>
                    <p>您当前没有操作此页面的权限</p>
                </div>
            </div>
            <div class="col-md-4">
                <h4 class="heading-primary">这里有一些有用的连接</h4>
                <ul class="nav nav-list">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('about')}}">关于</a></li>
                    <li><a href="{{route('help')}}}">FAQ's</a></li>
                    <li><a href="{{route('login')}}">登录</a></li>
                    <li><a href="{{route('register')}}">注册</a></li>
                </ul>
            </div>
        </div>
    </section>

</div>
    @endsection()