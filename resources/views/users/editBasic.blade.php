<h4 class="text-uppercase" style="padding-bottom: 10%">基本资料修改</h4>
<form class="form-horizontal form-bordered" action="" id="frmSignIn" method="post">
    <input type="hidden" name="_method" value="PUT">
    <div id="name" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><label style="color: #c10000;">*</label><strong>用户名</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md naerr">
                <span class="input-group-addon btn-danger"><i class="fa fa-user"></i></span>
                <input type="text" name="name" value="{{$user->name}}" class="form-control input-lg"
                       placeholder="UserName" required>
                <span class="help-block">
                                <strong style="color: #b7281f;"></strong>
                            </span>
            </div>
        </div>
    </div>
    <div class="form-group" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><label style="color: #c10000;">*</label><strong>E-Mail</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger">@</span>
                <input type="text" name="email" value="{{$user->email}}" class="form-control input-lg"
                       placeholder="E-Mail" readonly="readonly">
            </div>
        </div>
    </div>
    <div id="phone" class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>电话</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md pherr">
                <span class="input-group-addon btn-danger"><i class="fa fa-phone"></i></span>
                <input type="text" name="phone" value="{{$user->phone}}" class="form-control input-lg"
                       placeholder="Phone">

            </div>
        </div>
    </div>
    <div class="form-group" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>简介</strong></label>
        <div class="col-md-6">
            {{--<div class="input-group input-group-lg mb-md">--}}
            {{--<span class="input-group-addon btn-danger">@</span>--}}
            <textarea placeholder="Introduction" class="form-control" name="introduction" rows="3"
                      id="textareaDefault">{{$user->introduction}}</textarea>
            {{--</div>--}}
        </div>
    </div>

    <div class="form-group" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>公司</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger"><i class="fa fa-building-o"></i></span>
                <input type="text" name="company" value="{{$user->company}}" class="form-control input-lg"
                       placeholder="Company">
            </div>
        </div>
    </div>
    <div class="form-group" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>任职</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger"><i class="fa fa-suitcase"></i></span>
                <input type="text" name="position" value="{{$user->position}}" class="form-control input-lg"
                       placeholder="Position">
            </div>
        </div>
    </div>
    <div class="form-group" style="padding-bottom: 1%">
        <label class="col-md-3 control-label"><strong>工作地点</strong></label>
        <div class="col-md-6">
            <div class="input-group input-group-lg mb-md">
                <span class="input-group-addon btn-danger"><i class="fa fa-location-arrow"></i></span>
                <input type="text" name="work_address" value="{{$user->work_address}}" class="form-control input-lg"
                       placeholder="WorkAddress">

            </div>
        </div>
    </div>
    <button onclick="sub(this)" type="button" class="btn btn-primary mr-xs mb-sm">提交修改</button>
</form>

<script>
    //提交修改
    function sub(data) {
        axios.put('{{route('users.editBasic',[$user])}}', {
            name: $("input[name='name']").val(),
            email: $("input[name='email']").val(),
            phone: $("input[name='phone']").val(),
            introduction: $("textarea[name='introduction']").val(),
            company: $("input[name='company']").val(),
            position: $("input[name='position']").val(),
            work_address: $("input[name='work_address']").val(),
        }).then(function (response) {
            swal({
                text: '修改成功',
                icon: 'success',
                button: '确定',
            }).then(function (is) {
                window.location.reload();
                capture(data);
            })
        }).catch(function (error) {
            if (error.response.status === 419 || error.response.status === 404) {
                swal({
                    text: '页面活动以过期，请刷新页面后重试',
                    icon: 'warning',
                    button: '确定',
                }).then(function (isconfirm) {
                    if (isconfirm === true) {
                        window.location.reload();
                    }
                });
            } else if (error.response.status === 422) {
                console.log(error.response.data.errors.name);
                // each(error.response.data.errors,function(k,v){
                //     console.log(v);
                // });
                let html1 = "<span class='help-block'><strong style='color: #b7281f;'>";
                let html2 = "</strong></span>";
                $(".help-block").empty();

                $(".naerr").after(html1 + error.response.data.errors.name[0] + html2);
                $("#name").addClass(' has-error');


                $(".pherr").after(html1 + error.response.data.errors.phone[0] + html2)
                $("#phone").add(' has-error');

            } else if (error.response.status === 403) {
                swal({
                    text: '您当前没有操作此功能权限',
                    icon: 'error',
                    buton: '确定',
                }).then(function (isconfirm) {
                    window.location.reload();
                })
            }
        })
    }
</script>


