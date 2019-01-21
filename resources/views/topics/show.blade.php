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
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                                href="{{route('topics.edit',[$topic])}}" style="margin-right: 10px;"><i class="fa fa-edit"></i> 编辑</a>

                                    <form class="pull-left" action="{{route('topics.destroy',[$topic])}}" method="post" accept-charset="UTF-8">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-default btn-xs "
                                                    href="{{route('topics.destroy',[$topic])}}" style="margin-right: 10px;"><i class="fa fa-trash-o"></i> 删除</button>
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

                            <div class="post-block post-comments ">
                                <h3 class="heading-primary"><i class="fa fa-comments"></i>评论 ({{$topic->reply_count}})
                                </h3>

                                <ul class="comments">
                                    <li>
                                        <div class="comment">
                                            <div class="img-thumbnail">
                                                <img class="avatar" alt="" src="img/avatars/avatar-2.jpg">
                                            </div>
                                            <div class="comment-block">
                                                <div class="comment-arrow"></div>
                                                <span class="comment-by">
																<strong>John Doe</strong>
																<span class="pull-right">
																	<span> <a href="#"><i class="fa fa-reply"></i> Reply</a></span>
																</span>
															</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra
                                                    euismod odio, gravida pellentesque urna varius vitae, gravida
                                                    pellentesque urna varius vitae. Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit. Nam viverra euismod odio, gravida
                                                    pellentesque urna varius vitae. Sed dui lorem, adipiscing in
                                                    adipiscing et, interdum nec metus. Mauris ultricies, justo eu
                                                    convallis placerat, felis enim ornare nisi, vitae mattis nulla ante
                                                    id dui.</p>
                                                <span class="date pull-right">November 12, 2017 at 1:38 pm</span>
                                            </div>
                                        </div>

                                        <ul class="comments reply">
                                            <li>
                                                <div class="comment">
                                                    <div class="img-thumbnail">
                                                        <img class="avatar" alt="" src="img/avatars/avatar-3.jpg">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
                                                        <span class="comment-by">
																		<strong>John Doe</strong>
																		<span class="pull-right">
																			<span> <a href="#"><i
                                                                                            class="fa fa-reply"></i> Reply</a></span>
																		</span>
																	</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                                            viverra euismod odio, gravida pellentesque urna varius
                                                            vitae, gravida pellentesque urna varius vitae.</p>
                                                        <span class="date pull-right">November 12, 2017 at 1:38 pm</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="comment">
                                                    <div class="img-thumbnail">
                                                        <img class="avatar" alt="" src="img/avatars/avatar-4.jpg">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
                                                        <span class="comment-by">
																		<strong>John Doe</strong>
																		<span class="pull-right">
																			<span> <a href="#"><i
                                                                                            class="fa fa-reply"></i> Reply</a></span>
																		</span>
																	</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                                            viverra euismod odio, gravida pellentesque urna varius
                                                            vitae, gravida pellentesque urna varius vitae.</p>
                                                        <span class="date pull-right">November 12, 2017 at 1:38 pm</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="comment">
                                            <div class="img-thumbnail">
                                                <img class="avatar" alt="" src="img/avatars/avatar.jpg">
                                            </div>
                                            <div class="comment-block">
                                                <div class="comment-arrow"></div>
                                                <span class="comment-by">
																<strong>John Doe</strong>
																<span class="pull-right">
																	<span> <a href="#"><i class="fa fa-reply"></i> Reply</a></span>
																</span>
															</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                <span class="date pull-right">November 12, 2017 at 1:38 pm</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment">
                                            <div class="img-thumbnail">
                                                <img class="avatar" alt="" src="img/avatars/avatar.jpg">
                                            </div>
                                            <div class="comment-block">
                                                <div class="comment-arrow"></div>
                                                <span class="comment-by">
																<strong>John Doe</strong>
																<span class="pull-right">
																	<span> <a href="#"><i class="fa fa-reply"></i> Reply</a></span>
																</span>
															</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                <span class="date pull-right">November 12, 2017 at 1:38 pm</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                            </div>

                            <div class="post-block post-leave-comment">
                                <h3 class="heading-primary">Leave a comment</h3>

                                <form action="" method="post">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>Your name *</label>
                                                <input type="text" value="" maxlength="100" class="form-control"
                                                       name="name" id="name">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Your email address *</label>
                                                <input type="email" value="" maxlength="100" class="form-control"
                                                       name="email" id="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Comment *</label>
                                                <textarea maxlength="5000" rows="10" class="form-control" name="comment"
                                                          id="comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="Post Comment" class="btn btn-primary btn-lg"
                                                   data-loading-text="Loading...">
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </article>

                </div>
            </div>
            <div id="leftmenu" class="col-md-3">
                @include('topics.__topic_sidebar')
            </div>
        </div>
    </div>



@endsection