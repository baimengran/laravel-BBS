@if(isset($comments)&&count($comments)>0)
<ul class="comments" style="margin-bottom:20px">
        @foreach($comments as $comment)
            <li>
                <div class="comment">
                    <div class="img-thumbnail">
                        <a id="{{$comment->user->id}}" href="{{route('users.show',[$comment->user])}}"><img class="avatar" alt="" src="{{$comment->user->img}}"></a>
                    </div>
                    <div class="comment-block">
                        <div class="comment-arrow"></div>
                        <span class="comment-by">
                        <strong><a href="{{route('users.show',[$comment->user])}}">{{$comment->user->name}}</a></strong>
                        <span class="pull-right">
                            <span> <a href="#"><i class="fa fa-reply"></i> 回复</a></span>
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
<script>



</script>