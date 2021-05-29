<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="{{asset('images/favicon.ico')}}" rel="shortcut icon">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/DataTables/datatables.min.css')}}"/>
    <!-- Bootstrap Dropdown Hover CSS -->
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-dropdownhover.min.css')}}" rel="stylesheet">

    <!--Menu Style-->
    <!-- Font Awesome Styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('menu-style/css/font-awesome.css')}}">
    <!-- Bootstrap Styles -->
    {{--<link href="{{asset('menu-style/css/bootstrap.css')}}" rel="stylesheet">--}}
    <link href="{{asset('menu-style/menu.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <!-- DropZone CSS -->
    {{--<link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <!-- DropZone Js -->
    <![endif]-->
    {{--<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">--}}

    <!--code.jquery.com/jquery-1.12.4.js-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
<header id="header" class="white-bg"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="col-sm-12 no-padding">
            <?php
                $PromotionTop = \App\CategorySlide::where(['slide_type'=>4,'status'=>0])->first();
            ?>
            @if(!empty($PromotionTop))
            <img src="{{asset('images/home/'.$PromotionTop->image)}}" class="img-responsive">
            @endif
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href=""><i class="fa fa-phone"></i> (+855) 15 66 33 53</a></li>
                            <li><a href=""><i class="fa fa-envelope"></i> marketing@ecammall.com</a>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-4">
                    <div class="social-icons">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                    <div class="language">
                        <div class="btn-group dropdown">
                            <a class="btn dropdown-toggle usa" data-toggle="dropdown" data-hover="dropdown">
                                <img src="{{asset('images/en.png')}}"> English
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"style="min-width: 167px">
                                <li><a href="#"><img src="{{asset('images/kh.png')}}"> Khmer (ភាសាខ្មែរ)</a></li>
                                <li><a href="#"><img src="{{asset('images/ch.png')}}"> Chinese​​ (中文)</a></li>
                                <li><a href="#"><img src="{{asset('images/ko.png')}}"> Korea (대한민국)</a></li>
                                <li><a href="#"><img src="{{asset('images/jp.png')}}"> Japan (日本)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container no-padding">
            <div class="row">
                <div class="col-sm-2 no-padding">
                    <div class="logo pull-left">
                        <a href="{{url('/')}}"><img src="{{asset('images/ecammall/Logo.png')}}" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="search_box">
                        <?PHP
                        $category_head = \App\Category::where('parent_id',0)->pluck('name','id');
                        ?>
                        {!! Form::open(['url'=>'search','method'=>'GET','class'=>'searchform']) !!}
                            {!! Form::text('name',null,['placeholder'=>'Product title']) !!}
                            {!! Form::select('category_id',$category_head,null,['placeholder'=>'select any category...']) !!}
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-sm-3 no-padding">
                                @if(Auth::check() and Auth::user()->user_role == 1)
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li>
                                        <a href="{{url('em-admin')}}"><i class="fa fa-user"></i> Admin Site</a>
                                    </li>
                                    <li>
                                        @if(Auth::check())
                                            <a href="{{url('logout')}}"><i class="fa fa-unlock"></i> Logout </a>
                                        @else
                                            <a href="{{url('login')}}"><i class="fa fa-lock"></i> Login</a>
                                        @endif
                                    </li>
                                </ul>
                                @elseif(Auth::check() and Auth::user()->user_role == 0)
                                    <div class="col-sm-8 no-padding">
                                        <div class="shop-menu">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <a href="{{url('shopping-cart')}}">
                                                        <i class="fa fa-shopping-cart"></i> Cart
                                                        <span class="badge label-danger badge-cart">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
                                                    </a>
                                                </li>
                                                <?php
                                                    $wishList = '';
                                                if(Auth::check()){
                                                    $wishList = \App\WishList::where('user_id',Auth::user()->id)->count();
                                                }
                                                ?>
                                                <li><a href="{{url('em-user/'.Auth::user()->id.'/my_wishList')}}"><i class="fa fa-heart"></i> Wishlist
                                                        <span class="badge label-danger badge-wishList">{{$wishList}}</span>
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 no-padding">
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown" data-hover="dropdown">
                                                <i class="fa fa-user"></i> Hi,
                                                <?php $stringText  = Auth::user()->last_name;
                                                $name = explode(" ", $stringText);
                                                echo $name[0];
                                                ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <li>
                                                    <div class="form-group">
                                                        <a href="{{url('/logout')}}" class="btn btn-primary btn-block">Sign Out</a>
                                                    </div>
                                                </li>
                                                <?php
                                                $check_shop = \App\PageShops::where('user_id',Auth::user()->id)->first();
                                                ?>
                                                @if($check_shop)
                                                    <li><a href="{{url('em-user/'.Auth::user()->id.'/my_shop')}}"><i class="fa fa-building"></i> My Shop</a></li>
                                                    <li><a href="{{url('em-user/shop/'.$check_shop->shop_name.'/new_product')}}"><i class="fa fa-dropbox"></i> Post New Product</a></li>
                                                @else
                                                    <li><a href="{{url('em-user/'.Auth::user()->id.'/new_shop')}}">Create Shop</a></li>
                                                @endif
                                                <div class="divider"></div>
                                                <li><a href="{{url('em-user/'.Auth::user()->id.'/my_ecammall')}}">My eCamMall</a> </li>
                                                <li><a href="{{url('em-user/'.Auth::user()->id.'/my_orders')}}">My Orders</a> </li>
                                                <li><a href="#">Message Center</a> </li>
                                                <li><a href="{{url('em-user/'.Auth::user()->id.'/my_wishList')}}">Wish List</a> </li>
                                                <li><a href="#">My Favorites Stores</a> </li>
                                                <li><a href="{{url('em-user/'.Auth::user()->id.'/my_coupons')}}">My Coupons</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                        <div class="col-sm-9 no-padding">
                                            <div class="shop-menu">
                                                <ul class="nav navbar-nav">
                                                    <li><a href="{{url('shopping-cart')}}"><i class="fa fa-shopping-cart"></i> Cart <span class="badge label-danger">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span> </a></li>
                                                    <li><a href="#"><i class="fa fa-heart"></i> Wishlist</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 no-padding">
                                            <div class="btn-group dropdown">
                                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown" data-hover="dropdown" data-animations="fadeInUp">
                                                    <i class="fa fa-lock"></i> Login <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                Welcome to eCamMall
                                                                <div class="form-group">
                                                                    <a href="{{url('login')}}" class="btn btn-primary btn-block">Sign in</a>
                                                                </div>
                                                                <div class="social-buttons">
                                                                    SignIn via
                                                                    <a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i></a>
                                                                    <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i></a>
                                                                </div>
                                                                <div class="divider"></div>
                                                                New Customer ?
                                                                <div class="bottom">
                                                                    <a href="{{url('register')}}" class="btn btn-primary btn-block">Join Us</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li><a href="#">My eCamMall</a> </li>
                                                    <li><a href="#">My Orders</a> </li>
                                                    <li><a href="#">Message Center</a> </li>
                                                    <li><a href="#">Wish List</a> </li>
                                                    <li><a href="#">My Favorites Stores</a> </li>
                                                    <li><a href="#">My Coupons</a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                @endif
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
    @if(Request::is('/'))

    @elseif(Request::is('login') || Request::is('register'))
    @elseif(Request::is('em-user/*'))
        <div class="container">
            <div class="row white-bg">
                <div class="category-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="@yield('my_ecammall')"><a href="{{url('em-user/'.Auth::user()->id.'/my_ecammall')}}">My eCamMall</a></li>
                            <li class="@yield('my_order')"><a href="{{url('em-user/'.Auth::user()->id.'/my_orders')}}">My Orders</a></li>
                            <li class="@yield('my_wish')"><a href="{{url('em-user/'.Auth::user()->id.'/my_wishList')}}">Wish List</a> </li>
                            <li class="@yield('my_favorites')"><a href="#">My Favorites Stores</a> </li>
                            <li class="@yield('my_coupons')"><a href="#">My Coupons</a> </li>
                            <li class="@yield('my_account')"><a href="{{url('em-user/'.Auth::user()->id.'/my_account')}}">Account Settings</a> </li>
                            <?php
                            $check_shop = \App\PageShops::where('user_id',Auth::user()->id)->first();
                            ?>
                            @if($check_shop)
                                <li class="@yield('my_shop')"><a href="{{url('em-user/'.Auth::user()->id.'/my_shop')}}"> My Shop</a></li>
                                <li class="@yield('my_new_product')"><a href="{{url('em-user/shop/'.$check_shop->shop_name.'/new_product')}}">Post New Product</a></li>
                            @else
                                <li class="@yield('my_new_shop')"><a href="{{url('em-user/'.Auth::user()->id.'/new_shop')}}"> Create Shop</a></li>
                            @endif

                        </ul>
                    </div>
                </div><!--/category-tab-->
            </div>
        </div>
    @else
        <div class="container white-bg no-padding">
            <div class="hero" style="width: 1150px;">
                <div class="hovermenu ttmenu dark-style menu-color-gradient">
                    <div class="navbar navbar-default" role="navigation" style="margin-bottom: 0px">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            {{--<a class="navbar-brand" href="#"><i class="fa fa-home"></i></a>--}}
                        </div><!-- end navbar-header -->
                        <div class="navbar-collapse collapse" style="height: 1px;">
                            <ul class="nav navbar-nav">
                                <li class="dropdown ttmenu-full"><a href="#" data-toggle="dropdown" class="dropdown-toggle">All Categories <b class="dropme"></b></a>
                                    <ul id="first-menu" class="dropdown-menu" style="top: 30px;">
                                        <li>
                                            <div class="ttmenu-content">
                                                <div class="tabbable row">
                                                    <div class="col-md-3 gray-bg">
                                                        <ul class="nav nav-pills-menu nav-stacked">
                                                            <?php $categories_menu = \App\Category::where('parent_id',0)
                                                                ->get(); ?>
                                                            @foreach($categories_menu as $key=>$category)
                                                                <li @if($key == 0) class="active" @endif><a href="#tabs5-pane{{$category->id}}" data-toggle="tab">{{$category->name}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div><!-- end col -->
                                                    <div class="col-md-9">
                                                        <div class="tab-content">
                                                            @foreach($categories_menu as $key => $cat)
                                                                <div id="tabs5-pane{{$cat->id}}" class="tab-pane active">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                                            <div class="box">
                                                                                <ul>
                                                                                    <li><h4> {{$cat->name}}</h4></li>
                                                                                </ul>
                                                                                    <?php
                                                                                    $subcategory = \App\Category::where('parent_id',$cat->id)->get();
                                                                                    ?>
                                                                                    @foreach($subcategory as $sub)
                                                                                        <div class="col-sm-3">
                                                                                            <p>
                                                                                                <a href="{{url('products/category/'.$sub->id)}}">{{$sub->name}}</a>
                                                                                            </p>
                                                                                        </div>
                                                                                    @endforeach
                                                                            </div><!-- end box -->
                                                                        </div><!-- end col -->
                                                                    </div><!-- end row -->
                                                                </div>
                                                            @endforeach
                                                        </div><!-- /.tab-content -->
                                                    </div><!-- end col -->
                                                </div><!-- /.tabbable -->
                                            </div><!-- end ttmenu-content -->
                                        </li>
                                    </ul>
                                </li><!-- end mega menu -->
                                <li class="@yield('brand_zone')"><a href='{{url('brand_zone')}}'>Brand Zone</a></li>
                                <li class="@yield('beauty')"><a href="{{url('beauty')}}">Beauty</a></li>
                                <li class="@yield('cloth')"><a href="{{url('cloth')}}">Cloth</a> </li>
                                <li class="@yield('best_sale')"><a href="{{url('best_seller')}}">Best Seller</a> </li>
                                <li class="@yield('store_zone')"><a href="{{url('store_zone')}}">Store Zone</a> </li>
                                <li class="@yield('discount_deal')"><a href="{{url('discount_deal')}}">50% Off</a> </li>
                                <li class="@yield('promotion')"><a href="{{url('promotion')}}">Promotion</a> </li>
                                <!-- end mega menu -->
                            </ul><!-- end nav navbar-nav -->
                        </div><!--/.nav-collapse -->
                    </div><!-- end navbar navbar-default clearfix -->
                </div><!-- end menu 1 -->
            </div><!-- end hero -->
        </div>
        @if(Request::is('brand_zone') || Request::is('beauty') || Request::is('cloth') || Request::is('best_seller') || Request::is('store_zone') || Request::is('discount_deal'))
        <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="menu-tab"><!--category-tab-->
                            <ul class="nav nav-tabs" style="margin-bottom: 0px;">
                                <li><a href="{{url('/')}}" class="active">Home</a></li>
                                <?php $category_menu = \App\Category::where('parent_id',0)->orderBy('id','desc')->get() ?>
                                @foreach($category_menu as $item)
                                    <li><a href="{{url('products/'.$item->id)}}">{{$item->name}}</a></li>
                                @endforeach
                                <li><a href="{{url('contact')}}">Contact</a></li>
                            </ul>
                        </div><!--/category-tab-->
                    </div>
                </div>
            </div><!--/header-bottom-->
        @endif
    @endif
</header><!--/header-->

    @yield('content')
@if(Request::is('login') || Request::is('register') || Request::is('em-user/*'))
@else
<?php
    $pageManageProCity = \App\PageManagement::where('block','pro_city_brand_page')->first();
?>
@if($pageManageProCity->status == 0)
<section>
    <div class="container">
        <div class="row white-bg">
            <div class="category-tab shop-details-tab"><!--category-tab-->
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#city">City</a></li>
                        <li><a data-toggle="tab" href="#brand">Brand</a></li>
                        {{--<li class="active"><a data-toggle="tab" href="#tag">Related</a></li>--}}
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="city" class="tab-pane fade active in">
                        <div class="col-sm-12">
                                <?php
                                $cities = \App\City::get();
                                ?>
                                @foreach($cities as $city)
                                    <div class="col-sm-3">
                                        <a href="{{url('products/cities/'.$city->id)}}"> {{$city->name}}</a>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                    <div id="brand" class="tab-pane fade">
                        <div class="col-sm-12">
                                <?php
                                $brands = \App\Brand::get();
                                ?>
                                @foreach($brands as $brand)
                                    <div class="col-sm-1" style="padding-left: 1px;padding-right: 1px">
                                        <a href="{{url('products/brands/'.$brand->id)}}">
                                            <img src="http://ecammall.com/stock/assets/uploads/{{$brand->image}}" class="img-responsive img-brand-zone">
                                        </a>
                                    </div>
                                @endforeach
                        </div>
                    </div>

                </div>
            </div><!--/category-tab-->
        </div>
    </div>
</section>
@endif
@endif
<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- <div class="col-sm-12"> -->
                <div class="col-sm-12 companyinfo">
                    <h2><span>Our</span> Partner</h2>
                </div>
                <?php $FooterImage = \App\CategorySlide::where(['status'=>0,'slide_type'=>'6'])->get()?>
                @foreach($FooterImage as $IMG)
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="video-gallery text-center">
                            <div class="iframe-img">
                                @if(!empty($IMG->image))
                                    <a href="{{url($IMG->url)}}" target="_blank">
                                @else
                                    <a href="{{url('/')}}">
                                @endif
                                <img src="{{asset('images/home/'.$IMG->image)}}" alt="" />
                                    </a>
                            </div>
                            {{--<div class="overlay-icon">--}}
                                {{--<i class="fa fa-play-circle-o"></i>--}}
                            {{--</div>--}}
                        <!-- <p>Circle of Hands</p>
                        <h2>24 DEC 2014</h2> -->
                    </div>
                </div>
                @endforeach
                <!-- </div> -->
            </div>
        </div>
    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <?php $footers = \App\FooterType::with('FooterPage')->get(); ?>
                @foreach($footers as $footer)
                <div class="col-sm-3 col-xs-12">
                    <div class="single-widget">
                        <h2>{{$footer->name}}</h2>
                        <ul class="nav nav-pills nav-stacked">
                            @foreach($footer->FooterPage as $FooterDes)
                            <li><a href="@if(!empty($FooterDes->url)){{url($FooterDes->url)}}@else {{url('footer/'.$footer->name.'/'.$FooterDes->name)}}@endif">{{$FooterDes->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach

                <div class="col-sm-3 col-xs-12">
                    <div class="single-widget">
                        <h2>Subscribe</h2>
                        <form action="#" class="subscribe">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{asset('images/home/appstore.png')}}">
                                </div>
                                <div class="col-md-6">
                                    <img src="{{asset('images/home/googleplay.png')}}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2016 by eCamMall Pvt. Ltd., All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.ecammall.com/">eCamMall</a></span></p>
                <!-- credit to Themeum Free theme -->
            </div>
        </div>
    </div>

</footer><!--/Footer-->

<div class="modal fade myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>Sorry, only registered members are allowed to <span id="change_text"> </span>. </p>
            </div>
            <div class="modal-body">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    {!! Form::open(['url'=>'/login','method'=>'POST','role'=>'form']) !!}
                    <div class="form-group @if($errors->has('email')) has-error @endif">
                        {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter Email']) !!}
                        <p class="help-block">{!! implode('<br/>', $errors->get('email')) !!}</p>
                    </div>
                    <div class="form-group @if($errors->has('password')) has-error @endif">
                        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password']) !!}
                        <p class="help-block">{!! implode('<br/>', $errors->get('password')) !!}</p>
                    </div>

                    <button type="submit" class="btn btn-default">Login</button>
                    {!! Form::close() !!}
                </div><!--/login form-->
            </div>
            <div class="modal-footer">
                <p> Not a member yet?  <a href="/register"> Register </a> today. It's Free! </p>
                <p> Already a member?  <a href="/login"> Login</a> </p>
            </div>
        </div>
    </div>
</div>



<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
{{--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>--}}
{{--<script type="text/javascript" src="js/gmaps.js"></script>--}}
{{--<script src="js/contact.js"></script>--}}
<script src="{{asset('js/price-range.js')}}"></script>
<script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
{{--<script src="{{asset('js/main.js')}}"></script>--}}

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
{{--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
<script src="{{asset('js/big-image/lib/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('js/big-image/jquery-big-image.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('textarea').ckeditor();
        $.noConflict();
        $(function() {
            $('a.zoom').bigImage({
                zoom: {
                    maskElement: function() {
                        return $('<div/>', { 'class': 'zoom-mask' });
                    }
                }
            });
            $('a.change-image').click(function() {
                var url = $(this).attr('href');
                //$('.big a').attr('href', url);
                $('a.zoom').bigImage('changeImage', {
                    smallImageUrl: url,
                    largeImageUrl: url,
                });
            });
        });

        $('#product_category_id').change(function(){
            var categoryID = $(this).val();
            $.ajax({
                dataType: "html",
                type: "GET",
                evalScripts: true,
                url: "/get_categoryID/"+categoryID,
                success: function(subcat) {
                    $('#sub_category_id').html(subcat);

                }
            });
            $.ajax({
                dataType: "html",
                type: "GET",
                evalScripts: true,
                url: "/get_brand/"+categoryID,
                success: function(brand) {
                    $('#brand').html(brand);
                }
            });
        });
        $('.btn-addToCart').click(function () {
           var productId = $(this).attr('id');
           var quantityOrder = $('.quantity_order').val();
           var productFrom = $('.product_from').val();
           $.ajax({
               dataType:"html",
               type:"GET",
               evalScripts: true,
               url:"/add-to-cart/"+productId+"/product_from/"+productFrom+"/qty_order/"+quantityOrder,
               success:function (totalQty) {
                   $('.badge-cart').html(totalQty);
               }
           })
        });
        $('.btn-wishList').click(function () {
            var productId = $(this).attr('id');
            var productFrom = $('.product_from').val();
            $.ajax({
                dataType:"html",
                type:"GET",
                evalScripts: true,
                url:"/add-to-wishList/"+productId+"/product_from/"+productFrom,
                success:function (totalWish) {
                    $('.badge-wishList').html(totalWish);
                }
            })
        });
        //script add new product
        $('#price').keyup(function () {
            var price = $(this).val();
            var discountRate = $('#discount_rate').val();
            var price_after_discount = $('#price_after_discount').val();
            if(discountRate.length == 0){
                $('#price_after_discount').val(price);
            }else{
                var result = Number(price *(1-discountRate/100)).toFixed(2);
                $('#price_after_discount').val(result);
            }
        });
        $('#discount_rate').keyup(function () {
            var price = $('#price').val();
            var discountRate = $('#discount_rate').val();
            var price_after_discount = $('#price_after_discount').val();
            if(discountRate > 100){
                alert('Discount Can not Bigger than 100');
                $('#discount_rate').val(0);
                $('#price_after_discount').val(price);
            }else{
                if(price.length == 0){
                    $('#price_after_discount').val(price);
                }else{
//                var result = Number(price -((discountRate/100)*price)).toFixed(2);
                    var result = Number(price *(1-discountRate/100)).toFixed(2);
                    $('#price_after_discount').val(result);
                }
            }
        });
//        $('body').delegate('.cart_check','click',function () {
//            alert(0)
//            var qty=$(this).find('.cart_quantity_input').val()-0;
//            var price = $(this).find('.cart_price').val()-0;
//            var amount = Number(qty * price).toFixed(2);
//            if(qty >0)
//            {
//                $(this).find('.cart_quantity_input').html(qty);
//                $(this).find('.cart_total_price').val(amount);
//                $(this).find('.cart_total_price_input').val(amount);//amount
//            }
//            else
//            {
//                alert('Enter something.');
//            }
//        });
        $('.quantity_order').change(function(){
            var quantity_order = $(this).val();
            var quantity_in_stock = $('.quantity_in_stock').val();
            if(quantity_order > quantity_in_stock){
                alert('Quantity order is bigger than quantity in stock!!!');
                $(this).val(1);
            }

        });
//        $('body').delegate('.cart','click',function () {
//            var cart = $(this).attr('id');
//            var quantity_order = $('.quantity_order').val();
//            alert(quantity_order);
//        })

        $('body').delegate('.cart_quantity_up','click',function () {
            var cart_price = $('.cart_price').attr('value');
            var quantity_input = $('.cart_quantity_input').val()-0;
            $('.cart_quantity_input').val(quantity_input+1);
            var quantity_input_update = $('.cart_quantity_input').val();
            $('.cart_total_price').html('$ '+Number(cart_price*quantity_input_update).toFixed(2));
            $('.cart_total_price_input').val(Number(cart_price*quantity_input_update).toFixed(2));
            $('.amount').val(Number(cart_price*quantity_input_update).toFixed(2));
            $('.total').val(Number(cart_price*quantity_input_update).toFixed(2));

        });
        $('body').delegate('.cart_quantity_down','click',function () {
            var cart_price = $('.cart_price').attr('value');
            var quantity_input = $('.cart_quantity_input').val()-0;
            if(quantity_input >1){
                $('.cart_quantity_input').val(quantity_input-1);
                var quantity_input_update = $('.cart_quantity_input').val();
                $('.cart_total_price').html('$ '+Number(cart_price*quantity_input_update).toFixed(2));
                $('.cart_total_price_input').val(Number(cart_price*quantity_input_update).toFixed(2));
                $('.amount').val(Number(cart_price*quantity_input_update).toFixed(2));
                $('.total').val(Number(cart_price*quantity_input_update).toFixed(2));

            }else{
                alert('quantity less than 1');
            }
        })
        $('body').delegate('.shopping_cart_check','keyup',function () {
            var cart_quantity_input = $('.cart_quantity_input').val()-0;
            var cart_total_price_input = $('.cart_total_price_input').val()-0;
//            alert(cart_quantity_input);
        });
        $('body').delegate('.cart_quantity_delete','click',function () {
            if(confirm('You sure to remove this order item ?')) {
                var id = $(this).attr('id');
                var $row = $(this).parents('.cart_check');
                $row.remove();
                $.ajax({
                    dataType:"html",
                    type:"GET",
                    evalScripts: true,
                    url:'{{url('remove_item_cart')}}/'+id,
                    success:function (totalQty) {
                        $('.badge-cart').html(totalQty);
                    }
                })

            }
        });
        $('body').delegate('.pending_order_delete','click',function () {
            if(confirm('You sure to remove this order item ?')) {
                var id = $(this).attr('id');
                var $row = $(this).parents('.cart_check');
                $row.remove();
                $.ajax({
                    dataType:"html",
                    type:"GET",
                    evalScripts: true,
                    url:'{{url('pending_order_delete_item')}}/'+id,
                    success:function (totalQty) {
                        $('.badge-cart').html(totalQty);
                    }
                })

            }
        });
        $(".delete_thumb").click(function(){
            if(confirm('You sure to remove this image ?')) {
                var id = $(this).attr('id');
                var $row = $(this).parents('.row_thumb');
                $row.remove();
                $.ajax({
                    dataType:"html",
                    type:"GET",
                    evalScripts: true,
                    url:'{{url('delete_thumbnail')}}/'+id,
                    success:function () {
                    }
                })

            }
        });
        $(".delete_feature_image").click(function(){
            if(confirm('You sure to remove this image ?')){
                var id = $(this).attr('id');
                var type = $(this).attr('name');
                $.ajax({
                    dataType:"html",
                    type:"GET",
                    evalScripts: true,
                    url:'{{url('delete_feature_image')}}/'+type+'/product_id/'+id,
                    success:function () {
                        if(type == 1){
                            $(".feature_image").remove();
                        }
                        else if(type == 2){
                            $(".feature_image_1").remove();
                        }
                        else if(type == 3){
                            $(".feature_image_2").remove();
                        }
                        else if(type == 4){
                            $(".feature_image_3").remove();
                        }
                        else if(type == 5){
                            $(".feature_image_4").remove();
                        }
                    }
                })
            }
        });
        $('ul.nav li.dropdown').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
        });

        $("#shop_name").keyup(function(){
            var shopName = $(this).val();
            var baseUrl = 'http://ecammall.com/shop/';
            var website = baseUrl+convertToSlug(shopName);
            $("#website").val(website);
        });
        function convertToSlug(shopName)
        {
            return shopName
                .toLowerCase()
                .replace(/ /g,'-')
                .replace(/[^\w-]+/g,'')
                ;
        }
    });
</script>
<!--Menu Script-->
<!-- Main Scripts-->
<script src="{{asset('menu-style/js/jquery.js')}}"></script>
<script src="{{asset('menu-style/js/bootstrap.min.js')}}"></script>
<script src="{{asset('menu-style/js/search.js')}}"></script>
<script src="{{asset('menu-style/js/ttmenu.js')}}"></script>
<script src="{{asset('menu-style/js/jquery.fitvids.js')}}"></script>
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<!-- Bootstrap Dropdown Hover JS -->
<script src="{{asset('js/bootstrap-dropdownhover.min.js')}}"></script>
</body>
</html>
