<h4 class="text-uppercase" style="padding-bottom: 10%">修改密码</h4>
<form class="form-horizontal form-bordered" action="" id="resetPassword" method="post">

    {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="padding-bottom: 1%">--}}
    {{--<label class="col-md-3 control-label"><strong>用户名</strong></label>--}}
    {{--<div class="col-md-6">--}}
    {{--<div class="input-group input-group-lg mb-md">--}}
    {{--<span class="input-group-addon btn-danger"><i class="fa fa-user"></i></span>--}}
    {{--<input type="text" name="name" value="{{$user->name or old('name')}}" class="form-control input-lg" placeholder="user name">--}}
    {{--@if ($errors->has('name'))--}}
    {{--<span class="help-block">--}}
    {{--<strong style="color: #b7281f;">{{ $errors->first('name') }}</strong>--}}
    {{--</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    <div id="resetSend" hidden class="alert alert-success" role="alert">

    </div>
    <div id="resetFailed" hidden class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong></strong>
    </div>
    <div class="form-group" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>邮箱</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger">@</span>
                <input type="text" name="email" value="{{$user->email}}" class="form-control input-lg" placeholder="">
            </div>
        </div>
        <button id="seedPasswordReset" type="button" class="btn btn-primary mr-xs mb-sm" style="margin: 5px 0 0 -15%">
            邮箱验证
        </button>
    </div>

    <div class="form-group token" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>邮箱验证码</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger"><i class="fa fa-key"></i></span>
                <input type="text" name="token" value="" class="form-control input-lg"
                       placeholder="请输入您接收邮件的验证码">
            </div>
            <span class="help-block">
                <strong style="color: #b7281f;">{{ $errors->first('originalPassword') }}</strong>
            </span>
        </div>
    </div>

    <div class="form-group password" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>新密码</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger"><i class="fa fa-key"></i></span>
                <input type="password" name="password" value="" class="form-control input-lg"
                       placeholder="">

            </div>
            <span class="help-block">
                <strong style="color: #b7281f;"></strong>
            </span>
        </div>
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>确认新密码</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger"><i class="fa fa-key"></i></span>
                <input type="password" name="password_confirmation" value="" class="form-control input-lg"
                       placeholder="">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong style="color: #b7281f;">{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <button id="seedResetPassword" type="button" class="btn btn-primary mr-xs mb-sm">重置密码</button>
</form>

<script>
    $('#seedPasswordReset').on('click', function () {
        let data = new FormData(document.getElementById('resetPassword'));
        axios.post('{{route('password.sendEmail')}}', data)
            .then(function (response) {
                console.log(response.data)
                if (response.data.resetPasswordStatus) {
                    $('#resetSend').empty().html(response.data.resetPasswordStatus).show()
                } else {
                    $('#resetFailed strong').empty().html(response.data.resetPasswordStatus).show()
                }
            });
    });

    $('#seedResetPassword').on('click', function () {
        let data = new FormData(document.getElementById('resetPassword'));
        console.log(data.get('password'));
        console.log(data.get('token'));
        axios.post('{{route('password.reset')}}', data)
            .then(function (response) {
                if (response.data.resetPassword) {
                    swal({
                        text: response.data.resetPassword,
                        icon: 'success',
                        button: '确定',
                    }).then(function (isConfirm) {
                        location.reload();
                    })
                }else if(response.data.resetFailedPassword){
                    swal({
                        text: response.data.resetFailedPassword,
                        icon: 'success',
                        button: '确定',
                    }).then(function (isConfirm) {

                    })
                }
            }).catch(function (error) {
            if (error.response.status === 419 || error.response.status === 404) {
                swal({
                    text: '当前页面以过期，请刷新页面登录后重试',
                    icon: 'warning',
                    button: '确定',
                }).then(function (isConfirm) {
                    location.reload();
                });
            } else if (error.response.status === 422) {
                if (error.response.data.errors.password) {
                    $('.form-group.password').addClass('has-error');
                    $('.form-group.password .help-block').empty().html(error.response.data.errors.password);
                } else {
                    $('.form-group.password').removeClass('has-error');
                    $('.form-group.password .help-block').empty();
                }
                if (error.response.data.errors.token) {
                    $('.form-group.token').addClass('has-error');
                    $('.form-group.token .help-block').empty().html(error.response.data.errors.token);
                }
            }
        });
    });
</script>


