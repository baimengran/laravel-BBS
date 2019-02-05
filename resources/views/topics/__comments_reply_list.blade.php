@if(isset($replies)&&count($replies)>0)
    <ul class="comments" style="margin-bottom:20px">
        @foreach($replies as $k=>$reply)
            <li>
                <div class="comment">
                    <div class="img-thumbnail">
                        <a href="{{route('users.show',[$reply->user])}}"><img class="avatar" alt=""
                                                                              src="{{$reply->user->img}}"></a>
                    </div>
                    <div class="comment-block">
                        <div class="comment-arrow"></div>
                        <span class="comment-by">
                                <strong>
                                    <a href="{{route('users.show',[$reply->user])}}">{{$reply->user->name}}</a>
                                </strong>
                            @if($k!=0)
                                @
                                <a href="{{route('users.show',[$reply->parentUser])}}">{{$reply->parentUser->name}}</a>
                            @endif
                            <span class="pull-right">
                                @can('delete',$reply)
                                    <span>
                                    <a class="btn btn-default btn-xs " data-id="{{$reply->id}}"
                                       href="javascript:void(0)" onclick="deleteComment(this)"><i
                                                class="fa fa-trash-o"></i> 删除</a>
                                    <a class="btn btn-default btn-xs " data-id="{{$reply->id}}"><i
                                                class="fa fa-edit"></i> 修改</a>
                                </span>
                                @endcan
                                <span> <a class="clickCheck" href="javascript:void(0)"
                                          data-info='{"id":{{$reply->id}},"topic_id":{{$reply->topic_id}},"user_id":{{$reply->user_id}},"parent_id":{{$reply->parent_id}},"parent_user_id":{{$reply->parent_user_id}}}'
                                          data-toggle="modal" data-target="#replyModal"
                                          data-whatever="@ {{$reply->user->name}}"><i
                                                class="fa fa-reply"></i> 回复</a></span>
                                </span>
                            </span>
                        {!! $reply->content !!}
                        <span class="date pull-right">{{$reply->created_at->diffForHumans()}}</span>
                    </div>

                </div>
            </li>
        @endforeach
    </ul>
    {{$replies->links()}}

@endif