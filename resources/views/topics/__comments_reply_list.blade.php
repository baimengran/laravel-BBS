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
                                    <span> <a href="#"><i class="fa fa-reply"></i> 回复</a></span>
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