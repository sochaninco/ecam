<?php
if(Auth::check()){
    $checkParent = \App\User::where('id',Auth::user()->id)->first();
    if($checkParent->parent_id != 0){
        $userId = $checkParent->parent_id;
    }elseif ($checkParent->user_role == 1){
        $userId = isset($userId)?$userId:'';
    }
    else{
        $userId = $checkParent->id;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('og')
    <title>@yield('title')</title>
    <!-- DropZone CSS -->
    {{--<link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <link href="{{asset('favicon.ico')}}" rel="shortcut icon">
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


    <!-- Time countdown -->
    <link href="{{asset('css/timeTo.css')}}" rel="stylesheet">
    <!--Menu Style-->
    <!-- Font Awesome Styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('menu-style/css/font-awesome.css')}}">

    <!-- Font Awesome JS -->
    {{--<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>--}}
    <!-- Bootstrap Styles -->
    {{--<link href="{{asset('menu-style/css/bootstrap.css')}}" rel="stylesheet">--}}
    <link href="{{asset('menu-style/menu.css')}}" rel="stylesheet">
    <link href="{{asset("css/style-chat-box.css")}}" rel="stylesheet">

    <!-- Bootstrap CSS CDN -->
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">--}}
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('menu-style/menu-sidebar.css')}}">
    <!-- Scrollbar Custom CSS -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">--}}
    <!--[if lt IE 9]>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>

    <!-- DropZone Js -->
    <![endif]-->
    {{--<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">--}}

    <!--code.jquery.com/jquery-1.12.4.js-->
    {{--<link rel="shortcut icon" href="images/ico/favicon.ico">--}}
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">

    <!--POP up-->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('bites/css/animate.css')}}" />

    <!-- Bites Theme CSS -->
    <link rel="stylesheet" href="{{asset('bites/css/bites-theme.css')}}" />

    <style>
        #bite-38 .modal-header{
            min-height: 0px;
        }
        #bite-38 .close {
            margin: 0;
            position: absolute;
            top: -15px;
            right: -10px;
            opacity: 1;
            outline: 0;
            z-index: 2;
            background-color: #ccc;
            border-radius: 50%;
            border:2px solid #696763;
        }
        #bite-38 .modal-body img {
            border-radius: 10px !important;
            width: 570px;
        }
        @media only screen and (max-width: 575px) {
            #bite-38{
                width: 90%;
                margin: 0 auto;
                top: 30%;
            }
            #bite-38 .close:before {
                content: '';
                width: 10px;
                height: 10px;
                position: absolute;
                top: 4px;
                right: 5px;
                background-size: contain;
            }
            #bite-38 .close {
                margin: 0;
                position: absolute;
                top: 0px;
                right: 0px;
                opacity: 1;
                outline: 0;
                z-index: 2;
                background-color: #ccc;
                border-radius: 50%;
                padding: 10px;
                /*border: 1px solid #000;*/
            }
            #bite-38 img {
                width: 100%;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        /*$(window).on('load',function () {
//           $('.preloader').addClass('complete');
            $('.loader').addClass('hidden');
            $('.webpage').removeClass('hidden-xs');
        })*/
    </script>
<!--/Begin Google Analytic-->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125095471-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125095471-1');
</script>
<!--/End Google Analytic-->

</head><!--/head-->

