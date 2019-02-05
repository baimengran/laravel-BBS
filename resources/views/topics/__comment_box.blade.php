<div class="modal fade bs-example-modal-lg" id="replyModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel">
    <div class="modal-dialog bs-example-modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">发表评论</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="message-text" class="control-label">评论:</label>
                    <form id="sendCommentForm" method="post">
                        <textarea class="form-control" name="content" rows="10" id="message-text"
                                  placeholder=""></textarea>
                        <div id="commentFormHidden"></div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button id="sendCommentButton" type="button" class="btn btn-primary" data-dismiss="modal">提交评论</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("body").on('click', '#sendCommentButton', function () {
        let data = new FormData(document.getElementById("sendCommentForm"));
        console.log(555);
        // $('#replyModal').modal('hide');
        axios.post('{{route('comments.store')}}', data)
            .then(function (response) {
                swal({
                    text: '评论成功！',
                    icon: 'success',
                    button: '确定',
                }).then(function (isconfirm) {
                    location.reload()
                });
            }).catch(function (error) {
            if (error.response.status === 422) {
                swal({
                    text: error.response.data.errors.content[0],
                    icon: 'error',
                    button: '确认',
                })
            } else if (error.response.status === 419 || error.response.status === 404) {
                swal({
                    title: '当前页面以过期请刷新页面后重试',
                    text: '是否刷新页面？',
                    icon: 'warning',
                    buttons: ['取消', '确认']
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        location.reload();
                    }
                })
            }
        });
    });


    //回复时模态框指向回复目标
    $('#replyModal').on('show.bs.modal', function (event) {
        var a = $(event.relatedTarget) // a that triggered the modal
        var recipient = a.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body label').text(recipient)
    });
</script>