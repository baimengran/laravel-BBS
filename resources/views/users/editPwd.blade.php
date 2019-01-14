<h4 class="text-uppercase" style="padding-bottom: 10%">修改密码</h4>
<form class="form-horizontal form-bordered" action="{{route('login')}}" id="frmSignIn" method="post">

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>用户名</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger"><i class="fa fa-user"></i></span>
                <input type="text" name="name" value="{{$user->name}}" class="form-control input-lg" placeholder="user name">
                @if ($errors->has('name'))
                    <span class="help-block">
                                <strong style="color: #b7281f;">{{ $errors->first('name') }}</strong>
                            </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>邮箱</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger">@</span>
                <input type="text" name="email" value="{{$user->email}}" class="form-control input-lg" placeholder="" readonly="readonly">
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('originalPassword') ? ' has-error' : '' }}" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>原密码</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger"><i class="fa fa-key"></i></span>
                <input type="text" name="originalPassword" value="" class="form-control input-lg" placeholder="original password">
                @if ($errors->has('originalPassword'))
                    <span class="help-block">
                                <strong style="color: #b7281f;">{{ $errors->first('originalPassword') }}</strong>
                            </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>新密码</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger"><i class="fa fa-key"></i></span>
                <input type="text" name="password" value="" class="form-control input-lg"
                       placeholder="new password">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                                <strong style="color: #b7281f;">{{ $errors->first('password') }}</strong>
                            </span>
                @endif
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary mr-xs mb-sm">提交修改</button>
</form>