<body>
    <header id="header" class="white-bg"><!--header-->
    <div class="col-sm-12 no-padding hidden-xs">
        <?php
        $PromotionTop = \App\CategorySlide::where(['slide_type'=>4,'status'=>0])->first();
        ?>
        @if(!empty($PromotionTop))
            @if(!empty($PromotionTop->url))
                <a href="https://{{$PromotionTop->url}}" @if($PromotionTop->open_new_tab ==1) target="_blank" @endif>
                    <img alt="" src="{{asset('images/home/'.$PromotionTop->image)}}" class="img-responsive">
                </a>
            @else
                <a href="{{url('product_detail/'.$PromotionTop->product_id)}}" >
                    <img alt="" src="{{asset('images/home/'.$PromotionTop->image)}}" class="img-responsive">
                </a>
            @endif
        @endif

    </div>
    <div class="col-sm-12 no-padding padding-bottom-1 hidden-lg">
        <?php
        $bannerM = \App\CategorySlide::where(['slide_type'=>16,'status'=>0])->first();
        ?>
        @if(!empty($bannerM))
            <a href="https://{{$bannerM->url}}" @if($bannerM->open_new_tab == 1)target="_blank" @endif> <img src="{{asset('images/home/'.$bannerM->image)}}" class="img-responsive"></a>
        @endif

    </div>
    <?php
    $pageManageMenuTop = \App\PageManagement::where('block','header_top_menu')->first();
    ?>
    @if($pageManageMenuTop->status == 0)
        <div class="header_top hidden-xs hidden-sm hidden-md"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href=""><i class="fa fa-phone"></i> (+855) 15 77 55 53</a></li>
                                <li><a href=""><i class="fa fa-envelope"></i> marketing@ecammall.com</a>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-4 padding-left-top-menu">
                        <div class="social-icons">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
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
    @endif
    <div class="header-middle" id="fixTop"><!--header-middle-->
        <div class="container no-padding hidden-xs">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 no-padding hidden-xs">
                    <div class="logo pull-left">
                        <a href="{{url('/')}}"><img src="{{asset('images/ecammall/Logo.gif')}}" alt="" /></a>
                    </div>
                </div>
                <div class="col-xs-12 no-padding hidden-sm hidden-md hidden-lg visible-xs" align="center">
                    <div class="logo hidden-xs">
                        <a href="{{url('/')}}"><img src="{{asset('images/ecammall/Logo.gif')}}" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-7 col-md-5  col-lg-6 no-padding col-xs-12">
                    <div class="search_box">
                        <?PHP
                        $category_head = \App\Category::where('parent_id',0)->pluck('name','id');
                        ?>
                        <div class="hidden-xs">
                            {!! Form::open(['url'=>'search','method'=>'GET','class'=>'searchform']) !!}
                            {!! Form::text('name',null,['placeholder'=>'Search by product title']) !!}
                            {!! Form::select('category_id',$category_head,null,['placeholder'=>'select any category...']) !!}
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            {!! Form::close() !!}
                        </div>
                        <div class="visible-xs">
                            {!! Form::open(['url'=>'search','method'=>'GET','class'=>'searchform']) !!}
                            {!! Form::text('name',null,['placeholder'=>'Search by product title']) !!}
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            {!! Form::close() !!}
                        </div>
                        <div class="search-history">
                            <p>
                                <?Php
                                $searchKeywords = \App\SearchKeyword::where('type',0)->inRandomOrder()->take(6)->get();
                                ?>
                                @foreach($searchKeywords as $keyword)
                                    @if($keyword->link_to == 0)
                                        <a href="{{url('search?name='.$keyword->keyword.'&category_id=')}}">{{$keyword->keyword}} </a> <span>|</span>
                                    @elseif($keyword->link_to == 2)
                                        <a href="{{url('products/category/'.$keyword->sub_category_id)}}"> {{$keyword->keyword}} </a> <span>|</span>
                                    @else
                                        <a href="{{url('products/'.$keyword->category_id)}}"> {{$keyword->keyword}} </a> <span>|</span>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>


                </div>
                <div class="col-sm-2 col-md-3 col-lg-3 no-padding hidden-xs ">
                    @if(Auth::check() and Auth::user()->user_role == 1)
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li>
                                <a href="{{url('em-admin')}}"><i class="fa fa-user"></i> Admin Site</a>
                            </li>
                            <li>
                                @if(Auth::check())
                                    {{--{!! Form::open(['method'=>'POST','route'=>'logout']) !!}--}}
                                    <a href="{{url('logout')}}"><i class="fa fa-unlock"></i> Logout </a>
                                    {{--<a href="javascript:;" onclick="parentNode.submit();"> <i class="fa fa-unlock"></i> Logout</a>--}}
                                    {{--<button type="submit" class=><i class="fa fa-unlock"></i> Logout </button>--}}
                                    {{--{!! Form::close() !!}--}}
                                @else
                                    <a href="{{url('login')}}"><i class="fa fa-lock"></i> Login</a>
                                @endif
                            </li>
                        </ul>
                    @elseif(Auth::check() and Auth::user()->user_role == 0)
                        <div class="col-sm-9 col-md-8 no-padding col-xs-8 hidden-sm">
                            <div class="shop-menu">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <div class="btn-group dropdown">
                                            <a class="btn dropdown-toggle login-info" data-toggle="dropdown" data-hover="dropdown">
                                                <table>
                                                    <tr>
                                                        <td><img src="{{asset('images/cart.png')}}" width="33px" height="35px"></td>
                                                        <td><span class="badge label-danger badge-cart">{{Session::has('cart') ? Session::get('cart')->totalQty : '0'}}</span>
                                                            <br>
                                                            Cart</td>
                                                    </tr>
                                                </table>
                                            </a>
                                            <?php
                                            if(!Session::has('cart')){
                                                $products = null;
                                                $total_price = 0;
                                            }else{
                                                $oldCart = Session::get('cart');
                                                $cart = new \App\Cart($oldCart);
                                                $products = $cart->items;
                                                $total_price = $cart->totalPrice;
                                            }

                                            ?>
                                            @if(Session::has('cart'))
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"style="min-width: 250px">
                                                    @foreach($products as $product)
                                                        <?php
                                                        $firstImage = \App\Thumbnails::where('product_id',$product['id'])->first();
                                                        $imageName = isset($firstImage->image)?$firstImage->image:$product['item']['image'];
                                                        ?>
                                                        <li>
                                                            <div class="col-sm-4">
                                                                @if($product['product_from'] == 0)
                                                                    <a href="{{url('shop/product_detail/'.$product['item']['id'])}}">
                                                                        <img src="{{asset('images/thumbnails/shop/'.$imageName)}}" alt="" width="auto" height="50px"/>
                                                                    </a>
                                                                @else
                                                                    <a href="{{url('product_detail/'.$product['item']['id'])}}">
                                                                        <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$product['item']['image']}}" width="auto" height="50px">
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p>{{$product['item']['name']}}</p>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                    <div class="divider"></div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <p>Subtotal :</p>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6">
                                                        {{number_format($total_price,2)}} $
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <a href="{{url('shopping-cart')}}">Shopping Cart</a>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <a href="{{url('shopping_cart/buy_now_from_cart')}}">Check Out</a>
                                                        </div>
                                                    </div>
                                                </ul>
                                            @endif
                                        </div>
                                    </li>
                                    <?php
                                    $wishList = '0';
                                    if(Auth::check()){
                                        $wishList = \App\WishList::where('user_id',$userId)->count();
                                    }
                                    ?>
                                    <li><a href="{{url('em-user/'.$userId.'/my_wishList')}}">
                                            <table>
                                                <tr>
                                                    <td><i class="fa fa-heart-o"></i></td>
                                                    <td><span class="badge label-danger badge-wishList">{{$wishList}}</span>
                                                        <br>Wishlist
                                                    </td>
                                                </tr>
                                            </table>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2 no-padding col-xs-4">
                            <div class="btn-group dropdown" style="right: 16px;">
                                <button type="button" class="btn btn-default dropdown-toggle login-info" data-toggle="dropdown" data-hover="dropdown">
                                    <img src="{{asset('images/'.Auth::user()->image)}}" width="20px" height="20px" class="img-rounded"> Hi,
                                    <?php $stringText  = Auth::user()->last_name;
                                    $name = explode(" ", $stringText);
                                    echo $name[0];
                                    ?> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li>
                                        <div class="form-group">
                                            {!! Form::open(['method'=>'POST','route'=>'logout']) !!}
                                            {{--<a href="{{url('logout')}}"><i class="fa fa-unlock"></i> Logout </a>--}}
                                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock"></i> Sign Out </button>
                                            {!! Form::close() !!}
                                            {{--<a href="{{url('/logout')}}" class="btn btn-primary btn-block">Sign Out</a>--}}
                                        </div>
                                    </li>
                                    <?php
                                    $check_shop = \App\PageShops::where('user_id',$userId)->first();
                                    ?>
                                    <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                    @if($check_shop)
                                        <li><a href="{{url('em-user/'.$userId.'/my_shop')}}"><i class="fa fa-building"></i> My Shop</a></li>
                                        <li><a href="{{url('em-user/shop/'.$userId.'/new_product')}}"><i class="fa fa-dropbox"></i> Post New Product</a></li>
                                    @else
                                        <li><a href="{{url('em-user/'.$userId.'/new_shop')}}">Create Shop</a></li>
                                    @endif
                                    <div class="divider"></div>
                                    <li><a href="{{url('em-user/'.$userId.'/my_ecammall')}}">My eCamMall</a> </li>
                                    <li><a href="{{url('em-user/'.$userId.'/my_orders')}}">My Orders</a> </li>
                                    <li><a href="{{url('em-user/'.$userId).'/my_message_center'}}">Message Center</a> </li>
                                    <li><a href="{{url('em-user/'.$userId.'/my_wishList')}}">Wish List</a> </li>
                                    <li><a href="#">My Favorites Stores</a> </li>
                                    <li><a href="@if($check_shop) {{url('em-user/'.$userId.'/my_coupons')}} @else {{url('#')}} @endif">My Coupons</a> </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="col-sm-9 col-md-8 hidden-sm no-padding">
                            <div class="shop-menu">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <div class="btn-group dropdown">
                                            <a class="btn dropdown-toggle login-info" data-toggle="dropdown" data-hover="dropdown">
                                                <table>
                                                    <tr>
                                                        <td><img src="{{asset('images/cart.png')}}" width="33px" height="35px"></td>
                                                        <td><span class="badge label-danger badge-cart">{{Session::has('cart') ? Session::get('cart')->totalQty : '0'}}</span>
                                                            <br>
                                                            Cart</td>
                                                    </tr>
                                                </table>
                                            </a>
                                            <?php
                                            if(!Session::has('cart')){
                                                $products = null;
                                                $total_price = 0;
                                            }else{
                                                $oldCart = Session::get('cart');
                                                $cart = new \App\Cart($oldCart);
                                                $products = $cart->items;
                                                $total_price = $cart->totalPrice;
                                            }

                                            ?>
                                            @if(Session::has('cart'))
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"style="min-width: 250px">
                                                    @foreach($products as $product)
                                                        <?php
                                                        $firstImage = \App\Thumbnails::where('product_id',$product['id'])->first();
                                                        $imageName = isset($firstImage->image)?$firstImage->image:$product['item']['image'];
                                                        ?>
                                                        <li>
                                                            <div class="col-sm-4">
                                                                @if($product['product_from'] == 0)
                                                                    <a href="{{url('shop/product_detail/'.$product['item']['id'])}}">
                                                                        <img src="{{asset('images/thumbnails/shop/'.$imageName)}}" alt="" width="auto" height="50px"/>
                                                                    </a>
                                                                @else
                                                                    <a href="{{url('product_detail/'.$product['item']['id'])}}">
                                                                        <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$product['item']['image']}}" width="auto" height="50px">
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p>{{$product['item']['name']}}</p>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                    <div class="divider"></div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <p>Subtotal :</p>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6">
                                                        {{number_format($total_price,2)}} $
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <a href="{{url('shopping-cart')}}">Shopping Cart</a>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <a href="{{url('shopping_cart/buy_now_from_cart')}}">Check Out</a>
                                                        </div>
                                                    </div>
                                                </ul>
                                            @endif
                                        </div>
                                    </li>
                                    <li><a href="#">
                                            <table>
                                                <tr>
                                                    <td><i class="fa fa-heart-o"></i></td>
                                                    <td><span class="badge label-danger">0</span>
                                                        <br>
                                                        Wishlist
                                                    </td>
                                                </tr>
                                            </table>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2 no-padding">
                            <div class="btn-group dropdown" style="right: 16px;">
                                <button type="button" class="btn btn-default dropdown-toggle login-info" data-toggle="dropdown" data-hover="dropdown" data-animations="fadeInUp">
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
        <div class="container no-padding visible-xs">
            <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <!-- Top Navigation Menu -->
            <div class="topnav" id="topnav" style="background-color: #ccc">
                <div class="col-xs-1 no-padding text-center">
                    <div class="qr-code-search">
                        @if(Request::is('/'))
                            <a href="{{url('/')}}"> <i class="fa fa-qrcode"></i></a>
                        @else
                            <a href="{{ url()->previous() }}"> <i class="fa fa-arrow-left"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-xs-9 no-padding">
                    <div class="col-xs-10 no-padding">
                        <a class="active-menu-mobile">
                            {!! Form::open(['url'=>'search','method'=>'GET','class'=>'searchform']) !!}
                            {!! Form::text('name',null,['placeholder'=>'Search by product title']) !!}
                            {{--<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>--}}
                            {!! Form::close() !!}
                        </a>
                    </div>
                    <div class="col-xs-2 no-padding">
                        <div class="qr-code-search">
                            <a href="{{url('/')}}"> <i class="fa fa-bell-o"></i></a>
                        </div>
                    </div>
                    <!-- Navigation links (hidden by default) -->
                    <div id="myLinks">
                        <?php
                        $categoriesMenuMobile = \App\Category::where('parent_id',0)->get();
                        ?>
                        @foreach($categoriesMenuMobile as $cat)
                            <a href="{{url('/products/'.$cat->id)}}">{{$cat->name}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-2 no-padding text-center">
                    <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
                    <a href="javascript:void(0);" class="icon" onclick="showMenuFunction()">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>

            </div>
            <script>
                function showMenuFunction() {
                    var x = document.getElementById("myLinks");
                    if (x.style.display === "block") {
                        x.style.display = "none";
                    } else {
                        x.style.display = "block";
                    }
                }
            </script>
        </div>
    </div><!--/header-middle-->
    @if(Request::is('/'))

    @elseif(Request::is('login') || Request::is('register'))
    @elseif(Request::is('em-user/*'))
        <?php
        $userInfo = \App\User::where('id',$userId)->first();
        ?>
        <div class="container">

            <div class="row white-bg">
                <div class="category-tab hidden-xs"><!--category-tab-->
                    <div class="col-sm-12 no-padding">
                        <ul class="nav nav-tabs">
                            <li class="@yield('my_ecammall')"><a href="{{url('em-user/'.$userId.'/my_ecammall')}}">My eCamMall</a></li>
                            <li class="@yield('my_order')"><a href="{{url('em-user/'.$userId.'/my_orders')}}">My Orders</a></li>
                            <li class="@yield('my_wish')"><a href="{{url('em-user/'.$userId.'/my_wishList')}}">Wish List</a> </li>
                            {{--<li class="@yield('my_favorites')"><a href="#">My Favorites Stores</a> </li>--}}
                            <li class="@yield('my_coupons')"><a href="#">My Coupons</a> </li>
                            <li class="@yield('my_account')"><a href="{{url('em-user/'.$userId.'/my_account')}}">Account Settings</a> </li>
                            <?php
                            $check_shop = \App\PageShops::where('user_id',$userId)->first();
                            ?>
                            @if($check_shop)
                                <li class="@yield('my_shop')"><a href="{{url('em-user/'.$userId.'/my_shop')}}"> My Shop</a></li>
                                <li class="@yield('my_new_product')"><a href="{{url('em-user/shop/'.$check_shop->user_id.'/new_product')}}">Post New Product</a></li>
                            @else
                                <li class="@yield('my_new_shop')"><a href="{{url('em-user/'.$userId.'/new_shop')}}"> Create Shop</a></li>
                            @endif
                            <li class="@yield('membership_list')"><a href="{{url('em-user/'.$userId.'/membership_list')}}">Membership </a> </li>

                        </ul>
                    </div>
                </div><!--/category-tab-->
            </div>
        </div>

    @else
        <div class="container white-bg no-padding">

            <div class="hero hidden-xs hidden-sm hidden-md" style="width: 1150px; padding-top: 0px">
                <div class="hovermenu ttmenu dark-style menu-color-gradient">
                    <div class="navbar navbar-default" role="navigation" style="margin-bottom: 0px;min-height: 0px">
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
        @if(Request::is('brand_zone') || Request::is('beauty') || Request::is('cloth') || Request::is('best_seller') || Request::is('store_zone') || Request::is('discount_deal') || Request::is('promotion'))
            <div class="header-bottom visible-xs">
                <div class="container">
                    <div class="row">
                        <div class="menu-scroll visible-xs">
                            <div class="menu-mobile">
                                <ul class="menu-mobile-list">
                                    <li class="@yield('brand_zone')"><a href='{{url('brand_zone')}}'>Brand Zone</a></li>
                                    <li class="@yield('beauty')"><a href="{{url('beauty')}}">Beauty</a></li>
                                    <li class="@yield('cloth')"><a href="{{url('cloth')}}">Cloth</a> </li>
                                    <li class="@yield('best_sale')"><a href="{{url('best_seller')}}">Best Seller</a> </li>
                                    <li class="@yield('store_zone')"><a href="{{url('store_zone')}}">Store Zone</a> </li>
                                    <li class="@yield('discount_deal')"><a href="{{url('discount_deal')}}">50% Off</a> </li>
                                    <li class="@yield('promotion')"><a href="{{url('promotion')}}">Promotion</a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="menu-tab hidden-xs">
                            <ul class="nav nav-tabs" style="margin-bottom: 0px">
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
            <div class="header-bottom hidden-xs"><!--header-bottom-->
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
</header>
{{--    <div class="loader visible-xs"></div>--}}
{{--    <div class="webpage hidden-xs">--}}
    <!--/header-->

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
                        <div class="menu-tab shop-details-tab"><!--category-tab-->
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
                                            <div class="col-sm-3 col-xs-4">
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
                    <?php $FooterImage = \App\CategorySlide::where(['status'=>0,'slide_type'=>'6'])->get()?>
                    @if(count($FooterImage) > 0)
                        <div class="col-sm-12 companyinfo">
                            <h2><span>Our</span> Partner</h2>
                        </div>
                    @endif
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
                    <div class="hidden-xs">
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
                    </div>
                    <div class="col-sm-3 col-xs-12 padding-5px">
                        <div class="single-widget">
                            <h2 class="hidden-xs">Subscribe</h2>
                            <form action="#" class="subscribe">
                                    <input type="text" placeholder="Subscribe with your e-mail" />
                                    <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <div class="clear-fix"></div>
                                <div class="col-md-6 col-xs-6 no-padding">
                                    <img src="{{asset('images/home/appstore.png')}}">
                                </div>
                                <div class="col-md-6 col-xs-6 no-padding">
                                    <a href="https://play.google.com/store/apps/details?id=com.ecammall.app" target="_blank"> <img src="{{asset('images/home/googleplay.png')}}"></a>
                                </div>
                                <div class="col-sm-12 col-xs-12 no-padding padding-top-5px">
                                    <img src="{{asset('images/home/payment_icon.png')}}">
                                </div>
                                <div class="col-sm-12 col-xs-12 no-padding">
                                    <div class="col-sm-6 col-xs-6 no-padding">
                                        <p>Security System Trust</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6 no-padding">
                                        <img src="{{asset('images/payment/trust_badges_large.png')}}">
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
                    {{--<button type="button" class="btn btn-preview" data-toggle="modal" data-target="#bite-38">Preview</button>--}}
                    <p class="pull-left">Copyright © 2016 by ECAMMall.Com, All rights reversed.</p>
                {{--<p class="pull-right">Designed by <span><a target="_blank" href="http://www.ecammall.com/">eCamMall</a></span></p>--}}
                <!-- credit to Themeum Free theme -->
                </div>
            </div>
        </div>

    </footer><!--/Footer-->

    @if(\Request::is('shop/product_detail/*') || \Request::is('product_detail/*') )

    @else
    <!-- Sidebar  -->
        @if(Auth::check() && Auth::user()->user_role != 1)
            <?php
            $userInfo = \App\User::where('id',$userId)->first();
            ?>
            <div id="mySidepanel" class="sidepanel visible-xs">
                <div class="col-sm-12 shop-info-header  padding-bottom-0 col-xs-12 no-padding">
                    <div class="col-sm-8 col-xs-12 padding-5px">
                        <div class="col-sm-2 col-xs-3 no-padding">
                            <a href="{{url('em-user/'.$userInfo->id.'/my_account')}}" class="padding-none"> <img src="{{asset('images/'.$userInfo->image)}}" class="padding-top-3px"></a>
                        </div>
                        <div class="col-sm-9 col-xs-9 no-padding">
                            <p>{{$userInfo->first_name.' '.$userInfo->last_name}}</p>
                            <p>{{$userInfo->email}}</p>
                            <p>Account Type : @if($userInfo->user_role == 0) Normal @endif</p>
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <div class="divider"></div>
                <br>
                <div class="clearfix"></div>
                <div class="padding-bottom-15"></div>
                <a href="{{url('/dashboard')}}">Dashboard</a>
                <a href="{{url('em-user/'.$userId.'/my_ecammall')}}">My eCamMall</a>
                <a href="{{url('em-user/'.$userId.'/my_orders')}}">My Orders</a>
                <a href="{{url('em-user/'.$userId.'/my_wishList')}}">Wish List</a>



                <a href="#">My Favorites Stores</a>
                <a href="#">My Coupons</a>
                <a href="{{url('em-user/'.$userId.'/my_account')}}">Account Settings</a>
                <?php
                $check_shop = \App\PageShops::where('user_id',$userId)->first();
                ?>
                @if($check_shop)
                    <a href="{{url('em-user/'.$userId.'/my_shop')}}"> My Shop</a>
                    <a href="{{url('em-user/shop/'.$check_shop->user_id.'/new_product')}}">Post New Product</a>
                @else
                    <a href="{{url('em-user/'.$userId.'/new_shop')}}"> Create Shop</a>
                @endif
                <a href="{{url('em-user/'.$userId.'/membership_list')}}">Membership </a>
                <a href="{{url('/logout')}}">Sign Out</a>
            </div>
        @endif
        <nav class="navbar navbar-default navbar-fixed-bottom visible-xs">
            <div class="container">
                <div align="center">
                    <div class="navbar-header-custom">
                        @if(Auth::check())
                            <a class="navbar-brand" href="{{url('/')}}">
                                <i class="fa fa-home"></i>
                                <p>Home</p>
                            </a>
                            @if(\Request::is('shop/*'))
                                <?php

                                ?>
                                <a class="navbar-brand" href="{{url('shop/'.$userId.'/shop_category')}}">
                                    <i class="fa fa-list-ul"></i>
                                    <p>Category</p>
                                </a>
                            @else
                                <a class="navbar-brand" href="{{url('all_category')}}">
                                    <i class="fa fa-list-ul"></i>
                                    <p>Category</p>
                                </a>
                            @endif
                            <a class="navbar-brand" href="{{url('shopping-cart')}}">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="badge label-danger badge-cart" style="position: absolute;bottom: 30px">{{Session::has('cart') ? Session::get('cart')->totalQty : '0'}}</span>
                                <p>Cart</p>
                            </a>
                            <a class="navbar-brand" href="{{url('#')}}">
                                <i class="fa fa-envelope"></i>
                                <p>Message</p>
                            </a>
                            @if(Auth::user()->user_role == 1)
                                <a class="navbar-brand" href="{{url('/em-admin')}}">
                                    <i class="fa fa-user-circle"></i>
                                    <p>Account</p>
                                </a>
                            @else
                                <a class="navbar-brand openbtn" onclick="openNav()">
                                    <i class="fa fa-user-circle"></i>
                                    <p>Account</p>
                                </a>
                            @endif
                            {{--href="{{url('em-user/'.Auth::user()->id.'/my_ecammall')}}"--}}
                        @else
                            <a class="navbar-brand" href="{{url('/')}}">
                                <i class="fa fa-home"></i>
                                <p>Home</p>
                            </a>
                            <a class="navbar-brand" href="{{url('all_category')}}">
                                <i class="fa fa-list-ul"></i>
                                <p>Category</p>
                            </a>
                            <a class="navbar-brand" href="{{url('shopping-cart')}}">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="badge label-danger badge-cart" style="position: absolute;bottom: 30px">{{Session::has('cart') ? Session::get('cart')->totalQty : '0'}}</span>
                                <p>Cart</p>
                            </a>
                            <a class="navbar-brand" href="{{url('#')}}">
                                <i class="fa fa-envelope"></i>
                                <p>Message</p>
                            </a>
                            <a class="navbar-brand" href="{{url('login')}}">
                                <i class="fa fa-user"></i>
                                <p>Account</p>
                            </a>
                        @endif
                    </div>
                </div>
            </div><!-- /.container-->
        </nav>
    @endif
    @if(Request::is('/'))
        <?php
        $popUp = \App\PopUpBanner::where('status',0)->inRandomOrder()->first();
        ?>
        @if($popUp)
        <div class="modal fade position-center-center m-width-570 timeoutshow"  bite-timeout="2" id="bite-38" bite-show="fadeIn" bite-hide="fadeOut">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close close-light" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <a href="{{$popUp->url}}">
                            <img src="{{asset('images/pop_up/'.$popUp->image)}}" srcset="{{asset('images/pop_up/'.$popUp->image)}} 2x" alt="" class="img-responsive"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
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

    <!-- The Modal -->


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
    <script src="{{asset('js/bootstrap-swipe-carousel/bootstrap-swipe-carousel.min.js')}}"></script>
    {{--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
    <script src="{{asset('js/big-image/lib/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/big-image/jquery-big-image.js')}}" type="text/javascript"></script>

    {{--<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>--}}
    <script>
        // When the user scrolls the page, execute myFunction
        window.onscroll = function() {myFunction()};

        // Get the navbar
        var topNav = document.getElementById("topnav");
        var topNavDesktop = document.getElementById("fixTop");

        // Get the offset position of the navbar
        var sticky = topNav.offsetTop;
        var stickyDesktop = topNavDesktop.offsetTop;

        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset >= sticky) {
                topNav.classList.add("sticky");
            } else {
                topNav.classList.remove("sticky");
            }
            if(window.pageYOffset >= stickyDesktop){
                topNavDesktop.classList.add("stickyDesktop");
            }else{
                topNavDesktop.classList.remove("stickyDesktop");
            }
        }

    </script>
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
        $(document).ready(function() {
            $(document).on('click', '.facebook-shared', function(event){
                event.preventDefault();

                var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
                    hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);

                var url = $(this).attr('href');
                var popup = window.open(url, 'Social Share',
                    'width='+popupMeta.width+',height='+popupMeta.height+
                    ',left='+vPosition+',top='+hPosition+
                    ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

                if (popup) {
                    popup.focus();
                    return false;
                }
            });

            var token = "{{ csrf_token() }}";
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token='+token,
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='+token
            };
            $.noConflict();
            $('textarea').ckeditor(options);
            $.noConflict();

            $('#product_category_id').change(function(){
                var categoryID = $(this).val();
                getSubcategory(categoryID);
                getBrand(categoryID);
            });

                    @if(!empty(old('category_id')) > 0 && empty(old('sub_category_id')))
            var categoryID = '{{old('category_id')}}';
            getSubcategory(categoryID);
                    @endif
                    @if(!empty(old('category_id')) > 0 && empty(old('brand')))
            var categoryID = '{{old('category_id')}}';
            getBrand(categoryID);
            @endif
            function getSubcategory(categoryID) {
                $.ajax({
                    dataType: "html",
                    type: "GET",
                    evalScripts: true,
                    url: "/get_categoryID/"+categoryID,
                    success: function(subcat) {
                        $('#sub_category_id').html(subcat);
                    }
                });
            }
            function getBrand(categoryID){
                $.ajax({
                    dataType: "html",
                    type: "GET",
                    evalScripts: true,
                    url: "/get_brand/"+categoryID,
                    success: function(brand) {
                        $('#brand').html(brand);
                    }
                });
            }

            $('#promotion').change(function () {
                var promotion = $(this).val();
                if((promotion.length)>0){
                    $('#admin_promotion').attr("disabled","disabled");
                }else{
                    $('#admin_promotion').removeAttr("disabled");
                }

            })

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
                var cart_price = $('.cart_price').attr('id');
                var quantity_input = $('.cart_quantity_input').val()-0;
                $('.cart_quantity_input').val(quantity_input+1);
                var quantity_input_update = $('.cart_quantity_input').val()-0;
                // alert($('.cart_price').attr('id'));
                $('.cart_total_price').html('$ '+Number(cart_price*quantity_input_update).toFixed(2));
                $('.cart_total_price_input').val(Number(cart_price*quantity_input_update).toFixed(2));
                $('.amount').val(Number(cart_price*quantity_input_update).toFixed(2));
                $('.total').val(Number(cart_price*quantity_input_update).toFixed(2));

            });
            $('body').delegate('.cart_quantity_down','click',function () {
                var cart_price = $('.cart_price').attr('id');
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

            $('body').delegate('.cart_quantity_delete_confirm','click',function () {
                if(confirm('You sure to remove this order item ?')) {
                    var id = $(this).attr('id');
                    var $row = $(this).parents('.cart_check');
                    var orderId = $(this).attr('orderId');
                    $row.remove();
                    $.ajax({
                        dataType:"html",
                        type:"GET",
                        evalScripts: true,
                        url:'{{url('remove_item_confirm')}}/'+id+'/orderId/'+orderId,
                        success:function (subTotal) {
                            $('.amount').val(subTotal);
                            $('.total-confirm').val(subTotal);
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
            $(".delete_video").click(function(){
                if(confirm('You sure to remove this video ?')) {
                    var id = $(this).attr('id');
                    var productId = $(this).attr('productId');
                    var $row = $(this).parents('.row_thumb');
                    $row.remove();
                    $.ajax({
                        dataType:"html",
                        type:"GET",
                        evalScripts: true,
                        url:'{{url('delete_video')}}/productId/'+productId+'/videoName/'+id,
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

            //display product list/grid
            $('.display-list').hide();
            $('body').delegate('.btn-grid-icon','click',function () {
                $('.display-list').hide();
                $('.display-grid').show();
                $('.list').removeClass('active');
                $('.grid').addClass('active');
            });
            $('body').delegate('.btn-list-icon','click',function () {
                $('.display-grid').hide();
                $('.display-list').show();
                $(this).parent().addClass('active');
                $('.grid').removeClass('active');
            })
            $('body').delegate('.short-product','change',function () {
//            var selected = $(this).val();
//            alert(selected);
//            getProductSortBy(selected);
                var sortingMethod = $(this).val();

                if(sortingMethod == 'price-asc')
                {
                    sortProductsPriceAscending();
                }
                else if(sortingMethod == 'price-desc')
                {
                    sortProductsPriceDescending();
                }
                else if(sortingMethod == 'name-asc'){
                    sortProductNameAscending();
                }
                else if(sortingMethod == 'name-desc'){
                    sortProductNameDescending();
                }
            })
            /*function getProductSortBy(selected) {
            {{--var currentUrl = '{{url()->current()}}';--}}
            $.ajax({
             dataType: "html",
             type: "GET",
             evalScripts: true,
             url: "/get_product_sort_by/"+selected,
             success: function(data) {
             $('.display-grid').html(data);
             $('.display-list').html(data);
             $('.display-list').hide();

             }
             });
             }*/

            function sortProductNameAscending() {
                var products = $('.products');
                var productsList = $('.products-list');
                products.sort(function (a,b) {
                    return ($(b).data("name").toUpperCase()) <
                    ($(a).data("name").toUpperCase()) ? 1 : -1;
                });
                productsList.sort(function (a,b) {
                    return ($(b).data("name").toUpperCase()) <
                    ($(a).data("name").toUpperCase()) ? 1 : -1;
                });
                $(".display-grid").html(products);
                $(".display-list").html(productsList);
            }
            function sortProductNameDescending() {
                var products = $('.products');
                var productsList = $('.products-list');
                products.sort(function (a,b) {
                    return ($(b).data("name").toUpperCase()) >
                    ($(a).data("name").toUpperCase()) ? 1 : -1;
                });
                productsList.sort(function (a,b) {
                    return ($(b).data("name").toUpperCase()) >
                    ($(a).data("name").toUpperCase()) ? 1 : -1;
                });
                $(".display-grid").html(products);
                $(".display-list").html(productsList);
            }
            function sortProductsPriceAscending()
            {
                var products = $('.products');
                var productsList = $('.products-list');
                products.sort(function(a, b){ return $(a).data("price")-$(b).data("price")});
                productsList.sort(function(a, b){ return $(a).data("price")-$(b).data("price")});
                $(".display-grid").html(products);

                $(".display-list").html(productsList);
            }

            function sortProductsPriceDescending()
            {
                var products = $('.products');
                var productList = $('.products-list');
                products.sort(function(a, b){ return $(b).data("price") - $(a).data("price")});
                productList.sort(function(a, b){ return $(b).data("price") - $(a).data("price")});
                $(".display-grid").html(products);
                $(".display-list").html(productList);

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

    <!--POP UP SCRIPT-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Popper JS v.1.14.3 minified -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <!-- Bootstrap JS v.4.1.3 minified -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Bites JS -->
    <script type="text/javascript" src="{{asset('bites/js/bites.js')}}"></script>

    @section('js')

    @show
{{--</div>--}}



</body>
</html>
