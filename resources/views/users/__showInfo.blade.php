<div class="">
    <h4 style="margin-bottom:50px">{{isset($topics)?'发布的话题':(isset($comments)?'发表的评论':(isset($notifications)?'我的消息':'话题'))}}</h4>
    @if(isset($topics))
        @if(count($topics)>0)
            <ul class="list list-icons list-primary">
                @foreach($topics as $topic)
                    <li class="appear-animation animated fadeInUp appear-animation-visible "
                        data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                        style="text-align:left">
                        <i class="fa fa-check"></i>
                        <a href="{{$topic->link()}}">{{$topic->title}}</a>
                        <span style="float:right">
                                            <span class="appear-animation animated fadeInUp appear-animation-visible "
                                                  data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                {{$topic->reply_count}} 回复
                                            </span>
                                            -
                                            <span class="appear-animation animated fadeInUp appear-animation-visible "
                                                  data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                {{$topic->created_at->diffForHumans()}}
                                            </span>
                            @can('delete',$topic)
                                <a id="delTopic" class="btn btn-default" href="javascript:void(0)"
                                   onclick="delTopic(this,{{$topic->id}})">删除</a>
                            @endcan
                                        </span>
                    </li>
                    <hr>
                @endforeach
                {{$topics->links()}}
            </ul>
        @else
            暂无数据
        @endif
    @elseif(isset($comments))
        @if(count($comments)>0)
            <ul class="list list-icons list-primary">
                @foreach($comments as $comment)
                    <li class="appear-animation animated fadeInUp appear-animation-visible "
                        data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                        style="text-align:left">
                        <i class="fa fa-check"></i>
                        <a href="{{$comment->topic->link()}}">{{$comment->topic->title}}</a>
                        <div>{!! make_excerpt($comment->content) !!}</div>
                        <span style="float:right">
                                            <span class="appear-animation animated fadeInUp appear-animation-visible "
                                                  data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                0 点赞
                                            </span>
                                            -
                                            <span class="appear-animation animated fadeInUp appear-animation-visible "
                                                  data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                {{$comment->created_at->diffForHumans()}}
                                            </span>
                            @can('delete',$comment)
                                <a id="delTopic" class="btn btn-default" href="javascript:void(0)"
                                   onclick="delTopic(this,{{$comment->id}})">删除</a>
                            @endcan
                                        </span>
                    </li>
                    <hr>
                @endforeach
                {{$comments->links()}}
            </ul>
        @else
            暂无数据
        @endif
    @elseif(isset($notifications))
        @if(count($notifications)>0)
            <ul class="list list-icons list-primary">
                @foreach($notifications as $notification)
                    <li class="appear-animation animated fadeInUp appear-animation-visible "
                        data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                        style="text-align:left">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{route('users.show',[$notification->data['user_id']])}}">
                                    <img class="img-responsive img-circle mb-lg" src="{{$notification->data['user_img']}}"
                                         alt="Project Image" width="80px">
                                </a>
                            </div>
                            <div class="col-md-10">
                                <div>
                                <a href="{{route('users.show',[$notification->data['user_id']])}}">{{$notification->data['user_name']}}</a>
                                评论了
                                <a href="{{$notification->data['topic_link']}}">{{$notification->data['topic_title']}}</a>
                                    <span class="pull-right">{{$notification->created_at->diffForHumans()}}</span>
                                </div>
                                <p style="margin:5px 0px 5px 0px;">{!! $notification->data['comment_content'] !!}</p>
                            </div>
                        </div>
                    </li>
                    <hr>
                @endforeach
                {{$notifications->links()}}
            </ul>
        @else
            暂无数据
        @endif
    @endif
</div>