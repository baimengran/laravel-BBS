@extends('layouts.base')
@section('nav','权限控制')
@section('subhead','权限控制')
@section('title','无权访问')

@section('content')
    <div class="col-md-10 col-md-offset-1">
        <div class="featured-box featured-box-quaternary featured-box-effect-1">
            <div class="box-content">
                @auth
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-warning"></i> <strong>警告！</strong>您当前帐户无权访问此页面。
                    </div>
                @else
                    <h4 class="text-uppercase">请先登录再操作</h4>
                    <a href="{{route('login')}}" type="button" class="btn btn-info mr-xs mb-sm">登录</a>
                @endauth
            </div>
        </div>
    </div>
@endsection
