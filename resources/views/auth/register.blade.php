@extends('layouts.base')
@section('nav','注册')
@section('subhead','注 册')
@section('title','注册')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="featured-boxes">
                    <div class="row">
                        <div class="col-sm-6" style="margin:0 auto ;float:none;">
                            <div class="featured-box featured-box-primary align-left mt-xlg">
                                <div class="box-content">
                                    <h4 class="heading-primary text-uppercase mb-md">请填写注册信息</h4>
                                    <form action="{{route('register')}}" id="frmSignIn" method="post">
                                        <input type="hidden" name="_token" value="{{  csrf_token()  }}">
                                        <div class="row">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <label>输入用户名</label>
                                                    <input type="text" name="name" value="{{old('name')}}"
                                                           class="form-control input-lg" placeholder="UserName"
                                                           required autofocus >
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong style="color: #b7281f;">{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <label>输入邮箱</label>
                                                    <input type="text" name="email" value="{{old('email')}}"
                                                           class="form-control input-lg" placeholder="Email">
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                        <strong style="color: #b7281f;">{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <label>输入密码</label>
                                                    <input type="password" name="password" value="{{old('password')}}"
                                                           class="form-control input-lg" placeholder="Password">
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                        <strong style="color: #b7281f;">{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <label>确认密码</label>
                                                    <input type="password" name="password_confirmation"
                                                           value="{{old('password_confirmation')}}"
                                                           class="form-control input-lg"
                                                           placeholder="PasswordConfirmation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="remember-box checkbox">
                                                    <label for="rememberme">
                                                        <input type="checkbox" id="rememberme" name="rememberme">Remember Me
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit" value="注册"
                                                       class="btn btn-primary pull-right mb-xl"
                                                       data-loading-text="Loading...">
                                            </div>
                                            <label class="pull-right">已有账号？<a href="{{route('login')}}">(现在就登录)</a></label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
