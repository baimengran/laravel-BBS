@extends('layouts.base')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="featured-boxes">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="featured-box featured-box-primary align-left mt-xlg" style="height: 327px;">
                                <div class="box-content">
                                    <h4 class="heading-primary text-uppercase mb-md">I'm a Returning Customer</h4>
                                    <form action="/" id="frmSignIn" method="post">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Username or E-mail Address</label>
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
																	<input type="checkbox" id="rememberme" name="rememberme">Remember Me
																</label>
															</span>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit" value="Login" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-sm-6">--}}
                            {{--<div class="featured-box featured-box-primary align-left mt-xlg" style="height: 327px;">--}}
                                {{--<div class="box-content">--}}
                                    {{--<h4 class="heading-primary text-uppercase mb-md">Register An Account</h4>--}}
                                    {{--<form action="/" id="frmSignUp" method="post">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<div class="col-md-12">--}}
                                                    {{--<label>E-mail Address</label>--}}
                                                    {{--<input type="text" value="" class="form-control input-lg">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<label>Password</label>--}}
                                                    {{--<input type="password" value="" class="form-control input-lg">--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<label>Re-enter Password</label>--}}
                                                    {{--<input type="password" value="" class="form-control input-lg">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-12">--}}
                                                {{--<input type="submit" value="Register" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
