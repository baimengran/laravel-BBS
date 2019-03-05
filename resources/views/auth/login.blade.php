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
                                    <div style="text-align:center"><strong
                                                style="color:#b7281f;">{{session()->get('error')}}</strong></div>

                                    <div id="email" class="show">
                                        <form action="{{route('login')}}" id="frmSignIn" method="post">

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
                                            <div class="row">
                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <div class="col-md-12">
                                                        <a class="pull-right" href="{{route('password.request')}}">(忘记密码?)</a>
                                                        <label>密码</label>
                                                        <input type="password" name="password" value=""
                                                               class="form-control input-lg" required>
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                            <strong style="color: #b7281f;">{{ $errors->first('password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                                                    <div class="col-md-12">
                                                        <label for="captcha">输入验证码</label>
                                                        <input id="captcha" type="text" name="captcha"
                                                               value=""
                                                               class="form-control input-lg"
                                                               placeholder="Captcha" required>
                                                        <img class="captcha" src="{{captcha_src('flat')}}"
                                                             onclick="this.src='/captcha/flat?'+Math.random()"
                                                             title="点击图片重新获取验证码"
                                                             style="margin-bottom: 0px; margin-top: 10px;cursor: pointer;">
                                                        @if ($errors->has('captcha'))
                                                            <span class="help-block">
                                                        <strong style="color: #b7281f;">{{ $errors->first('captcha') }}</strong>
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

                                            </div>
                                            {{csrf_field()}}
                                        </form>
                                    </div>
                                    <div id="phone" class="hidden">

                                            <div class="row">
                                                <div class="form-group phone{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                    <div class="col-md-12">
                                                        <label>手机号</label>
                                                        <input type="text" name="phone" value="{{old('phone')}}"
                                                               class="form-control input-lg" required autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group captchas{{ $errors->has('captchaPhone') ? ' has-error' : '' }}">
                                                    <div class="col-md-12">
                                                        <label for="captchaPhone">输入验证码</label>
                                                        <input id="captchaPhone" type="text" name="captchaPhone" value=""
                                                               class="form-control input-lg"
                                                               placeholder="Captcha" required>
                                                        <div>
                                                            <div class="float-left">
                                                                <img class="captcha" src="{{captcha_src('flat')}}"
                                                                     onclick="this.src='/captcha/flat?'+Math.random()"
                                                                     title="点击图片重新获取验证码"
                                                                     style="margin-bottom: 0px; margin-top: 10px;cursor: pointer;">

                                                                <button class="btn btn-info mr-xs mb-sm pull-right"
                                                                        style="margin-top:7%; width:200px;height:40px"
                                                                        onclick="sendCode(this)">
                                                                    发送短信验证码
                                                                </button>
                                                            </div>
                                                            <div class="pull-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group phone-code">
                                                    <input type="hidden" name="_token" value="{{  csrf_token()  }}">
                                                    <input class="phone-store" name="phone-store" type="hidden" value="">
                                                    <div class="col-md-12">
                                                        <input type="text" name="code"
                                                               class="phone-code form-control input-lg"
                                                               placeholder="输入4位短信验证码" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="button" value="登录"
                                                           class="btn btn-primary center-block mb-xl"
                                                           data-loading-text="Loading..." style="width: 200px;height: 50px;margin-top:20px;" onclick="login()">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row" style="margin: 0px 20px 0px 20px;">
                                        <label>
                                            <a href="javascript:void(0)" id="email-click" class="hidden">邮箱登录</a>
                                            <a href="javascript:void(0)" id="phone-click"
                                               class="show-grid-block">手机登录</a>&nbsp&nbsp
                                            <a>第三方登录</a>
                                        </label>

                                        <label class="pull-right">还没有账号？<a
                                                    href="{{route('register')}}">(现在注册)</a></label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function(){
            $("#phone-click").on('click',function(){
                $("#email").attr('class','hidden');
                $("#phone").attr('class','show');
                $("#phone-click").attr('class','hidden');
                $("#email-click").attr('class','show-grid-block')
            });

            $("#email-click").on('click',function(){
                $("#email").attr('class','show');
                $("#phone").attr('class','hidden');
                $("#phone-click").attr('class','show-grid-block');
                $("#email-click").attr('class','hidden')
            });
        });

        function sendCode(obj) {
            let formData = new FormData();
            let phone = $('input[name=phone]').val();
            let captcha = $('input[name=captchaPhone]').val();
            $('.phone').removeClass('has-error');
            $('.captchas').removeClass('has-error');
            if (phone.length === 0) {
                $('.phone').addClass('has-error');

            } else if (captcha.length === 0) {
                $('.captchas').addClass('has-error');
            } else {

                formData.append('phone', phone);
                formData.append('captchaPhone', captcha);

                axios.post('{{route('login.phone.send.code')}}', formData)
                    .then(function (response) {
                        //按钮倒计时
                        let count = 60;
                        const countDown = setInterval(() => {
                            if (count === 0) {
                                $(obj).text('重新发送').removeAttr('disabled');
                                $(obj).css({
                                    background: '#5bc0de',
                                    color: '#FFF',
                                });
                                clearInterval(countDown);
                            } else {
                                $(obj).attr('disabled', true);
                                $(obj).css({
                                    background: '#d8d8d8',
                                    color: '#707070',
                                });
                                $(obj).text('重新发送（' + count + '）');
                            }
                            count--;
                        }, 1000);
                        $(".help-block").empty();
                        $(".phone-store").attr('value', '').attr('value', phone);
                        swal({
                            text:'短信服务商欠费啦，您可以使用默认验证码【1234】完成后续操作！',
                            icon:'warning',
                            button:'确定',
                        });
                    }).catch(function (error) {
                    if (error.response.status === 422) {
                        let html1 = "<span class='help-block'><strong style='color: #b7281f;'>";
                        let html2 = "</strong></span>";
                        $(".help-block").empty();

                        $.each(error.response.data, function () {
                            console.log(this.phone)
                            if (this.phone) {
                                $("input[name=phone]").after(html1 + this.phone + html2);
                                $(".phone").addClass(' has-error');
                            } else if (this.captchaPhone) {
                                $("input[name=captchaPhone]").after(html1 + this.captchaPhone + html2);
                                $(".captchas").addClass(' has-error');
                            }
                        });
                    }
                })
            }

        }

        //登录
        function login() {
            let formData = new FormData();
            let phone = $('input[name=phone-store]').val();
            let code = $('input[name=code]').val();
            $('.code').removeClass('has-error');
            console.log(phone)
            if (phone.length === 0) {
                $('.code').addClass('has-error');
            } else {
                formData.append('phone', phone);
                formData.append('code', code);
                console.log('{{session('re_lo_url')}}');
                axios.post('{{route('login.phone')}}', formData)
                    .then(function (response) {
                        console.log('{{session('re_lo_url')}}');
                        let url = "{{session('re_lo_url')}}";
                        if (url!=null) {
                            window.location.replace(url);
                        }else{
                            window.location.reload()
                        }
                    }).catch(function (error) {
                    if (error.response.status === 401) {
                        let html1 = "<span class='help-block'><strong style='color: #b7281f;'>";
                        let html2 = "</strong></span>";
                        $(".help-block").empty();
                        $("input[name=code]").after(html1 + error.response.data + html2);
                        $(".code").addClass(' has-error');
                    }
                })
            }
        }
    </script>
@endsection