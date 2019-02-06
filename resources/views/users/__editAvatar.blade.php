<h4 class="text-uppercase" style="padding-bottom: 10%">上传头像</h4>
<form class="form-horizontal form-bordered" action="{{route('users.editAvatar',[$user])}}" id="frmSignIn" method="post"
      enctype="multipart/form-data">

    <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-6">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="input-append">
                    <div class="uneditable-input">
                        <i class=""></i>
                        <span class="fileupload-preview"></span>
                    </div>
                    <span  class="btn btn-default btn-file ">
                    {{--<span class="fileupload-exists">--}}
                        @if($user->img)
                            <img id="fileAvatar" src="{{$user->img}}" alt="..." class="img-thumbnail preview">
                        @endif
                        {{--</span>--}}
                        <input  type="file" id="upload_file" name="img">
                </span>

                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary mr-xs mb-sm editAvatar">提交</button>
</form>

<script>
    //点击图片上传
    $("#fileAvatar").on('click',function(){
        $('#upload_file').trigger('click');
    });

    //图片预览
    $("#upload_file").change(function (e) {
        var imgBox = e.target;
        uploadImg($('.preview'), imgBox)
    });

    function uploadImg(element, tag) {
        var file = tag.files[0];
        var imgSrc;
        if (!/image\/\w+/.test(file.type)) {
            alert("看清楚，这个需要图片！");
            return false;
        }
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            // console.log(this.result);
            imgSrc = this.result;
            //var imgs = document.createElement("img");
            //$(imgs).attr("src", imgSrc);
            element.attr('src', imgSrc);
        };
    }

    //提交
    $(".editAvatar").on('click', function () {
        //console.log(1);
        var file = document.getElementById("upload_file").files[0];
        //console.log(file);
        if(!file){
            swal({
                text:'请上传图片后再提交',
                icon:'warning',
                button:'确定',
            })
        }
        var formData = new FormData();
        formData.append('_method','put');
        formData.append('img', file);
        let config = {
            headers: {'Content-Type': 'multipart/form-data'}
        };
        //console.log(formData.get('img'));
        axios.post('{{route('users.editAvatar',[$user])}}', formData, config)
            .then(function (response) {
                console.log(response.data)
                if(response.data===0){
                    console.log(false);
                }else {
                    console.log(response.data);
                    swal({
                        text: '修改成功',
                        icon: 'success',
                        button: '确定',
                    }).then(function (is) {
                        window.location.reload();

                    })
                }
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
                console.log(error.response.data.errors.img);
                imgError = new String(error.response.data.errors.img);
                if (imgError) {
                    swal({
                        text: imgError,
                        icon: 'error',
                        button: '确定'
                    })
                }
            } else if (error.response.status === 403) {
                swal({
                    text: '您当前没有操作此功能权限',
                    icon: 'error',
                    button: '确定',
                }).then(function (isconfirm) {
                    window.location.reload();
                })
            }
        })
    })
</script>