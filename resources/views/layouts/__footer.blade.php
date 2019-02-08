<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="footer-ribbon">
                <span>Get in Touch</span>
            </div>
            <div class="col-md-6">
                <h4>{{setting('site_footer_one_name','关于本网站','site_footer')}}</h4>
                <p>
                    {{setting('site_footer_one_content','','site_footer')}}
                    <a href="{{route('help')}}" class="btn-flat btn-xs">View More <i class="fa fa-arrow-right"></i></a>
                </p>
                <hr class="light">
            </div>
            <div class="col-md-4">
                <div class="contact-details">
                    <h4>{{setting('site_footer_two_name','','site_footer')}}</h4>
                    <ul class="contact">
                        <li><p><i class="fa fa-map-marker"></i>
                                <strong>Address:</strong> {{setting('site_footer_two_address','','site_footer')}}</p>
                        </li>
                        <li><p><i class="fa fa-phone"></i>
                                <strong>Phone:</strong> {{setting('site_footer_two_phone','','site_footer')}}
                            </p></li>
                        <li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a
                                        href="mailto:{{setting('site_footer_two_email','','site_footer')}}">{{setting('site_footer_two_email','','site_footer')}}</a>
                            </p></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <h4>{{setting('site_footer_three_name','','site_footer')}}</h4>
                <img width="100px" onmouseover="this.style.cursor='pointer';this.style.cursor='hand'"
                     onmouseout="this.style.cursor='default'" data-toggle="modal" data-target="#wechatQR"
                     src="{{asset('uploads/images/site/'.setting('site_footer_three_content','','site_footer'))}}"
                     alt="二维码">

                <div id="wechatQR" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            {{--<div class='carousel-inner img-responsive img-rounded' id="img_show">--}}
                            <img src="{{asset('uploads/images/site/'.setting('site_footer_three_content','','site_footer'))}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-1">
                    <a href="{{route('home')}}" class="logo">
                        <img alt="Laravel BlogTwo" class="img-responsive"
                             src="{{asset('uploads/images/site/'.setting('footer_logo'))}}">
                    </a>
                </div>
                <div class="col-md-11">
                    <p>{{setting('site_footer_copyright','','site_footer')}}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
