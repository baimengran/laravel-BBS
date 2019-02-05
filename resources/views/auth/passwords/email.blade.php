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
                                    <div style="text-align:center"><strong
                                                style="color:#b7281f;">{{session()->get('error')}}</strong></div>
                                    <form class="form-horizontal" method="POST"
                                          action="{{ route('password.sendEmail') }}">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <label>邮箱</label>
                                                    <input type="text" name="email" value="{{old('email')}}"
                                                           class="form-control input-lg" required autofocus>
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong style="color: #b7281f;">{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    发送密码重置邮箱链接
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
