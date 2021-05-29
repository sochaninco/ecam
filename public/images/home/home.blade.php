@extends('layouts.app')
@section('content')
    <section id="slider"><!--slider-->
        <div class="container white-bg">
            <div class="row">
                <div class="col-sm-3 no-padding">
                    <div class="hero">
                        <div id="vertical" class="hovermenu ttmenu dark-style menu-color-gradient">
                            <div class="navbar navbar-default" role="navigation">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="#"><i class="fa fa-home"></i></a>
                                </div><!-- end navbar-header -->

                                <div class="navbar-collapse collapse" style="height: 1px;">
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown ttmenu-full active"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Tabbed <b class="dropme"></b></a>
                                            <ul id="first-menu" class="dropdown-menu vertical-menu">
                                                <li>
                                                    <div class="ttmenu-content">
                                                        <div class="tabbable row">
                                                            <div class="col-md-3">
                                                                <ul class="nav nav-pills-menu nav-stacked">
                                                                    <li class="active"><a href="#tabs5-pane1" data-toggle="tab">Rich Features</a></li>
                                                                    <li class=""><a href="#tabs5-pane2" data-toggle="tab">Thumbnail</a></li>
                                                                    <li class=""><a href="#tabs5-pane3" data-toggle="tab">Carousel</a></li>
                                                                    <li class=""><a href="#tabs5-pane4" data-toggle="tab">Embed Video</a></li>
                                                                </ul>
                                                            </div><!-- end col -->
                                                            <div class="col-md-9">
                                                                <div class="tab-content">
                                                                    <div id="tabs5-pane1" class="tab-pane active">
                                                                        <div class="row">
                                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                <div class="box">
                                                                                    <ul>
                                                                                        <li><h4>FONT ICON SUPPORT</h4></li>
                                                                                        <li><a href="#">Web Design <span class="fa fa-laptop"></span></a></li>
                                                                                        <li><a href="#">Web Development <span class="fa fa-gears"></span></a></li>
                                                                                        <li><a href="#">Graphic Design <span class="fa fa-leaf"></span></a></li>
                                                                                        <li><a href="#">IOS &amp; ANDROID <span class="fa fa-android"></span></a></li>
                                                                                        <li><a href="#">Logo Design <span class="fa fa-pencil"></span></a></li>
                                                                                        <li><a href="#">Mockup Design <span class="fa fa-maxcdn"></span></a></li>
                                                                                        <li><a href="#">e-Commerce <span class="fa fa-shopping-cart"></span></a></li>
                                                                                        <li><a href="#">Digital Marketing <span class="fa fa-desktop"></span></a></li>
                                                                                        <li><a href="#">SEO Services <span class="fa fa-area-chart"></span></a></li>
                                                                                    </ul>
                                                                                </div><!-- end box -->
                                                                            </div><!-- end col -->

                                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                <div class="box">
                                                                                    <ul>
                                                                                        <li><h4>WHY CHOOSE TT MENU</h4></li>
                                                                                        <li><a href="#">Responsive Layout</a></li>
                                                                                        <li><a href="#">Retina Display Ready</a></li>
                                                                                        <li><a href="#">Tons of Icons</a></li>
                                                                                        <li><a href="#">Gradient Colors</a></li>
                                                                                        <li><a href="#">Beginner Friendly</a></li>
                                                                                        <li><a href="#">Detailed Documentation</a></li>
                                                                                        <li><a href="#">100% Bootstrap Base</a></li>
                                                                                        <li><a href="#">HTML5 CSS3</a></li>
                                                                                        <li><a href="#">And Much More...</a></li>
                                                                                    </ul>
                                                                                </div><!-- end box -->
                                                                            </div><!-- end col -->
                                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                <img src="images/darkmenubg.png" alt="" class="img-responsive">
                                                                            </div><!-- end col -->
                                                                        </div><!-- end row -->
                                                                    </div>
                                                                    <div id="tabs5-pane2" class="tab-pane">
                                                                        <div class="row">
                                                                            <div class="col-md-4 menu-image">
                                                                                <div class="widget clearfix">
                                                                                    <a href="#">
                                                                                        <div class="entry">
                                                                                            <img src="{{asset('menu-style/images/menu_mini_01.png')}}" alt="" class="img-responsive">
                                                                                            <span class="magnifier"></span>
                                                                                        </div><!-- enntry -->
                                                                                    </a>
                                                                                </div><!-- end widget -->
                                                                            </div><!-- end col -->
                                                                            <div class="col-md-4 menu-image">
                                                                                <div class="widget clearfix">
                                                                                    <a href="#">
                                                                                        <div class="entry">
                                                                                            <img src="{{asset('menu-style/images/menu_mini_02.png')}}" alt="" class="img-responsive">
                                                                                            <span class="magnifier"></span>
                                                                                        </div><!-- enntry -->
                                                                                    </a>
                                                                                </div><!-- end widget -->
                                                                            </div><!-- end col -->
                                                                            <div class="col-md-4 menu-image">
                                                                                <div class="widget clearfix">
                                                                                    <a href="#">
                                                                                        <div class="entry">
                                                                                            <img src="{{asset('menu-style/images/menu_mini_03.png')}}" alt="" class="img-responsive">
                                                                                            <span class="magnifier"></span>
                                                                                        </div><!-- enntry -->
                                                                                    </a>
                                                                                </div><!-- end widget -->
                                                                            </div><!-- end col -->
                                                                            <div class="col-md-4">
                                                                                <div class="widget clearfix">
                                                                                    <a href="#">
                                                                                        <div class="entry">
                                                                                            <img src="{{asset('menu-style/images/menu_mini_04.png')}}" alt="" class="img-responsive">
                                                                                            <span class="magnifier"></span>
                                                                                        </div><!-- enntry -->
                                                                                    </a>
                                                                                </div><!-- end widget -->
                                                                            </div><!-- end col -->
                                                                            <div class="col-md-4">
                                                                                <div class="widget clearfix">
                                                                                    <a href="#">
                                                                                        <div class="entry">
                                                                                            <img src="{{asset('menu-style/images/menu_mini_05.png')}}" alt="" class="img-responsive">
                                                                                            <span class="magnifier"></span>
                                                                                        </div><!-- enntry -->
                                                                                    </a>
                                                                                </div><!-- end widget -->
                                                                            </div><!-- end col -->
                                                                            <div class="col-md-4">
                                                                                <div class="widget clearfix">
                                                                                    <a href="#">
                                                                                        <div class="entry">
                                                                                            <img src="{{asset('menu-style/images/menu_mini_06.png')}}" alt="" class="img-responsive">
                                                                                            <span class="magnifier"></span>
                                                                                        </div><!-- enntry -->
                                                                                    </a>
                                                                                </div><!-- end widget -->
                                                                            </div><!-- end col -->
                                                                        </div><!-- end row -->
                                                                    </div>
                                                                    <div id="tabs5-pane3" class="tab-pane">
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="box">
                                                                                    <h4>ABOUT OUR COMPANY</h4>
                                                                                    <p>Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham de  Bonorum " are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                                                                                    <p>Finibus Bonorum et Malorum" are also form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                                                                                    <button class="btn btn-primary small" href="">Read more</button>
                                                                                </div><!-- end box -->
                                                                            </div><!-- end col -->
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                                                    <div class="carousel-inner">
                                                                                        <div class="item">
                                                                                            <a href="single-project.html"><img src="{{asset('menu-style/images/menu_01.png')}}" class="img-responsive" alt=""></a>
                                                                                        </div><!-- End Item -->
                                                                                        <div class="item active">
                                                                                            <a href="single-project.html"><img src="{{asset('menu-style/images/menu_02.png')}}" class="img-responsive" alt=""></a>
                                                                                        </div><!-- End Item -->
                                                                                    </div><!-- End Carousel Inner -->
                                                                                </div><!-- /.carousel -->
                                                                            </div><!-- end col -->
                                                                        </div><!-- end row -->
                                                                    </div>
                                                                    <div id="tabs5-pane4" class="tab-pane">
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="box">
                                                                                    <div class="fluid-width-video-wrapper" style="padding-top: 56.25%;"><iframe src="https://www.youtube.com/embed/mdfMT5Zi8Eo" allowfullscreen="" id="fitvid0" frameborder="0"></iframe></div>
                                                                                </div><!-- end box -->
                                                                            </div><!-- end col -->
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="box">
                                                                                    <div class="fluid-width-video-wrapper" style="padding-top: 56.2%;"><iframe src="https://player.vimeo.com/video/48401493?color=90cc62&amp;title=0&amp;byline=0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" id="fitvid1" frameborder="0"></iframe></div>
                                                                                </div><!-- end box -->
                                                                            </div><!-- end col -->
                                                                        </div><!-- end row -->
                                                                    </div>
                                                                </div><!-- /.tab-content -->
                                                            </div><!-- end col -->
                                                        </div><!-- /.tabbable -->
                                                    </div><!-- end ttmenu-content -->
                                                </li>
                                            </ul>
                                        </li><!-- end mega menu -->
                                        <li class="dropdown ttmenu-full"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Grid <b class="dropme"></b></a>
                                            <ul class="dropdown-menu vertical-menu">
                                                <li>
                                                    <div class="ttmenu-content">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                        </div><!-- end row -->

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                        </div><!-- end row -->

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                        </div><!-- end row -->

                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                        </div><!-- end row -->

                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                        </div><!-- end row -->

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                        </div><!-- end row -->

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                        </div><!-- end row -->

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                        </div><!-- end row -->

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="coldesc">col</div>
                                                            </div>
                                                        </div><!-- end row -->
                                                    </div><!-- end ttmenu-content -->
                                                </li>
                                            </ul>
                                        </li><!-- end mega menu -->
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="dropme"></span></a>
                                            <ul class="dropdown-menu vertical-dropdown-menu" role="menu">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li class="dropdown-submenu">
                                                    <a href="#">Sub Menu <span class="dropme-left"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Second level</a></li>
                                                        <li class="dropdown-submenu">
                                                            <a href="#">Even More.. <span class="dropme-left"></span></a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#">3rd level</a></li>
                                                                <li><a href="#">3rd level</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="#">Second level</a></li>
                                                        <li><a href="#">Second level</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown ttmenu-full"><a href="#" data-toggle="dropdown" class="dropdown-toggle">List <b class="dropme"></b></a>
                                            <ul class="dropdown-menu vertical-menu">
                                                <li>
                                                    <div class="ttmenu-content">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="box">
                                                                    <ul>
                                                                        <li><a href="#">Icon Angellist <span class="fa fa-angellist"></span></a></li>
                                                                        <li><a href="#">Icon Bus <span class="fa fa-bus"></span></a></li>
                                                                        <li><a href="#">Icon PayPal <span class="fa fa-paypal"></span></a></li>
                                                                        <li><a href="#">Icon Vısa Card <span class="fa fa-cc-visa"></span></a></li>
                                                                        <li><a href="#">Icon Google Wallet <span class="fa fa-google-wallet"></span></a></li>
                                                                    </ul>
                                                                </div><!-- end box -->
                                                            </div><!-- end col -->
                                                            <div class="col-md-3">
                                                                <div class="box">
                                                                    <ul>
                                                                        <li><a href="#">Icon Wifi <span class="fa fa-wifi"></span></a></li>
                                                                        <li><a href="#">Icon Ils <span class="fa fa-ils"></span></a></li>
                                                                        <li><a href="#">Icon Pie Chart <span class="fa fa-pie-chart"></span></a></li>
                                                                        <li><a href="#">Icon Stripe Card <span class="fa fa-cc-stripe"></span></a></li>
                                                                        <li><a href="#">Icon TTY <span class="fa fa-tty"></span></a></li>
                                                                    </ul>
                                                                </div><!-- end box -->
                                                            </div><!-- end col -->
                                                            <div class="col-md-3">
                                                                <div class="box">
                                                                    <ul>
                                                                        <li><a href="#">Icon Line Chart <span class="fa fa-line-chart"></span></a></li>
                                                                        <li><a href="#">Icon Calculator <span class="fa fa-calculator"></span></a></li>
                                                                        <li><a href="#">Icon Yelp <span class="fa fa-yelp"></span></a></li>
                                                                        <li><a href="#">Icon Soccer <span class="fa fa-soccer-ball-o"></span></a></li>
                                                                        <li><a href="#">Icon Trash <span class="fa fa-trash"></span></a></li>
                                                                    </ul>
                                                                </div><!-- end box -->
                                                            </div><!-- end col -->
                                                            <div class="col-md-3">
                                                                <div class="box">
                                                                    <ul>
                                                                        <li><a href="#">Icon Anchor <span class="fa fa-anchor"></span></a></li>
                                                                        <li><a href="#">Icon Bpmb <span class="fa fa-bomb"></span></a></li>
                                                                        <li><a href="#">Icon Cloud <span class="fa fa-cloud"></span></a></li>
                                                                        <li><a href="#">Icon Crop <span class="fa fa-crop"></span></a></li>
                                                                        <li><a href="#">Icon Fax <span class="fa fa-fax"></span></a></li>
                                                                    </ul>
                                                                </div><!-- end box -->
                                                            </div><!-- end col -->
                                                        </div><!-- end row -->
                                                    </div><!-- end ttmenu-content -->
                                                </li>
                                            </ul>
                                        </li><!-- end mega menu -->
                                        <li class="dropdown ttmenu-full"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Contact <b class="dropme"></b></a>
                                            <ul class="dropdown-menu vertical-menu">
                                                <li>
                                                    <div class="ttmenu-content">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="box">
                                                                    <ul>
                                                                        <li><h4>CONTACT DETAILS</h4></li>
                                                                        <li><a href="#">support@yoursite.com <span class="fa fa-envelope-o"></span></a></li>
                                                                        <li><a href="#">www.yoursite.com <span class="fa fa-link"></span></a></li>
                                                                        <li><a href="#">(0) +911 333 44 55  <span class="fa fa-phone"></span></a></li>
                                                                        <li><a href="#">(0) +911 333 44 80  <span class="fa fa-fax"></span></a></li>
                                                                        <li><a href="#">Envato, King Street,<br> Melbourne, Victoria, Avustralya</a></li>
                                                                    </ul>
                                                                </div><!-- end box -->
                                                            </div><!-- end col -->
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="box">
                                                                        <br>
                                                                        <form id="contact" action="#" class="row" name="contactform" method="post">
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                                <input name="name" id="name2" class="form-control" placeholder="Name" type="text">
                                                                                <input name="email" id="email2" class="form-control" placeholder="Email" type="text">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                                <input name="phone" id="phone2" class="form-control" placeholder="Phone" type="text">
                                                                                <input name="subject" id="subject2" class="form-control" placeholder="Subject" type="text">
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <textarea class="form-control" name="comments" id="comments2" rows="6" placeholder="Your Message ..."></textarea>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="pull-left">
                                                                                    <input value="SEND" id="submit2" class="btn btn-primary small" type="submit">
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div><!-- end box -->
                                                                </div><!-- end row -->
                                                            </div><!-- end col -->
                                                            <div class="col-md-3">
                                                                <div class="box">
                                                                    <ul>
                                                                        <li><h4>OTHER NOTES</h4></li>
                                                                        <li><p>Finibus Bonorum et Malorum" are also form, accompanied by English versions from the  accompanied by English versions from theaccompanied by English versions from the 1914 translation by H. Rackham.</p></li>
                                                                    </ul>
                                                                </div><!-- end box -->
                                                            </div><!-- end col -->
                                                        </div><!-- end row -->
                                                    </div><!-- end ttmenu content -->
                                                </li>
                                            </ul>
                                        </li><!-- end mega menu -->
                                    </ul><!-- end nav navbar-nav -->
                                </div><!--/.nav-collapse -->
                            </div><!-- end navbar navbar-default clearfix -->
                        </div><!-- end menu 1 -->
                    </div>
                </div>
                <div class="col-sm-6 no-padding" >
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($slides as $key=>$slide)
                                <li data-target="#slider-carousel" data-slide-to="{{$key}}" @if($key==0)class="active" @endif></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner">
                            @foreach($slides as $key=>$slide)
                                <div class="item @if($key == 0)active @endif">
                                        <img src="images/home/{{$slide->image}}" alt="" />
                                        {{--<img src="images/home/pricing.png"  class="pricing" alt="" />--}}
                                        <div class="header-text">
                                            <h3>{{$slide->name}}</h3>
                                            <a href="{{url('product_detail/'.$slide->product_id)}}" class="btn btn-default get">Get it now</a>
                                        </div>
                                </div>
                            @endforeach
                        </div>

                        {{--<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>--}}
                    </div>
                </div>
                <div class="col-sm-3 no-padding">
                    <div id="recommended-item-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="item active ">
                                    <img src="{{asset('images/home/banner-top-right.jpg')}}" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/slider-->

    <section>
        <div class="container">
            <div class="row white-bg">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                            <div class="hidden panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Mens
                                        </a>
                                    </h4>
                                </div>
                                <div id="mens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Fendi</a></li>
                                            <li><a href="#">Guess</a></li>
                                            <li><a href="#">Valentino</a></li>
                                            <li><a href="#">Dior</a></li>
                                            <li><a href="#">Versace</a></li>
                                            <li><a href="#">Armani</a></li>
                                            <li><a href="#">Prada</a></li>
                                            <li><a href="#">Dolce and Gabbana</a></li>
                                            <li><a href="#">Chanel</a></li>
                                            <li><a href="#">Gucci</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Womens
                                        </a>
                                    </h4>
                                </div>
                                <div id="womens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Fendi</a></li>
                                            <li><a href="#">Guess</a></li>
                                            <li><a href="#">Valentino</a></li>
                                            <li><a href="#">Dior</a></li>
                                            <li><a href="#">Versace</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{url('products')}}">All Products</a></h4>
                                </div>
                            </div>
                            @foreach($categories as $category)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{url('products/'.$category->id)}}">{{$category->name}}</a></h4>
                                </div>
                            </div>
                            @endforeach
                            {{--<div class="panel panel-default">--}}
                                {{--<div class="panel-heading">--}}
                                    {{--<h4 class="panel-title">--}}
                                        {{--<a data-toggle="collapse" data-parent="#morecate" href="#morecate">--}}
                                            {{--<span class="badge pull-right"><i class="fa fa-plus"></i></span>--}}
                                            {{--More Categoires--}}
                                        {{--</a>--}}
                                    {{--</h4>--}}
                                {{--</div>--}}
                                {{--<div id="morecate" class="panel-collapse collapse">--}}
                                    {{--<div class="panel-body">--}}
                                        {{--<ul>--}}
                                            {{--<li><a href="#">Nike </a></li>--}}
                                            {{--<li><a href="#">Under Armour </a></li>--}}
                                            {{--<li><a href="#">Adidas </a></li>--}}
                                            {{--<li><a href="#">Puma</a></li>--}}
                                            {{--<li><a href="#">ASICS </a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        </div><!--/category-products-->
                        <!--<div class="price-range">
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div>-->

                        <div class="shipping text-center"><!--shipping-->
                            <img src="images/home/shipping.jpg" alt="" />
                        </div><!--/shipping-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @foreach($feature_items as $feature)
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{url('product_detail/'.$feature->id)}}"><img src="http://ecammall.com/stock/assets/uploads/{{$feature->image}}" alt="" /></a>
                                        <h2>$ {{sprintf('%0.2f', $feature->price)}}</h2>
                                        <p>{{substr($feature->name,0,20)}}...</p>
                                        <a href="{{url('product_detail/'.$feature->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>
                                    </div>
                                    {{--<div class="product-overlay">--}}
                                        {{--<div class="overlay-content">--}}
                                            {{--<h2>$ {{sprintf('%0.2f', $feature->price)}}</h2>--}}
                                            {{--<p>{{$feature->name}}</p>--}}
                                            {{--<a href="{{url('product_detail/'.$feature->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Add to Cart</a></li>
                                        <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--features_items-->
                </div>
            </div>
                <?php
                    $ArrayTop = ['0','1','2'];
                    $category = \App\Category::join('sma_subcategories','sma_categories.id','=','sma_subcategories.category_id')
                    ->select('sma_categories.*')
                    ->groupBy('id')
                    ->get();
                ?>
                @foreach($category as $cat)
                <div class="row white-bg margin-top">
                    <div class="col-sm-3">
                        <div class="left-sidebar ">
                        <h2>{{$cat->name}}</h2>
                        <div class="panel-group category-products" id="accordian" style="height: 341px"><!--category-productsr-->
                            <?php $subcategory = \App\SubCategory::where('category_id',$cat->id)->get();
                                  $subcategoryMiddle = \App\SubCategory::where('category_id',$cat->id)->take(6)->orderBy('id','desc')->get();
                                  $slide_category = \App\CategorySlide::where(['category_id'=>$cat->id,'status'=>0])->get();
                            ?>
                            @foreach($subcategory as $subCat)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="{{url('products/category/'.$subCat->id)}}">{{$subCat->name}}</a></h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--/category-products-->
                        </div>
                    </div>
                    <div class="col-sm-6" style="padding-top: 15px">
                        <div class="features_items">
                            @foreach($subcategoryMiddle as $key=>$subCat)
                            <div class="col-sm-4 col-xs-6">
                                <div class="category-image">
                                    <a href="{{url('products/category/'.$subCat->id)}}">
                                        @if(empty($subCat->image))
                                            <img src="http://ecammall.com/stock/assets/uploads/no_image.png" alt="" class="img-responsive" />
                                        @else
                                            <img src="http://ecammall.com/stock/assets/uploads/{{$subCat->image}}" alt="" class="img-responsive" />
                                        @endif
                                    </a>
                                </div>
                                <div class="productinfo text-center">
                                    <a href="{{url('products/category/'.$subCat->id)}}" class="btn btn-default add-to-cart">{{$subCat->name}}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-3 nopadding">
                        <div id="recommended-item-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                            <div class="carousel-inner">
                                @foreach($slide_category as $key=>$CatSlide)
                                <div class="item @if($key == 0) active @endif">
                                    <div class="col-sm-12" style="padding-top: 15px">
                                        <img src="{{asset('images/home/'.$CatSlide->image)}}" class="img-responsive">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            <div class="row white-bg">
                <div class="category-tab"><!--category-tab-->
                    <div class="col-sm-12 no-padding">
                        <ul class="nav nav-tabs">
                            @foreach($categories as $key=>$category)
                            <li class="@if($key == 6) active @endif"><a href="#{{$category->id}}" data-toggle="tab">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content">
                        @foreach($categories as $key=>$category)
                        <div class="tab-pane fade @if($key == 6 )active in @endif" id="{{$category->id}}" >
                            <?php
                            $category_blog = \App\Product::
                            join('sma_categories','sma_products.category_id','=','sma_categories.id')
                                ->select('sma_products.*','sma_categories.name as c_name','sma_categories.id as c_id')
                                ->where('sma_products.category_id',$category->id)
                                ->orderBy('sma_products.id','desc')
                                ->take(12)
                                ->get();
                            ?>
                            @foreach($category_blog as $key=>$item)
                                @if($category->id == $item->category_id)
                            <div class="col-sm-2">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{url('product_detail/'.$item->id)}}"><img src="http://ecammall.com/stock/assets/uploads/{{$item->image}}" alt="" /></a>
                                            <h2>${{sprintf('%0.2f', $item->price)}}</h2>
                                            <p>{{substr($item->name,0,15)}}...</p>
                                            <a href="{{url('product_detail/'.$item->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endif
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div><!--/category-tab-->
            </div>
            <div class="row white-bg margin-top">
                <div class="col-md-12">
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>
                        <div id="recommended-item-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="item active">
                                <?php $i = 0; ?>
                                @foreach($recomment_items as $key=>$recomment)
                                    @if($i%4 ==0)
                                            </div><div class="item">
                                    @endif
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <a href="{{url('product_detail/'.$recomment->id)}}"><img src="http://ecammall.com/stock/assets/uploads/{{$recomment->image}}" alt="" /></a>
                                                    <h2>$ {{sprintf('%0.2f', $recomment->price)}}</h2>
                                                    <p>{{substr($recomment->name,0,20)}} ... </p>
                                                    <a href="{{url('product_detail/'.$recomment->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; ?>
                                @endforeach
                                </div>
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!--/recommended_items-->
                </div>
            </div>
        </div>
    </section>
@endsection