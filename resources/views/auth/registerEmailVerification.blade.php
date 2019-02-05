@extends('layouts.base')
@section('nav','注册邮箱验证')
@section('subhead','注册邮箱验证')
@section('title','注册邮箱验证')

@section('content')
    <div class="col-md-10 col-md-offset-1">
        <div class="featured-box featured-box-quaternary featured-box-effect-1">
            <div class="box-content">
                @if(Auth::check()&&Auth::user()->verified==false&&isset($show))
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">{{session('status')}}</div>
                    @endif
                    <h4 class="text-uppercase">邮箱验证</h4>
                    <a href="{{route('register.send.verification')}}" type="button"
                       class="btn btn-info mr-xs mb-sm">发送邮箱验证邮件</a>
                @else
                    <h4 class="text-uppercase">邮箱验证完成</h4>
                    <a href="{{route('users.show',[Auth::user()])}}" type="button"
                       class="btn btn-info mr-xs mb-sm">确定</a>
                @endif
            </div>
        </div>
    </div>
@endsection