
    <div class="box-content">
        <h4 class="text-uppercase" style="padding-bottom: 10%">修改密码</h4>
        <form class="form-horizontal form-bordered" action="{{route('login')}}" id="frmSignIn" method="post">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="padding-bottom: 1%">
                <label class="col-md-3 control-label"><strong>用户名</strong></label>
                <div class="col-md-6">
                    <div class="input-group input-group-lg mb-md">
                        <span class="input-group-addon btn-danger"><i class="fa fa-user"></i></span>
                        <input  type="text" name="name" value="" class="form-control input-lg" placeholder="Left icon">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong style="color: #b7281f;">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group" style="padding-bottom: 3%">
                <label class="col-md-3 control-label"><strong>邮箱</strong></label>
                <div class="col-md-6">
                    <div class="input-group input-group-lg mb-md">
                        <span class="input-group-addon btn-danger">@</span>
                        <input type="text"  value="" class="form-control input-lg" placeholder="Left icon" readonly="readonly">
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="padding-bottom: 1%">
                <label class="col-md-3 control-label"><strong>密码</strong></label>
                <div class="col-md-6">
                    <div class="input-group input-group-lg mb-md">
                        <span class="input-group-addon btn-danger"><i class="fa fa-key"></i></span>
                        <input type="text" name="name" value="" class="form-control input-lg" placeholder="Left icon">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong style="color: #b7281f;">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" style="padding-bottom: 1%">
                <label class="col-md-3 control-label"><strong>确认密码</strong></label>
                <div class="col-md-6">
                    <div class="input-group input-group-lg mb-md">
                        <span class="input-group-addon btn-danger"><i class="fa fa-key"></i></span>
                        <input type="text" name="password_confirmation" value="" class="form-control input-lg" placeholder="Left icon">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong style="color: #b7281f;">{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary mr-xs mb-sm">提交修改</button>
        </form>
    </div>




