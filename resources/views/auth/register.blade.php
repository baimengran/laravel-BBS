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
                                    <div id="email" class="show">
                                        <h4 class="heading-primary text-uppercase mb-md">请填写注册信息</h4>
                                        <form action="{{route('register')}}" id="frmSignIn" method="post"
                                              style="padding:20px">
                                            <input type="hidden" name="_token" value="{{  csrf_token()  }}">
                                            <div class="row">
                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <div class="col-md-12">
                                                        <label>输入用户名</label>
                                                        <input type="text" name="name" value="{{old('name')}}"
                                                               class="form-control input-lg" placeholder="UserName"
                                                               required autofocus>
                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                                            <strong style="color: #b7281f;">{{ $errors->first('name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <div class="col-md-12">
                                                        <label>输入邮箱</label>
                                                        <input type="text" name="email" value="{{old('email')}}"
                                                               class="form-control input-lg" placeholder="Email"
                                                               required>
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
                                                        <input type="password" name="password" value=""
                                                               class="form-control input-lg" placeholder="Password"
                                                               required>
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                        <strong style="color: #b7281f;">{{ $errors->first('password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                    <div class="col-md-12">
                                                        <label>确认密码</label>
                                                        <input type="password" name="password_confirmation"
                                                               value=""
                                                               class="form-control input-lg"
                                                               placeholder="PasswordConfirmation" required>
                                                        @if ($errors->has('password_confirmation'))
                                                            <span class="help-block">
                                                        <strong style="color: #b7281f;">{{ $errors->first('password_confirmation') }}</strong>
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
                                                        <input type="checkbox" id="rememberme" name="rememberme">Remember Me
                                                    </label>
                                                </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="submit" value="注册"
                                                           class="btn btn-primary pull-right mb-xl"
                                                           data-loading-text="Loading...">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="phone" class="hidden">
                                        <h4 class="heading-primary text-uppercase mb-md">请填写注册信息</h4>

                                        <div class="row">
                                            <div class="form-group phone{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <label>输入手机号</label>
                                                    <input type="text" name="phone" value="{{old('phone')}}"
                                                           class="form-control input-lg" placeholder="Phone"
                                                           required autofocus>
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
                                                <input type="button" value="注册"
                                                       class="btn btn-primary center-block mb-xl"
                                                       data-loading-text="Loading..."
                                                       style="width: 200px;height: 50px;margin-top:20px;"
                                                       onclick="register()">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row" style="margin: 0px 20px 0px 20px;">
                                        <label>
                                            <a href="javascript:void(0)" id="email-click" class="hidden">邮箱注册</a>
                                            <a href="javascript:void(0)" id="phone-click"
                                               class="show-grid-block">手机注册</a>&nbsp&nbsp
                                            <a>第三方登录</a>
                                        </label>

                                        <label class="pull-right">已有账号？<a
                                                    href="{{route('login')}}">(现在就登录)</a></label>
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

        $("#phone-click").on('click', function () {
            $("#email").attr('class', 'hidden');
            $("#phone").attr('class', 'show');
            $("#phone-click").attr('class', 'hidden');
            $("#email-click").attr('class', 'show-grid-block')
        });

        $("#email-click").on('click', function () {
            $("#email").attr('class', 'show');
            $("#phone").attr('class', 'hidden');
            $("#phone-click").attr('class', 'show-grid-block');
            $("#email-click").attr('class', 'hidden')
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

                axios.post('{{route('register.phone.send.code')}}', formData)
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

        //注册
        function register() {
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
                axios.post('{{route('register.phone.store')}}', formData)
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
