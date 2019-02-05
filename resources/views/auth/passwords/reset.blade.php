@extends('layouts.base')
@section('nav','找回密码')
@section('subhead','找回密码')
@section('title','找回密码')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="featured-boxes">
                    <div class="row">
                        <div class="col-sm-6" style="margin:0 auto ;float:none;">
                            <div class="featured-box featured-box-primary align-left mt-xlg">
                                <div class="box-content">
                                    <h4 class="heading-primary text-uppercase mb-md">找回密码</h4>
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form class="form-horizontal" method="POST"
                                          action="{{ route('password.request') }}">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="row">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <label for="email">邮箱</label>
                                                    <input id="email" type="text" name="email"
                                                           value="{{$email or old('email')}}"
                                                           class="form-control input-lg" required autofocus>
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
                                                    <label for="password">密码</label>
                                                    <input id="password" type="password" class="form-control input-lg"
                                                           name="password" required>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <label for="password-confirm">确认密码</label>
                                                    <input id="password-confirm" type="password"
                                                           class="form-control input-lg"
                                                           name="password_confirmation" required>
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    密码重置
                                                </button>
                                            </div>
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
