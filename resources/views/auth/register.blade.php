@extends('layouts.base')
@section('nav','注册')
@section('subhead','注 册')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="featured-boxes">
                    <div class="row">
                        <div class="col-sm-6" style="margin:0 auto ;float:none;">
                            <div class="featured-box featured-box-primary align-left mt-xlg" style="height: 327px;">
                                <div class="box-content">
                                    <h4 class="heading-primary text-uppercase mb-md">请填写注册信息</h4>
                                    <form action="/" id="frmSignIn" method="post">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>输入用户名或Email</label>
                                                    <input type="text" value="" class="form-control input-lg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <a class="pull-right" href="#">(Lost Password?)</a>
                                                    <label>Password</label>
                                                    <input type="password" value="" class="form-control input-lg">
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
