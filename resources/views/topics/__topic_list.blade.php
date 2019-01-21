@if(count($topics)>0)
    @foreach($topics as $topic)
        <article class="post post-medium">
            <div class="row">
                <div class="col-md-3">
                    <div class="post-image">
                        {{--<div class="owl-item cloned" style="height: 100.281px;">--}}
                        <div class="img-thumbnail">
                            <img class="img-responsive" src="{{$topic->user->img}}" alt="{{$topic->user->name}}"
                                 style="max-width: 150px;max-height: 150px;">
                        </div>
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-md-9">

                    <div class="post-content">

                        <h2><a href="{{$topic->link()}}">{{$topic->title}}</a>
                        </h2>
                        <p>{!! $topic->excerpt !!}  </p>

                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="post-meta">
                        <span><i class="fa fa-calendar"></i> {{$topic->updated_at->diffForHumans()}} </span>
                        <span><i class="fa fa-user"></i> By <a
                                    href="{{$topic->link()}}">{{$topic->user->name}}</a> </span>
                        <span><i class="fa fa-th-list"></i>

                            <a href="{{route('categories.show',[$topic->category->id])}}">
                                {{$topic->category->name}}
                            </a> </span>
                        <span><i class="fa fa-comments"></i> <a href="#">{{$topic->reply_count}}</a></span>
                        <a href="{{$topic->link()}}" class="btn btn-xs btn-primary pull-right">
                            查看更多...</a>
                    </div>
                </div>
            </div>

        </article>
    @endforeach
@else
    暂无数据
@endif