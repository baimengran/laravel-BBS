@extends('layouts.base')
@section('nav','登录')
@section('subhead','登 录')
@section('title','登录')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="featured-boxes">
                    <div class="row">
                        <div class="col-sm-6" style="margin:0 auto ;float:none;">
                            <div class="featured-box featured-box-primary align-left mt-xlg">
                                <div class="box-content">
                                    <h4 class="heading-primary text-uppercase mb-md">请登录</h4>
                                    <div style="text-align:center"><strong style="color:#b7281f;">{{session()->get('error')}}</strong></div>


                                    <form action="{{route('login')}}" id="frmSignIn" method="post">

                                        <div class="row">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <label>邮箱</label>
                                                    <input type="text" name="email" value="{{old('email')}}"
                                                           class="form-control input-lg" required autofocus
                                                           >
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
                                                    <a class="pull-right" href="{{route('password.request')}}">(忘记密码?)</a>
                                                    <label>密码</label>
                                                    <input type="password" name="password" value=""
                                                           class="form-control input-lg" required >
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong style="color: #b7281f;">{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
															<span class="remember-box checkbox">
																<label for="rememberme">
																	<input type="checkbox" id="rememberme"
                                                                           name="rememberme">Remember Me
																</label>
															</span>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit" value="Login"
                                                       class="btn btn-primary pull-right mb-xl"
                                                       data-loading-text="Loading...">

                                            </div>
                                            <label class="pull-right">还没有账号？<a href="{{route('register')}}">(现在注册)</a></label>
                                        </div>
                                        {{csrf_field()}}
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