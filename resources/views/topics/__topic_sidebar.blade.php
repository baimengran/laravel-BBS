<aside class="sidebar">
    <a href="{{route('topics.create')}}" style="width:100%"  class="btn btn-info mr-xs mb-sm"><i class="fa fa-pencil"></i> 发布新话题</a>
    <form>
        <div class="input-group input-group-lg">
            <input class="form-control" placeholder="Search..." name="s" id="s" type="text">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>

    <hr>
    <div class="tabs mb-xlg">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#popularPosts" data-toggle="tab"><i class="fa fa-star"></i> Popular</a></li>
            <li><a href="#recentPosts" data-toggle="tab">Recent</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="popularPosts">
                <ul class="simple-post-list">
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail">
                                <a href="blog-post.html">
                                    <img src="img/blog/blog-thumb-1.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>
                            <div class="post-meta">
                                Jan 10, 2017
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail">
                                <a href="blog-post.html">
                                    <img src="img/blog/blog-thumb-2.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Vitae Nibh Un Odiosters</a>
                            <div class="post-meta">
                                Jan 10, 2017
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail">
                                <a href="blog-post.html">
                                    <img src="img/blog/blog-thumb-3.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Odiosters Nullam Vitae</a>
                            <div class="post-meta">
                                Jan 10, 2017
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="recentPosts">
                <ul class="simple-post-list">
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail">
                                <a href="blog-post.html">
                                    <img src="img/blog/blog-thumb-2.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Vitae Nibh Un Odiosters</a>
                            <div class="post-meta">
                                Jan 10, 2017
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail">
                                <a href="blog-post.html">
                                    <img src="img/blog/blog-thumb-3.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Odiosters Nullam Vitae</a>
                            <div class="post-meta">
                                Jan 10, 2017
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail">
                                <a href="blog-post.html">
                                    <img src="img/blog/blog-thumb-1.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>
                            <div class="post-meta">
                                Jan 10, 2017
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <hr>

    <h4 class="heading-primary">About Us</h4>
    <p>Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor
        fringilla libero. Nulla nunc dui, tristique in semper vel. Nam dolor ligula, faucibus id sodales in, auctor
        fringilla libero. </p>

</aside>
<script>
    $(document).ready(function () {
        var menuYloc = $("#leftmenu").offset().top; //此ID为随着屏幕滚动div的ID
        console.log("div高度" + menuYloc);
        let bottom = $("#footer").offset().top;//底部导航高度
        var cateHeig = $("#leftmenu").height();//侧边栏高度
        console.log("分类元素高度：" + cateHeig)
        console.log("底部导航：" + bottom)
        var scrollBtm = $(document).height();//浏览器可视高度
        console.log("浏览器高度：" + scrollBtm)
        let a = scrollBtm - bottom;//浏览器高度-底部导航高度
        console.log("a:" + a);
        let b = bottom - cateHeig;//底部导航-侧边栏高度
        console.log("b:" + b);
        let c = b - a;
        console.log("c:" + c);
        $(window).scroll(function () {

            let scrollTop = $(window).scrollTop();
            console.log("滚动条：" + scrollTop);
            var offsetTop = scrollTop - 200;
            let offsetTop1 = offsetTop + "px";
            console.log(offsetTop);

            if (scrollTop <= 200) {
                $("#leftmenu").animate({top: 0}, {duration: 600, queue: false});
            } else if (offsetTop > c) {

            } else {
                $("#leftmenu").animate({top: offsetTop1}, {duration: 600, queue: false});
            }
        });
    });
</script>