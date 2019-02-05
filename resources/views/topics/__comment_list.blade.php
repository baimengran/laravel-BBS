@if(isset($comments)&&count($comments)>0)
    <ul class="comments" style="margin-bottom:20px">
        @foreach($comments as $comment)
            <li>
                <div class="comment">
                    <div class="img-thumbnail">
                        <a id="{{$comment->user->id}}" href="{{route('users.show',[$comment->user])}}"><img
                                    class="avatar" alt="" src="{{$comment->user->img}}"></a>
                    </div>
                    <div class="comment-block">
                        <div class="comment-arrow"></div>
                        <span class="comment-by">
                        <strong><a href="{{route('users.show',[$comment->user])}}">{{$comment->user->name}}</a></strong>
                        <span class="pull-right">
                            @can('delete',$comment)
                                <span>
                                    <a class="btn btn-default btn-xs " href="javascript:void(0)"
                                       onclick="deleteComment(this)" data-id="{{$comment->id}}"><i
                                                class="fa fa-trash-o"></i> 删除</a>
                                    <a class="btn btn-default btn-xs " data-id="{{$comment->id}}"><i
                                                class="fa fa-edit"></i> 修改</a>
                                </span>
                            @endcan
                            <span> <a class="clickCheck" href="javascript:void(0)" data-toggle="modal"
                                      data-target="#replyModal"
                                      data-info='{"id":{{$comment->id}},"topic_id":{{$comment->topic_id}},"user_id":{{$comment->user_id}},"parent_id":{{$comment->parent_id}},"parent_user_id":{{$comment->parent_user_id}}}'
                                      data-whatever="@ {{$comment->user->name}}"><i
                                            class="fa fa-reply"></i> 回复</a></span>
                        </span>
                    </span>
                        {!! $comment->content !!}
                        <span class="date pull-right">{{$comment->created_at->diffForHumans()}}</span>
                    </div>
                </div>
                {{--评论回复开始--}}
                <div id="replies{{$comment->id}}" class="row replies" style="margin-right: 0px;margin-left: 0.1%;">

                </div>
                {{--评论回复结束--}}
            </li>

        @endforeach
    </ul>
    {{$comments->links()}}

@endif
