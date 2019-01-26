@extends('layouts.base')
@section('title',$topic->title)
@section('description',$topic->excerpt)
@section('subhead',$topic->title??'话题')
@section('nav','话题')

@section('content')
    <div class="row">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <strong>{{session('success')}}</strong>
                </div>
            @endif
            <div class="col-md-9">
                <div class="blog-posts single-post">

                    <article class="post post-large blog-single-post">

                        <div class="post-date">
                            <span class="day">{{$topic->updated_at->day}}</span>
                            <span class="month">{{$topic->updated_at->englishMonth}}</span>
                        </div>

                        <div class="post-content">

                            <h2>{{$topic->title}}</h2>

                            <div class="post-meta">
                                <span><i class="fa fa-user"></i> By <a
                                            href="{{route('users.show',[$topic->user])}}">{{$topic->user->name}}</a> </span>
                                <span><i class="fa fa-th-list"></i> <a
                                            href="{{route('categories.show',[$topic->category])}}">{{$topic->category->name}}</a> </span>
                                <span><i class="fa fa-comments"></i> {{$topic->reply_count}} 评论</span>
                                @can('update',$topic)
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-xs " role="button"
                                           href="{{route('topics.edit',[$topic])}}" style="margin-right: 10px;"><i
                                                    class="fa fa-edit"></i> 编辑</a>

                                        <form class="pull-left" action="{{route('topics.destroy',[$topic])}}"
                                              method="post" accept-charset="UTF-8">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="btn btn-default btn-xs "
                                                    href="{{route('topics.destroy',[$topic])}}"
                                                    style="margin-right: 10px;"><i class="fa fa-trash-o"></i> 删除
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                            <div class="post-content" style="margin: 0px 2% 0% 2%;">
                                {!! $topic->body !!}
                            </div>


                            <div class="post-block post-share">
                                <h3 class="heading-primary"><i class="fa fa-share"></i>分享这篇文章</h3>

                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_toolbox addthis_default_style ">
                                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                    <a class="addthis_button_tweet"></a>
                                    <a class="addthis_button_pinterest_pinit"></a>
                                    <a class="addthis_counter addthis_pill_style"></a>
                                </div>
                            {{--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"></script>--}}
                            <!-- AddThis Button END -->

                            </div>

                            <div class="post-block post-author clearfix">
                                <h3 class="heading-primary"><i class="fa fa-user"></i>作者</h3>
                                <div class="img-thumbnail">
                                    <a href="{{route('users.show',[$topic->user])}}">
                                        <img src="{{$topic->user->img}}" alt="{{$topic->user->name}}">
                                    </a>
                                </div>
                                <p><strong class="name"><a
                                                href="{{route('users.show',[$topic->user])}}">{{$topic->user->name}}</a></strong>
                                </p>
                                <p>{{$topic->user->introduction}}</p>
                            </div>
{{--                            <a class="btn-primary" href="{{route('comments.reply',[$topic])}}">点击</a>--}}
                            {{--评论开始--}}
                            <div class="post-block post-comments ">
                                <h3 class="heading-primary"><i class="fa fa-comments"></i>评论 ({{$topic->reply_count}})
                                </h3>
                                <div id="comments" class="row" style="margin-right: 0px"></div>
                            </div>
                            @include('topics.__comment_box')
                            {{--评论结束--}}
                        </div>
                    </article>

                </div>
            </div>
            <div id="leftmenu" class="col-md-3">
                @include('topics.__topic_sidebar')
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            let ids = [];//评论id数组，
            let replies = [];//回复div元素数组
            let winSize = $(window).height();//当前可见区域大小
            let ajaxs = [];
            console.log('可见区域大小：' + winSize);
            //加载主评论
            axios.get('{{route('comments.index',[$topic])}}')
                .then(function (response) {
                    $("#comments").append(response.data);
                    $(".pagination").removeClass('pagination-lg');
                    $(".pagination").addClass("comment");
                    //let ids = [];
                    let li = [];//评论下ul元素数组
                    // $("#comments .comments li").each(function () {
                    //     li.push(this);
                    // });
                    //加载回复
                    reply();
                    //滚动事件
                    // $(window).scroll(function () {
                    //     let scroll = $(window).scrollTop();//滚动条位置
                    //     //循环遍历idTop_idHeight中元素宽度
                    //     $.each(li, function (k, v) {
                    //         let idTop_idHeight = $(this).offset().top + $(this).height();
                    //         //元素是否进入可视范围
                    //         if (idTop_idHeight < scroll + winSize) {
                    //
                    //             //确定是否存在回复对象，存在则不添加到replies数组
                    //             if (!(k in replies)) {
                    //                 //console.log(11);
                    //                 replies.push({'key': k, 'value': $(this).children(".replies")});
                    //             }
                    //         }
                    //     });
                    //     $.each(replies, function (key, value) {
                    //         if ($.inArray(key, ajaxs) === -1) {
                    //             ajaxs.push(key);//添加replies元素数组key到ajaxs数组，以确保ajax不会重复提交
                    //             id = value['value'].attr('id');//获取父评论id
                    //             //ajax请求服务器获取子评论id
                    {{--axios.post('{{route('comments.reply',[$topic])}}', {id: id,blo:true})--}}
                    {{--.then(function (response) {--}}
                    {{--//console.log(response.data.parent_id);--}}
                    {{--if (!$.isEmptyObject(response.data)) {--}}
                    {{--$("#comments ul li div.replies").each(function () {--}}
                    {{--// console.log($(this).attr('id').trim().replace('replies',''));--}}
                    {{--// console.log(response.data.data[0].parent_id);--}}
                    {{--if ($(this).attr('id').replace('replies', '').trim() == response.data.parent_id) {--}}
                    {{--// console.log($(this)[0])--}}
                    {{--axios.post('{{route('comments.reply',[$topic])}}',{id:response.data.parent_id})--}}
                    {{--.then(function(response){--}}
                    {{--$("#"+$(this).attr('id')).append(response.data);--}}
                    {{--$(".pagination.pagination-lg li").css('padding','0px');--}}
                    {{--$(".pagination.pagination-lg").addClass('pagination-sm');--}}
                    {{--$(".pagination.pagination-sm").removeClass('pagination-lg');--}}

                    {{--})--}}
                    {{--}--}}

                    {{--})--}}
                    {{--}--}}
                    {{--});--}}
                    // }
                    // });
                    // });


                    //console.log(ids);
                    //console.log(id)
                    //加载评论回复
                    {{--axios.post('{{route('comments.reply',[$topic])}}',{'ids':ids})--}}
                    {{--.then(function (response) {--}}
                    {{--console.log(response.data);--}}
                    // $.each(response.data['data'],function(){
                    //     if(this['id']===601){
                    //         console.log(1);
                    //     }
                    // })
                    // });
                    {{--let css={--}}
                    {{--clear:'both',--}}
                    {{--padding:'0px',--}}
                    {{--};--}}
                    {{--$("#replies").append(response.data);--}}
                    {{--$(".pagination.pagination-lg li").css(css);--}}
                    {{--$(".pagination.pagination-lg").addClass('pagination-sm');--}}
                    {{--$(".pagination.pagination-sm").removeClass('pagination-lg');--}}

                    {{--}).catch(function (error) {--}}
                    {{--if (error.response) {--}}
                    {{--swal({--}}
                    {{--title: '出错啦！',--}}
                    {{--text: error.response.statusText,--}}
                    {{--icon: 'error',--}}
                    {{--button: '确定',--}}
                    {{--});--}}
                    {{--}--}}
                    {{--});--}}
                });

            //加载回复函数
            function reply() {
                $("#comments .comments .replies").each(function () {
                    let id = $(this).attr('id');
                    let reply = $(this);
                    console.log(id);

                    axios.post('{{route('comments.reply',[$topic])}}', {id: id})
                        .then(function (response) {
                            //console.log('fff'+response.data)
                            reply.append(response.data);
                            $(".pagination.pagination-lg li").css('padding', '0px');
                            $(".pagination.pagination-lg").addClass('pagination-sm');
                            $(".pagination.pagination-lg").addClass('reply');
                            $(".pagination.pagination-sm").removeClass('pagination-lg');

                        });
                });
            }

            //主评论分页
            $("body").on('click', '#comments .comment li a', function (e) {
                e.preventDefault();
                axios.get($(this).attr('href'))
                    .then(function (response) {
                        $("#comments").html(response.data);
                        $(".pagination").removeClass('pagination-lg');
                        $(".pagination").addClass("comment");
                        //加载回复
                        reply();
                    })
                    .catch(function (error) {
                        if (error.response) {
                            swal({
                                title: '评论加载出错啦！',
                                text: error.response.statusText,
                                icon: 'error',
                                button: '确定',
                            });
                        } else {
                            swal({
                                title: '评论加载出错啦',
                                text: error.message,
                                icon: 'error',
                                button: '确定',
                            });
                        }
                    });
            });

            //回复分页

            $("body").on("click", '.reply li a', function (e) {
                e.preventDefault();
                //console.log($(this));
                let parent = $(this).parent().parent(".reply").parent(".replies");
                //console.log(parent);
                let id = parent.attr('id').replace('replies', '').trim();
                //console.log(id);
                axios.post($(this).attr('href'), {id: id})
                    .then(function (response) {
                        //console.log(response.data)
                        parent.html(response.data);
                        $(".pagination.pagination-lg li").css('padding', '0px');
                        $(".pagination.pagination-lg").addClass('pagination-sm');
                        $(".pagination.pagination-lg").addClass("reply");
                        $(".pagination.pagination-sm").removeClass('pagination-lg');
                    })
                    .catch(function (error) {
                        if (error.response) {
                            swal({
                                title: '出错啦！',
                                text: error.response.statusText,
                                icon: 'error',
                                button: '确定',
                            });
                        } else {
                            swal({
                                title: '出错啦',
                                text: error.message,
                                icon: 'error',
                                button: '确定',
                            });
                        }
                    });
            });
        });

    </script>


@endsection