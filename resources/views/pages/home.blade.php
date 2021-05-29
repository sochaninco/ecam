@extends('layouts.app')
@section('title','ECAMMall.com | Cambodia Online Shop for Electronic, Clotch, Beauty & More')
@section('content')
    <?php
    $base_url = 'https://ecammall.com/';
    ?>
    <section id="slider"><!--slider-->
        <div class="container white-bg">
            <div class="row">
                <div class="col-sm-2-top no-padding hidden-xs hidden-md hidden-sm">
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
                                    <a class="navbar-brand" href="{{url('all_category')}}">Categories <small class="small-case">See All > </small></a>
                                </div><!-- end navbar-header -->
                                <div class="navbar-collapse collapse" style="height: 1px;">
                                    <ul class="nav navbar-nav">
                                        @foreach($categories_menu as $category)
                                        <li class="dropdown ttmenu-full active"><a href="{{url('products/'.$category->id)}}" data-toggle="dropdown" class="dropdown-toggle"><img src="{{$base_url}}stock/assets/uploads/{{$category->image}}" class="img-responsive icon-menu"> {{$category->name}} <b class="dropme"></b></a>
                                            <ul id="first-menu" class="dropdown-menu vertical-menu">
                                                <li>
                                                    <div class="ttmenu-content">
                                                        <div class="tabbable row">
                                                            <div class="col-md-3">
                                                                <ul class="nav nav-pills-menu nav-stacked">
                                                                    <?php $subcategory = \App\Category::where('parent_id',$category->id)->take(12)->get();
                                                                    ?>
                                                                    @foreach($subcategory as $key=>$sub)
                                                                    <li @if($key == 0)class="active" @endif><a href="#tabs5-pane{{$sub->id}}" data-toggle="tab">{{$sub->name}}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div><!-- end col -->
                                                            <div class="col-md-6">
                                                                <div class="tab-content">
                                                                    @foreach($subcategory as $key=>$sub)
                                                                    <div id="tabs5-pane{{$sub->id}}" class="tab-pane @if($key == 0)active @endif">
                                                                        <div class="row">
                                                                            {{--{{$sub->name}}--}}
                                                                            <?php $ProductSub = \App\ShopProduct::where('sub_category_id',$sub->id)->inRandomOrder()->take(12)->get();?>
                                                                            @foreach($ProductSub as $key=>$ProPic)
                                                                                <?php
                                                                                $firstImage = \App\Thumbnails::where('product_id',$ProPic->id)->first();
                                                                                $imageName = isset($firstImage->image)?$firstImage->image:$ProPic->image;
                                                                                ?>
                                                                            <div class="no-padding col-md-3 @if($key == 3 || $key == 7) menu-image @endif" style="margin-bottom: 5px">
                                                                                <div class="widget clearfix">
                                                                                    <a href="{{url('shop/product_detail/'.$ProPic->id)}}">
                                                                                        <div class="entry">
                                                                                            {{--@if(empty($ProPic->image))--}}
                                                                                                {{--<img src="{{$base_url}}stock/assets/uploads/no_image.png" alt="" class="img-responsive" />--}}
                                                                                            {{--@else--}}
                                                                                                <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" class="img-responsive" />
                                                                                            {{--@endif--}}
                                                                                            <span class="magnifier"></span>
                                                                                        </div><!-- enntry -->
                                                                                    </a>
                                                                                </div><!-- end widget -->
                                                                            </div><!-- end col -->
                                                                            @endforeach
                                                                        </div><!-- end row -->
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>    <!-- end col -->
                                                            <div class="col-md-3">
                                                                    <?php $Brands = \App\Brand::where('category_id',$category->id)->take(16)->get()?>
                                                                    @foreach($Brands as $brand)
                                                                    <div class="col-md-6 img-brand">
                                                                        <a href="{{url('products/brands/'.$brand->id)}}"> <img src="{{$base_url}}stock/assets/uploads/{{$brand->image}}"> </a>
                                                                    </div>
                                                                    @endforeach
                                                            </div>
                                                        </div><!-- /.tabbable -->
                                                    </div><!-- end ttmenu-content -->
                                                </li>
                                            </ul>
                                        </li>
                                        @endforeach
                                        <!-- end mega menu -->
                                    </ul><!-- end nav navbar-nav -->
                                </div><!--/.nav-collapse -->
                            </div><!-- end navbar navbar-default clearfix -->
                        </div><!-- end menu 1 -->
                    </div>
                </div>
                <div class="col-sm-7 no-padding col-xs-12" >
                    <div class="menu-scroll visible-xs">
                        <div class="menu-mobile">
                            <ul class="menu-mobile-list">
                                <li class="@yield('brand_zone')"><a href='{{url('brand_zone')}}'>Brand Zone</a></li>
                                <li class="@yield('beauty')"><a href="{{url('beauty')}}">Beauty</a></li>
                                <li class="@yield('cloth')"><a href="{{url('cloth')}}">Cloth</a> </li>
                                <li class="@yield('best_sale')"><a href="{{url('best_seller')}}">Best Seller</a> </li>
                                <li class="@yield('store_zone')"><a href="{{url('store_zone')}}">Store Zone</a> </li>
                                <li class="@yield('discount_deal')"><a href="{{url('discount_deal')}}">50% Off</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="menu-tab-top hidden-xs"><!--category-tab-->
                        <div class="col-sm-12 no-padding">
                            <ul class="nav nav-tabs">
                                <li class="@yield('brand_zone')"><a href='{{url('brand_zone')}}'>Brand Zone</a></li>
                                <li class="@yield('beauty')"><a href="{{url('beauty')}}">Beauty</a></li>
                                <li class="@yield('cloth')"><a href="{{url('cloth')}}">Cloth</a> </li>
                                <li class="@yield('best_sale')"><a href="{{url('best_seller')}}">Best Seller</a> </li>
                                <li class="@yield('store_zone')"><a href="{{url('store_zone')}}">Store Zone</a> </li>
                                <li class="@yield('discount_deal')"><a href="{{url('discount_deal')}}">50% Off</a> </li>
                            </ul>
                        </div>
                    </div><!--/category-tab-->
                    {{--<div data-ride="carousel" class="carousel slide flash-sale-carousel" data-type="multi" data-interval="12000" id="flash-sale-mobile-carousel">--}}
                    <div id="slider-carousel" class="carousel slide" data-interval="3000"  data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($slides as $key=>$slide)
                                <li data-target="#slider-carousel" data-slide-to="{{$key}}" @if($key==0)class="active" @endif></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner">
                            @foreach($slides as $key=>$slide)
                                <div class="item @if($key == 0)active @endif">
                                        {{--<img src="images/home/pricing.png"  class="pricing" alt="" />--}}
                                        @if(!empty($slide->product_id))
                                        <img src="images/home/{{$slide->image}}" alt="" />
                                        <div class="header-text">
                                            <h3>{{$product[$slide->product_id]}}</h3>
                                            <a href="{{url('product_detail/'.$slide->product_id)}}" class="btn btn-default get">Get it now</a>
                                        </div>
                                        @else
                                            <a href="https:\\{{$slide->external_link}}" @if($slide->open_new_tab == 1) target="_blank" @endif>
                                                <img src="images/home/{{$slide->image}}" alt="" />
                                            </a>
                                        @endif
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
                    <?php
                    $pageManageTrendingHome = \App\PageManagement::where(['id'=>14,'status'=>1])->first();
                    ?>
                    @if($pageManageTrendingHome)
                    <div class="trending-category  d-none d-lg-block hidden-xs">
                        <ul>
                            <?Php
                            $trending = \App\SearchKeyword::where('type',0)->inRandomOrder()->take(7)->get();
                            ?>
                            @foreach($trending as $key=>$trend)
                                    <?php
                                        if($trend->link_to == 0){
                                            $getProduct = \App\ShopProduct::where('name','LIKE','%'.str_replace(' ', '', $trend->keyword).'%')->first();
                                            if($getProduct){
                                                $firstImage = \App\Thumbnails::where('product_id',$getProduct->id)->first();
                                                $imgName = isset($firstImage->image)?$firstImage->image:'';
                                            }else{
                                                $imgName = '';
                                            }
                                        }
                                        elseif($trend->link_to == 1){
                                            $getProduct = \App\ShopProduct::where('category_id',$trend->category_id)->first();
                                            $firstImage = \App\Thumbnails::where('product_id',$getProduct->id)->first();
                                            $imgName = isset($firstImage->image)?$firstImage->image:'';
                                        }
                                        elseif($trend->link_to == 2){
                                            $getProduct = \App\ShopProduct::where('sub_category_id',$trend->sub_category_id)->first();
                                            $firstImage = \App\Thumbnails::where('product_id',$getProduct->id)->first();
                                            $imgName = isset($firstImage->image)?$firstImage->image:'';

                                        }
                                        /*else{
                                            $getProduct = \App\ShopProduct::where('category_id',$trend->category_id)->first();
                                            $firstImage = \App\Thumbnails::where('product_id',$getProduct->id)->first();
                                            $imgName = isset($firstImage->image)?$firstImage->image:'';
                                        }*/
                                    ?>
                                <li @if ($key == 0) class="active" @endif>
                                    <div class="trend-category-single">
                                        @if($trend->link_to == 0)
                                            <a href="{{url('search?name='.$trend->keyword.'&category_id=')}}">
                                        @elseif($trend->link_to == 2)
                                            <a href="{{url('products/category/'.$trend->sub_category_id)}}">
                                        @else
                                            <a href="{{url('products/'.$trend->category_id)}}">
                                        @endif
                                            <div class="name">{{ $trend->keyword }}</div>
                                            <div class="img">
                                                    <img src="{{asset('images/thumbnails/shop/'.$imgName)}}" alt="{{ $trend->keyword }}" class="lazyload img-fit">
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <?php
                    $pageMangeBannerTop = \App\PageManagement::where(['id'=>15,'status'=>0])->first();
                ?>
                @if($pageMangeBannerTop)
                <div class="col-sm-3-top no-padding hidden-xs margin-top-30px">
                    <?php
                        $pageManageOnlineExpo = \App\PageManagement::where(['id'=>19,'status'=>0])->first();
                        $onlineExhibition = \App\SearchKeyword::where('type',1)->inRandomOrder()->take(3)->get();
                        $getLabelText = \App\SearchKeyword::where('label_promo','!=','')->first();
                    ?>
                    @if($pageManageOnlineExpo)
                    <div class="title-promotion-home-right">
                        <h5>{{$getLabelText->label_promo}}</h5>
                    </div>
                    @foreach($onlineExhibition as $exhibition)
                        <?php
                            $shopInfo = \App\PageShops::where('user_id',$exhibition->shop)->first();
                            $getProduct = \App\ShopProduct::where('id',$exhibition->product_by_shop)->first();
                            $firstImage = \App\Thumbnails::where('product_id',$getProduct->id)->first();
                            $imgName = isset($firstImage->image)?$firstImage->image:'';
                        ?>
                        <div class="store-info-content border-bottom">
                            <div class="row padding-top-5px">
                                <div class="store-info-btn col-sm-7">
                                    <p><a href="{{url('shop/product_detail/'.$exhibition->product_by_shop)}}"> {{$exhibition->keyword}} </a></p>
                                    <div class="visit-store-btn">
                                    <span>
                                        <a href="{{url('shop/'.$shopInfo->shop_name)}}">Visit Store</a>
                                    </span>
                                    </div>
                                </div>
                                <div class="pull-right col-sm-5">
                                    <a href="{{url('shop/product_detail/'.$exhibition->product_by_shop)}}"> <img src="{{asset('images/thumbnails/shop/'.$imgName)}}"></a>
                                </div>
                                <hr>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <div id="ads-top-item-carousel" data-interval="2000" data-type="multi" data-ride="carousel" class="carousel slide">
                            <div class="carousel-inner">
                                <?php $slide_header = \App\CategorySlide::where(['status'=>0,'slide_type'=>3])->orderBy('id','desc')->get(); ?>
                                @foreach($slide_header as $key=>$HeaderSlide)
                                    <div class="item @if($key == 0)active @endif ">
                                        @if(!empty($HeaderSlide->url))
                                            <a href="https:\\{{$HeaderSlide->url}}" @if($HeaderSlide->open_new_tab == 1) target="_blank" @endif> <img src="{{asset('images/home/'.$HeaderSlide->image)}}" class="img-responsive"></a>
                                        @else
                                            <a href="{{url('product_detail/'.$HeaderSlide->product_id)}}"> <img src="{{asset('images/home/'.$HeaderSlide->image)}}" class="img-responsive"></a>
                                        @endif

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                @endif
                <div class="col-sm-2 visible-md visible-sm no-padding" align="center">
                    <div class="row profile-home-right">
                        @if(!Auth::check())
                            <div class="col-sm-12">
                                <img src="{{asset('images/default_profile.jpg')}}" class="img-rounded-profile img-responsive">
                            </div>
                            <div class="col-sm-12 padding-left-17px">
                                <p>Welcome to ecammall</p>
                            </div>
                            <div class="col-sm-6 padding-left-25px">
                                <a href="{{url('/register')}}" class="btn btn-danger profile-home-right"> Join </a>
                            </div>
                            <div class="col-sm-6 no-padding">
                                <a href="{{url('/login')}}" class="btn btn-info profile-home-right"> Sign In </a>
                            </div>
                        @else
                            <div class="col-sm-12">
                                <img src="{{asset('images/'.Auth::user()->image)}}" class="img-rounded-profile img-responsive">
                            </div>
                            <div class="col-sm-12 padding-left-25px">
                                <p>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                            </div>
                            <div class="col-sm-6 col-md-6 padding-left-25px">
                                <a href="{{url('em-user/'.Auth::user()->id.'/my_ecammall')}}" class="btn btn-danger profile-home-right"> Account </a>
                            </div>
                            <div class="col-sm-6 col-md-6 no-padding">
                                <a href="{{url('em-user/'.Auth::user()->id.'/my_orders')}}" class="btn btn-info profile-home-right"> Order </a>
                            </div>
                        @endif
                            <div class="clearfix"></div>
                            <div class="gray-bg margin-left-20px">
                                <div class="special-offer-front">
                                    <p>Special Offer!!</p>
                                </div>

                                <div id="popular-item-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <?php $i = 1;?>
                                            @foreach($promotionHome as $key=>$promotion)
                                                <?php
                                                $firstImage = \App\Thumbnails::where('product_id',$promotion->id)->first();
                                                $imageName = isset($firstImage->image)?$firstImage->image:$discount->image;
                                                ?>
                                                @if($i%2 == 0)
                                        </div><div class="item">
                                            @endif
                                            <div class="col-sm-6 no-padding">
                                                <div class="single-products">
                                                    <div class="productinfo-home-promote text-center ">
                                                        <a href="{{url('shop/product_detail/'.$promotion->id)}}" class="margin-left-10px">
                                                            <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" class="img-responsive "/>
                                                        </a>
                                                        <h5>$ {{number_format($promotion->price *(1-($promotion->discount_rate/100)),1)}}</h5>
                                                        {{--<h2>$ {{number_format($promotion->price *(1-($promotion->discount_rate/100)),2)}}</h2>--}}
                                                        {{--<p>{{substr($promotion->name,0,15)}}...</p>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i++ ?>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="view-more-offer">
                                    <a href="{{url('discount_deal')}}">
                                        <p>View More >> </p>
                                    </a>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->
    <section class="visible-xs">
        <div class="category">
            <div class="category-container">
                <ul class="category-list">
                    <li><a href="{{url('/products')}}">
                            <div class="category-bg">
                                <img src="{{asset('images/ecammall/all-category.png')}}" class="img-responsive">
                            </div>
                            <span class="text">All Categories</span>
                        </a>
                    </li>
                    @foreach($categories_menu as $category)
                        <li>
                            <a href="{{url('products/'.$category->id)}}">
                                <img src="{{asset('images/'.$category->image_mobile)}}" class="img-responsive">
                                <span class="text">{{$category->name}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row white-bg">
                <div class="visible-xs">
                    <div class="col-sm-12 no-padding">
                        <div class="features_items">
                            <?php
                            $featureBanners = \App\CategorySlide::where('slide_type',13)->orderBy('id','desc')->take(1)->get();
                            ?>
                            @foreach($featureBanners as $fBanner)
                                <div class="col-xs-12 padding-5px padding-bottom-5">
                                    @if(!empty($fBanner->url))
                                        <a href="https://{{$fBanner->url}}" @if($fBanner->open_new_tab == 1) target="_blank" @endif>
                                            <img alt="" src="{{$base_url}}images/home/{{$fBanner->image}}" class="img-responsive">
                                        </a>
                                    @else
                                        <a href="{{url('product_detail/'.$fBanner->product_id)}}" >
                                            <img alt="" src="{{$base_url}}images/home/{{$fBanner->image}}" class="img-responsive">
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                            <?php
                            $categoryMobile = \App\Category::where('parent_id',0)->whereIn('id',[1,2,3,4,5,6])->take(6)->get();
                            ?>
                            @foreach($categoryMobile as $catMobile)
                                <div class="text-center gray-bg border col-xs-4 padding-5px">
                                    <div class="title list-cat-mobile">
                                        <a href="{{url('products/'.$catMobile->id)}}"><p><?php
                                                $catName = $catMobile->name;
                                                $name = explode(" ",$catName);
                                                ?>
                                                {{$name[0]}}</p></a>
                                        <?php
                                        $products = \App\ShopProduct::where('category_id',$catMobile->id)->inRandomOrder()->take(1)->get();
                                        ?>
                                        @foreach($products as $product)
                                            <?php
                                            $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                            $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                            ?>
                                            <a href="{{url('products/'.$catMobile->id)}}">
                                                <img src="{{asset('images/thumbnails/shop/'.$imageName)}}" class="mobile-list-product img-responsive">
                                            </a>
                                            <p>$ {{sprintf('%0.2f', $product->price)}}</p>
                                        @endforeach
                                        {{--<img src="{{$base_url}}stock/assets/uploads/{{$catMobile->image}}">--}}
                                    </div>
                                </div>
                            @endforeach
                            <div class="clearfix"></div>
                            <?php
                            $pageManageFlashDeal = \App\PageManagement::where('block','flash_deal_mobile_homepage')->first();
                            ?>
                            @if($pageManageFlashDeal->status == 0)
                            <div class="col-xs-9 no-padding">
                                <div class="col-xs-6 no-padding">
                                    <h2 class="title"> <i class="fa fa-bolt"></i> Flash Deals</h2>
                                </div>
                                <div class="col-xs-6 no-padding padding-top-5px">
                                    <div class="countdown-3"></div>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 no-padding">
                                    <p class="pull-right padding-top-5px see-more">
                                        <a href="{{url('discount_deal')}}">
                                        See all deal >>
                                        </a>
                                    </p>
                            </div>
                            <div class="clearfix"></div>

                            @foreach($flashSale as $count => $item)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$item->id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$item->image;
                                        ?>
                                        <div class="col-xs-4 no-padding">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <a href="{{url('shop/product_detail/'.$item->id)}}">
                                                            <img src="{{asset('images/thumbnails/shop/'.$imageName)}}" alt="" class="img-flash-sale" />
                                                        </a>
                                                        <p class="text-height">{{substr($item->name,0,20)}}</p>
                                                        <h4>
                                                            <div class="col-xs-6 no-padding">
                                                                <strike style="color: #000;font-weight: 300">$ {{sprintf('%0.2f', $item->price)}}</strike>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                ${{number_format($item->price *(1-($item->discount_rate/100)),2)}}
                                                            </div>
                                                        </h4>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                            @endforeach
                            @endif
                            <div class="clearfix"></div>
                            <?php
                            $pageManageYouLike = \App\PageManagement::where('block','show_you_may_also_like_mobile')->first();
                            ?>
                            @if($pageManageYouLike->status == 0)
                            <h2 class="title"> <i class="fa fa-thumbs-up"></i> You May Also Like</h2>
                            @foreach($UserProduct as $special)
                                <?php
                                $firstImage = \App\Thumbnails::where('product_id',$special->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$special->image;
                                ?>
                                <div class="col-md-2 col-sm-3 col-xs-6 padding-5px">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{url('shop/product_detail/'.$special->id)}}">
                                                    <img src="{{$base_url}}images/thumbnails/medium/{{$imageName}}" alt="" class="img-responsive" />
                                                </a>
                                                <p class="text-height hidden-xs">{{substr($special->name,0,40)}}</p>
                                                <h4>Price : $ {{sprintf('%0.2f', $special->price)}}</h4>
                                                {{--<a href="{{url('shop/product_detail/'.$special->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>--}}
                                            </div>
                                            {{--<div class="product-overlay">--}}
                                            {{--<div class="overlay-content">--}}
                                            {{--<h2>$ {{sprintf('%0.2f', $feature->price)}}</h2>--}}
                                            {{--<p>{{$feature->name}}</p>--}}
                                            {{--<a href="{{url('product_detail/'.$feature->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            <div class="hidden-xs">
                                                @if($special->discount_rate > 0)
                                                    <div class="discount">
                                                        <img src="{{asset('images/home/discount.png')}}">
                                                        <p>{{$special->discount_rate}}</p>
                                                    </div>
                                                {{--@elseif($special->quantity <= 0)
                                                    <div class="sale">
                                                        <img src="{{asset('images/home/sold-out.png')}}">
                                                        <p>Sold</p>
                                                    </div>--}}
                                                @endif
                                            </div>

                                        </div>
                                        {{--<div class="choose">--}}
                                        {{--<ul class="nav nav-pills nav-justified">--}}
                                        {{--<li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Add to Cart</a></li>--}}
                                        {{--<li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a></li>--}}
                                        {{--</ul>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 no-padding">
                    <!--Flash Deal-->
                    <?php
                    $pageManageFlashDeal = \App\PageManagement::where('block','flash_deal_homepage')->first();
                    ?>
                    @if($pageManageFlashDeal->status == 0)
                    <div class="features_items hidden-xs hidden-sm">
                        {{--<h2 class="title"> Flash Deals</h2>--}}
                        <div class="col-sm-12 no-padding padding-top-5px">
                            <div class="col-sm-3 no-padding">
                                <h2 class="title"> <i class="fa fa-bolt"></i> Flash Deals</h2>
                            </div>
                            <div class="col-sm-6 no-padding padding-top-5px">
                                <div class="countdown-3"></div>
                            </div>
                            <div class="col-sm-3 no-padding">
                                <p class="pull-right padding-top-5px see-more">
                                    <a href="{{url('discount_deal')}}">
                                        See all deal >>
                                    </a>
                                </p>
                            </div>
                        </div>
                        @foreach($flashSale as $count => $item)
                                <?php
                                $firstImage = \App\Thumbnails::where('product_id',$item->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$item->image;
                            $adminPromotion = \App\AdminPromotion::where('id',$item->admin_promotion)->first();
                                ?>
                                <div class="col-sm-3 col-md-2 col-xs-4 padding-5px">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{url('shop/product_detail/'.$item->id)}}">
                                                    <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" class="img-special-offer" />
                                                </a>
                                                <p class="text-height">{{substr($item->name,0,40)}}</p>
                                                <h4>
                                                    <div class="col-sm-6 no-padding">
                                                        <strike style="color: #000;font-weight: 300"> $ {{sprintf('%0.2f', $item->price)}}</strike>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        ${{number_format($item->price *(1-($item->discount_rate/100)),2)}}
                                                    </div>
                                                </h4>
                                            </div>
                                            @if($adminPromotion)
                                                <div class="admin-promotion flash-deal">
                                                    <img src="{{asset('images/'.$adminPromotion->image)}}" class="img-responsive">
                                                </div>
                                            @endif
                                            @if($item->discount_rate > 0)
                                                <div class="discount">
                                                    <img src="{{asset('images/home/discount.png')}}">
                                                    <p>{{$item->discount_rate}}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                    <div class="features_items hidden-xs hidden-lg hidden-md visible-sm">
                            {{--<h2 class="title"> Flash Deals</h2>--}}
                            <div class="col-sm-12 no-padding padding-top-5px">
                                <div class="col-sm-3 no-padding">
                                    <h2 class="title"> <i class="fa fa-bolt"></i> Flash Deals</h2>
                                </div>
                                <div class="col-sm-6 no-padding padding-top-5px">
                                    <div class="countdown-3"></div>
                                </div>
                                <div class="col-sm-3 no-padding">
                                    <p class="pull-right padding-top-5px see-more">
                                        <a href="{{url('discount_deal')}}">
                                            See all deal >>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            @foreach($flashSale as $count => $item)
                                <?php
                                $firstImage = \App\Thumbnails::where('product_id',$item->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$item->image;
                                ?>
                                <div class="col-sm-3 col-md-2 col-xs-4 padding-5px">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <a href="{{url('shop/product_detail/'.$item->id)}}">
                                                            <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" class="img-special-offer" />
                                                        </a>
                                                        <p class="text-height">{{substr($item->name,0,40)}}</p>
                                                        <h4>
                                                            <div class="col-sm-6 no-padding">
                                                                <strike style="color: #000;font-weight: 300"> $ {{sprintf('%0.2f', $item->price)}}</strike>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                ${{number_format($item->price *(1-($item->discount_rate/100)),2)}}
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    @if($item->discount_rate > 0)
                                                        <div class="discount">
                                                            <img src="{{asset('images/home/discount.png')}}">
                                                            <p>{{$item->discount_rate}}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                            @endforeach
                    </div>
                    @endif
                    <!--End flash deal-->
                    <!--Ecammall Category-->
                    <?php
                    $pageManageEcamCat = \App\PageManagement::where('block','ecammall_category_homepage')->first();
                    ?>
                    @if($pageManageEcamCat->status == 0)
                    <div class="features_items hidden-xs">
                        <h2 class="title"><i class="fa fa-list-ul"></i> ECamMall Category</h2>
                        <div class="col-sm-12 no-padding hidden-xs">
                            <?php
                            $pageManageEcamCatStyleSmallLeft = \App\PageManagement::where('block','ecammall_category_homepage_small_left_style')->first();
                            $pageManageEcamCatStyleSmallRight = \App\PageManagement::where('block','ecammall_category_homepage_small_right_style')->first();
                            $ecammallCategoryBannerBig = \App\CategorySlide::where(['slide_type'=>18,'style_display'=>1])->first();
                            ?>
                            @if($pageManageEcamCatStyleSmallLeft->status == 1 && $pageManageEcamCatStyleSmallRight->status == 1)
                                <?php
                                $ecammallCategoryBannersBig = \App\CategorySlide::join('sma_categories','category_slides.category_id','=','sma_categories.id')
                                    ->select('category_slides.*','sma_categories.name')
                                    ->where('category_slides.slide_type',18)->where('category_slides.style_display',1)->take(2)->get();
                                ?>
                                @foreach($ecammallCategoryBannersBig as $value)
                                    <div class="col-sm-3 col-md-3 padding-5px padding-bottom-5">
                                        @if(empty($value->url))
                                            <a href="{{url('products/'.$value->category_id)}}">
                                                @else
                                                    <a href="{{$value->url}}">
                                                        @endif
                                                        <img src="{{asset('images/home/'.$value->image)}}" class="img-responsive">
                                                    </a>
                                    </div>
                                @endforeach
                            @elseif($pageManageEcamCatStyleSmallLeft->status == 0 && $pageManageEcamCatStyleSmallRight->status == 0)
                                <div class="col-sm-3 col-md-3 padding-5px padding-bottom-5">
                                    <?php
                                    $ecammallCategoryBannersSmallLefts = \App\CategorySlide::join('sma_categories','category_slides.category_id','=','sma_categories.id')
                                        ->select('category_slides.*','sma_categories.name')
                                        ->where('category_slides.slide_type',18)->where('category_slides.style_display',3)->take(3)->inRandomOrder()->get();
                                    ?>
                                    @foreach($ecammallCategoryBannersSmallLefts as $left)
                                        <div class="col-sm-12 col-md-12 padding-5px padding-bottom-5">
                                            @if(empty($left->url))
                                                <a href="{{url('products/'.$left->category_id)}}">
                                                    @else
                                                        <a href="{{$left->url}}">
                                                            @endif
                                                            <img src="{{asset('images/home/'.$left->image)}}" class="img-responsive">
                                                        </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-sm-3 col-md-3 padding-5px padding-bottom-5">
                                    <?php
                                    $ecammallCategoryBannersSmallRights = \App\CategorySlide::join('sma_categories','category_slides.category_id','=','sma_categories.id')
                                        ->select('category_slides.*','sma_categories.name')
                                        ->where('category_slides.slide_type',18)->where('category_slides.style_display',3)->take(3)->get();
                                    ?>
                                    @foreach($ecammallCategoryBannersSmallRights as $right)
                                        <div class="col-sm-12 col-md-12 padding-5px padding-bottom-5">
                                            @if(empty($right->url))
                                                <a href="{{url('products/'.$right->category_id)}}">
                                                    @else
                                                        <a href="{{$right->url}}">
                                                            @endif
                                                            <img src="{{asset('images/home/'.$right->image)}}" class="img-responsive">
                                                        </a>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($pageManageEcamCatStyleSmallLeft->status == 0)
                                    <div class="col-sm-3 col-md-3 padding-5px padding-bottom-5">
                                        <?php
                                        $ecammallCategoryBannersSmallLefts = \App\CategorySlide::join('sma_categories','category_slides.category_id','=','sma_categories.id')
                                            ->select('category_slides.*','sma_categories.name')
                                            ->where('category_slides.slide_type',18)->where('category_slides.style_display',3)->take(3)->inRandomOrder()->get();
                                        ?>
                                        @foreach($ecammallCategoryBannersSmallLefts as $left)
                                            <div class="col-sm-12 col-md-12 padding-5px padding-bottom-6">
                                                @if(empty($left->url))
                                                    <a href="{{url('products/'.$left->category_id)}}">
                                                        @else
                                                            <a href="{{$left->url}}">
                                                                @endif
                                                                <img src="{{asset('images/home/'.$left->image)}}" class="img-responsive">
                                                            </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-sm-3 col-md-3 padding-5px padding-bottom-5">
                                        @if(empty($ecammallCategoryBannerBig->url))
                                            <a href="{{url('products/'.$ecammallCategoryBannerBig->category_id)}}">
                                                @else
                                                    <a href="{{$ecammallCategoryBannerBig->url}}">
                                                        @endif
                                                        <img src="{{asset('images/home/'.$ecammallCategoryBannerBig->image)}}" class="img-responsive">
                                                    </a>
                                    </div>
                            @elseif($pageManageEcamCatStyleSmallRight->status == 0)
                                    <div class="col-sm-3 col-md-3 padding-5px padding-bottom-5">
                                        @if(empty($ecammallCategoryBannerBig->url))
                                            <a href="{{url('products/'.$ecammallCategoryBannerBig->category_id)}}">
                                                @else
                                                    <a href="{{$ecammallCategoryBannerBig->url}}">
                                                        @endif
                                                        <img src="{{asset('images/home/'.$ecammallCategoryBannerBig->image)}}" class="img-responsive">
                                                    </a>
                                    </div>
                                    <div class="col-sm-3 col-md-3 padding-5px padding-bottom-5">
                                        <?php
                                        $ecammallCategoryBannersSmallRights = \App\CategorySlide::join('sma_categories','category_slides.category_id','=','sma_categories.id')
                                            ->select('category_slides.*','sma_categories.name')
                                            ->where('category_slides.slide_type',18)->where('category_slides.style_display',3)->take(3)->get();
                                        ?>
                                        @foreach($ecammallCategoryBannersSmallRights as $right)
                                            <div class="col-sm-12 col-md-12 padding-5px padding-bottom-6">
                                                @if(empty($right->url))
                                                    <a href="{{url('products/'.$right->category_id)}}">
                                                        @else
                                                            <a href="{{$right->url}}">
                                                                @endif
                                                                <img src="{{asset('images/home/'.$right->image)}}" class="img-responsive">
                                                            </a>
                                            </div>
                                        @endforeach
                                    </div>

                            @endif
                            <?php
                            $ecammallCategoryBanners = \App\CategorySlide::join('sma_categories','category_slides.category_id','=','sma_categories.id')
                                ->select('category_slides.*','sma_categories.name')
                                ->where('category_slides.slide_type',18)->where('category_slides.style_display',2)->get();
                            ?>
                            @foreach($ecammallCategoryBanners as $catBanner)
                                    <div class="col-sm-2 col-md-2 no-padding padding-bottom-5">
                                        <div class="category-banner">
                                            <a href="{{url('products/'.$catBanner->category_id)}}">
                                                <img class="img-responsive" src="{{asset('images/home/'.$catBanner->image)}}">
                                            </a>
                                        </div>
                                        <div class="category-banner-name">
                                            <a href="{{url('products/'.$catBanner->category_id)}}">{{substr($catBanner->name,0,17)}}</a>
                                        </div>
                                        {{--<a href="{{url('products/'.$catBanner->category_id)}}">
                                            <img src="{{asset('images/home/'.$catBanner->image)}}">
                                        </a>--}}
                                    </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <?php
                    $pageManageEcamCatMobile = \App\PageManagement::where('block','ecammall_category_mobile_homepage')->first();
                    ?>
                    @if($pageManageEcamCatMobile->status == 0)

                        <div class="features_items hidden-md hidden-sm hidden-lg">
                            <h2 class="title"><i class="fa fa-list-ul"></i> ECamMall Category</h2>
                            <div class="col-xs-12 no-padding visible-xs">
                                <?php
                                $pageManageEcamCatStyle = \App\PageManagement::where('block','ecammall_category_homepage_small_banner_style')->first();
                                ?>
                                @if($pageManageEcamCatStyle->status == 1)
                                <?php
                                $ecammallCategoryBannerBig = \App\CategorySlide::where(['slide_type'=>18,'style_display'=>1])->first();
                                $ecammallCategoryBanners = \App\CategorySlide::join('sma_categories','category_slides.category_id','=','sma_categories.id')
                                    ->select('category_slides.*','sma_categories.name')
                                    ->where(['category_slides.slide_type'=>18,'category_slides.style_display'=>2])->take(3)->get();
                                ?>
                                <div class="col-xs-8 no-padding padding-bottom-15">
                                    <a href="{{url('products/'.$ecammallCategoryBannerBig->category_id)}}">
                                        <img src="{{asset('images/home/'.$ecammallCategoryBannerBig->image)}}" class="img-responsive">
                                    </a>
                                </div>
                                @foreach($ecammallCategoryBanners as $categoryBanner)
                                    <div class="col-xs-4 no-padding padding-bottom-5">
                                        <div class="category-banner">
                                            <a href="{{url('products/'.$categoryBanner->category_id)}}">
                                                <img src="{{asset('images/home/'.$categoryBanner->image)}}">
                                            </a>
                                        </div>
                                        <div class="category-banner-name">
                                            <a href="{{url('products/'.$categoryBanner->category_id)}}">{{substr($categoryBanner->name,0,17)}}</a>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    <?php
                                        $ecammallCategoryBanners = \App\CategorySlide::join('sma_categories','category_slides.category_id','=','sma_categories.id')
                                            ->select('category_slides.*','sma_categories.name')
                                            ->where(['category_slides.slide_type'=>18,'category_slides.style_display'=>3])->take(3)->get();

                                        $ecammallCategoryBannersSmall = \App\CategorySlide::join('sma_categories','category_slides.category_id','=','sma_categories.id')
                                            ->select('category_slides.*','sma_categories.name')
                                            ->where(['category_slides.slide_type'=>18,'category_slides.style_display'=>2])->take(3)->get();
                                    ?>
                                    <div class="col-xs-8 no-padding padding-bottom-15">
                                        @foreach($ecammallCategoryBanners as $value)
                                            <div class="col-xs-12 padding-5px padding-bottom-2">
                                                @if(empty($value->url))
                                                    <a href="{{url('products/'.$value->category_id)}}">
                                                        @else
                                                            <a href="{{$value->url}}">
                                                                @endif
                                                                <img src="{{asset('images/home/'.$value->image)}}" class="img-responsive">
                                                            </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    @foreach($ecammallCategoryBannersSmall as $categoryBanner)
                                        <div class="col-xs-4 no-padding padding-bottom-2">
                                            <div class="category-banner">
                                                <a href="{{url('products/'.$categoryBanner->category_id)}}">
                                                    <img src="{{asset('images/home/'.$categoryBanner->image)}}">
                                                </a>
                                            </div>
                                            <div class="category-banner-name">
                                                <a href="{{url('products/'.$categoryBanner->category_id)}}">{{substr($categoryBanner->name,0,17)}}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                    <!--End Ecammall Category-->
                    <!--Latest Product-->
                    <?php
                    $pageManageLatestPro = \App\PageManagement::where('block','latest_product_homepage')->first();
                    ?>
                    @if($pageManageLatestPro->status == 0)
                    <div class="features_items">
                        <h2 class="title"><i class="fa fa-inbox"></i> Latest Product</h2>
                        @foreach($latestProduct as $latest)
                            <?php
                            $firstImage = \App\Thumbnails::where('product_id',$latest->id)->first();
                            $imageName = isset($firstImage->image)?$firstImage->image:$latest->image;
                            $adminPromotion = \App\AdminPromotion::where('id',$latest->admin_promotion)->first();
                            ?>
                            <div class="col-md-2 col-sm-3 col-xs-6 padding-5px frame">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{url('shop/product_detail/'.$latest->id)}}">
                                                <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" class="img-special-offer" />
                                            </a>
                                            <p class="text-height">{{substr($latest->name,0,40)}}</p>
                                            <h4>Price : $ {{sprintf('%0.2f', $latest->price)}}</h4>
                                            {{--<a href="{{url('shop/product_detail/'.$special->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>--}}
                                        </div>
                                        @if($adminPromotion)
                                            <div class="admin-promotion">
                                                <img src="{{asset('images/'.$adminPromotion->image)}}" class="img-responsive">
                                            </div>
                                        @endif

                                        @if($latest->discount_rate > 0)
                                            <div class="discount">
                                                <img src="{{asset('images/home/discount.png')}}">
                                                <p>{{$latest->discount_rate}}</p>
                                            </div>
                                        {{--@elseif($latest->quantity <= 0)
                                            <div class="sale">
                                                <img src="{{asset('images/home/sold-out.png')}}">
                                                <p>Sold</p>
                                            </div>--}}
                                        @endif
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <?php
                                            if(Auth::check()){
                                                $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$latest->id)->first();
                                            }
                                            ?>
                                            <input type="hidden" name="product_from" value="0" class="product_from">
                                            <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                            <li>
                                                <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$latest->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                            @if(Auth::check() and $wishList)
                                                <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                            @else
                                                <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$latest->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                </li>
                                            @endif
                                            <li><a href="{{url('shop/product_detail/'.$latest->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    <!--End latest product-->
                    <!--Special Offers-->
                    <?php
                    $pageManageSpecialOffer = \App\PageManagement::where('block','special_offer_homepage')->first();
                    ?>
                    @if($pageManageSpecialOffer->status == 0)
                    <div class="features_items">
                        <h2 class="title"> <i class="fa fa-gift"></i> Special Offers</h2>
                        @foreach($UserProduct as $special)
                            <?php
                                $firstImage = \App\Thumbnails::where('product_id',$special->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$special->image;
                                $adminPromotion = \App\AdminPromotion::where('id',$special->admin_promotion)->first();

                            ?>
                            <div class="col-md-2 col-sm-3 col-xs-6 padding-5px">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{url('shop/product_detail/'.$special->id)}}">
                                                <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" class="img-special-offer" />
                                            </a>
                                            <p class="text-height">{{substr($special->name,0,40)}}</p>
                                            <h4>Price : $ {{sprintf('%0.2f', $special->price)}}</h4>
                                            {{--<a href="{{url('shop/product_detail/'.$special->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>--}}
                                        </div>
                                        @if($adminPromotion)
                                            <div class="admin-promotion">
                                                <img src="{{asset('images/'.$adminPromotion->image)}}" class="img-responsive">
                                            </div>
                                        @endif
                                        {{--<div class="product-overlay">--}}
                                        {{--<div class="overlay-content">--}}
                                        {{--<h2>$ {{sprintf('%0.2f', $feature->price)}}</h2>--}}
                                        {{--<p>{{$feature->name}}</p>--}}
                                        {{--<a href="{{url('product_detail/'.$feature->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        @if($special->discount_rate > 0)
                                        <div class="discount">
                                            <img src="{{asset('images/home/discount.png')}}">
                                            <p>{{$special->discount_rate}}</p>
                                        </div>
                                        {{--@elseif($special->quantity <= 0)
                                            <div class="sale">
                                                <img src="{{asset('images/home/sold-out.png')}}">
                                                <p>Sold</p>
                                            </div>--}}
                                        @endif
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <?php
                                            if(Auth::check()){
                                                $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$special->id)->first();
                                            }
                                            ?>
                                            <input type="hidden" name="product_from" value="0" class="product_from">
                                            <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                            <li>
                                                <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$special->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                            @if(Auth::check() and $wishList)
                                                <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                            @else
                                                <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$special->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                </li>
                                            @endif
                                            <li><a href="{{url('shop/product_detail/'.$special->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    <!--End special offers-->
                    <div class="hidden-xs">
                        <?php
                        $featureBanners = \App\CategorySlide::where('slide_type',13)->take(2)->get();
                        ?>
                        @foreach($featureBanners as $fBanner)
                            <div class="col-md-6 col-xs-12 padding-5px">
                                @if(!empty($fBanner->url))
                                    <a href="https://{{$fBanner->url}}" @if($fBanner->open_new_tab ==1) target="_blank" @endif>
                                        <img alt="" src="{{asset('images/home/'.$fBanner->image)}}" class="img-responsive">
                                    </a>
                                @else
                                    <a href="{{url('product_detail/'.$fBanner->product_id)}}" >
                                        <img alt="" src="{{asset('images/home/'.$fBanner->image)}}" class="img-responsive">
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="visible-xs">
                        <?php
                        $featureBanners = \App\CategorySlide::where('slide_type',13)->take(1)->get();
                        ?>
                        @foreach($featureBanners as $fBanner)
                            <div class="col-md-6 col-xs-12 padding-5px">
                                @if(!empty($fBanner->url))
                                    <a href="https://{{$fBanner->url}}" @if($fBanner->open_new_tab ==1) target="_blank" @endif>
                                        <img alt="" src="{{asset('images/home/'.$fBanner->image)}}" class="img-responsive">
                                    </a>
                                @else
                                    <a href="{{url('product_detail/'.$fBanner->product_id)}}" >
                                        <img alt="" src="{{asset('images/home/'.$fBanner->image)}}" class="img-responsive">
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!--Feature Item-->
                    <?php
                    $pageManageFeaturedItem = \App\PageManagement::where('block','featured_item_homepage')->first();
                    ?>
                    @if($pageManageFeaturedItem->status == 0)
                    <div class="col-sm-3 hidden-xs">
                        <div class="left-sidebar">
                            <h2>Category</h2>
                            <div class="panel-group category-products" id="accordian"><!--category-productsr-->


                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="{{url('products')}}">All Products</a></h4>
                                    </div>
                                </div>
                                @foreach($categories as $category)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <a href="{{url('products/'.$category->id)}}">
                                                <h4 class="panel-title">
                                                    {{$category->name}}
                                                </h4>
                                            </a>
                                        </div>

                                    </div>
                                @endforeach

                            </div><!--/category-products-->


                            <div class="shipping text-center"><!--shipping-->
                                <?php $Ads = \App\CategorySlide::where(['status'=>0,'slide_type'=>5])->get()?>
                                <div id="advertise-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach($Ads as $key=>$Ad)
                                            <div class="item @if($key == 0) active @endif">
                                                <div class="col-sm-12 no-padding">
                                                    @if(empty($Ad->url))
                                                        <a href="{{url($Ad->url)}}" target="_blank"> <img src="{{asset('images/home/'.$Ad->image)}}"></a>
                                                    @else
                                                        <a href="{{url('product_detail/'.$Ad->product_id)}}"> <img src="{{asset('images/home/'.$Ad->image)}}" class="img-responsive"></a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div><!--/shipping-->

                        </div>
                    </div>

                    <div class="col-sm-9 col-xs-12">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title">Features Items</h2>
                            @foreach($feature_items as $feature)
                                <div class="col-md-3 col-sm-4 col-xs-6 padding-5px">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{url('product_detail/'.$feature->id)}}">
                                                    <img src="{{$base_url}}stock/assets/uploads/{{$feature->image}}" alt="" class="img-responsive"/></a>
                                                <p class="text-height">{{substr($feature->name,0,40)}}</p>
                                                {{--<p>{{$feature->name}}</p>--}}
                                                <h4>Price :  $ {{sprintf('%0.2f', $feature->price)}}</h4>
                                                {{--<a href="{{url('product_detail/'.$feature->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>--}}
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <?php
                                                if(Auth::check()){
                                                    $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$feature->id)->first();
                                                }
                                                ?>
                                                <input type="hidden" name="product_from" value="1" class="product_from">
                                                <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                                <li>
                                                    <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$feature->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                @if(Auth::check() and $wishList)
                                                    <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                @else
                                                    <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$feature->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                    </li>
                                                @endif
                                                <li><a href="{{url('product_detail/'.$feature->id)}}"><i class="fa fa-info-circle"></i> Detail</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--features_items-->
                    </div>
                    @endif
                    <!--End Feature Item-->
                </div>
            </div>
            <!--SubCategory List-->
                <?php
                    $pageManageSubCatList = \App\PageManagement::where('block','subcategory_list_homepage')->first();
                    $ArrayTop = ['0','1','2'];
                    $category = \App\Category::where('parent_id',0)->take(10)->get();
                    /*join('sma_subcategories','sma_categories.id','=','sma_subcategories.category_id')
                    ->select('sma_categories.*')
                    ->groupBy('id')
                    ->get();*/
                ?>
                @if($pageManageSubCatList->status == 0)
                <div class="hidden-xs">
                    @foreach($category as $cat)
                    <div class="row white-bg margin-top">
                        <div class="col-sm-3">
                            <div class="left-sidebar ">
                            <h2>{{$cat->name}}</h2>
                            <div class="panel-group category-products" id="accordian" style="height: 331px"><!--category-productsr-->
                                <?php $subcategory = \App\Category::where('parent_id',$cat->id)->take(11)->get();
                                      $subcategoryMiddle = \App\Category::where('parent_id',$cat->id)->take(6)->inRandomOrder()->orderBy('id','desc')->get();
                                      $slide_category_right = \App\CategorySlide::where(['category_id'=>$cat->id,'status'=>0,'slide_type'=>1])->orderBy('id','desc')->get();
                                      $slide_category_bottom = \App\CategorySlide::where(['category_id'=>$cat->id,'status'=>0,'slide_type'=>2])->get();
                                ?>
                                @foreach($subcategory as $subCat)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a href="{{url('products/category/'.$subCat->id)}}">{{$subCat->name}}</a></h4>
                                        </div>
                                    </div>
                                @endforeach
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a href="{{url('products/'.$cat->id)}}">See more >></a> </h4>
                                        </div>
                                    </div>
                            </div>
                            <!--/category-products-->
                            </div>
                        </div>
                        <div class="col-sm-6" style="padding-top: 15px">
                            <div class="features_items">
                                @foreach($subcategoryMiddle as $key=>$subCat)
                                    <?Php
                                        $productInSub = \App\ShopProduct::where('sub_category_id',$subCat->id)->first();
                                    ?>
                                <div class="col-sm-4 col-xs-4 padding-5px">
                                    <div class="category-image">
                                        @if($productInSub)
                                            <?php
                                            $firstImage = \App\Thumbnails::where('product_id',$productInSub->id)->inRandomOrder()->first();
                                            $imageName = isset($firstImage->image)?$firstImage->image:$productInSub->image;
                                            ?>
                                            <a href="{{url('products/category/'.$subCat->id)}}">
                                                    <img src="images/thumbnails/medium/{{$imageName}}" alt="" class="img-responsive" />
                                            </a>
                                        @else
                                        <a href="{{url('products/category/'.$subCat->id)}}">
                                            @if(empty($subCat->image))
                                                <img src="{{$base_url}}stock/assets/uploads/no_image.png" alt="" class="img-responsive" />
                                            @else
                                                <img src="{{$base_url}}stock/assets/uploads/{{$subCat->image}}" alt="" class="img-responsive" />
                                            @endif
                                        </a>
                                        @endif
                                    </div>
                                    <div class="category-name">
                                        <a href="{{url('products/category/'.$subCat->id)}}">{{substr($subCat->name,0,17)}}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-3 nopadding padding-bottom-5">
                            <div id="slide-item-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                                <div class="carousel-inner">
                                    @foreach($slide_category_right as $key=>$CatSlide)
                                    <div class="item @if($key == 0) active @endif">
                                        <div class="col-sm-12" style="padding-top: 15px; padding-right:0px">
                                            @if($CatSlide->product_id == 0)
                                                <a href="https://{{$CatSlide->url}}" @if($CatSlide->open_new_tab ==1) target="_blank" @endif>
                                            @else
                                            <a href="{{url('product_detail/'.$CatSlide->product_id)}}">
                                            @endif
                                                <img src="{{asset('images/home/'.$CatSlide->image)}}" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @foreach($slide_category_bottom as $key=>$CatSlideBottom)
                        <div class="col-sm-12" style="padding-bottom: 10px">
                            @if(!empty($CatSlideBottom->url))
                                <a href="https://{{$CatSlideBottom->url}}" @if($CatSlideBottom->open_new_tab ==1) target="_blank" @endif>
                                    <img alt="" src="{{asset('images/home/'.$CatSlideBottom->image)}}" class="img-responsive">
                                </a>
                            @else
                                <a href="{{url('product_detail/'.$CatSlideBottom->product_id)}}" >
                                    <img alt="" src="{{asset('images/home/'.$CatSlideBottom->image)}}" class="img-responsive">
                                </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endif
            <!--End Subcategory-->

            <!--Product by category -->
            <?php
                $pageManageProCat = \App\PageManagement::where('block','pro_cat_home_page')->first();
                $pageManageRecomment = \App\PageManagement::where('block','recomment_item_home_page')->first();
            ?>
            @if($pageManageProCat->status == 0)
            <div class="row white-bg">
                <div class="menu-tab"><!--category-tab-->
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
                                ->where('sma_products.featured','!=',Null)
                                ->orderBy('sma_products.id','desc')
                                ->take(12)
                                ->get();
                            ?>
                            @foreach($category_blog as $key=>$item)
                                @if($category->id == $item->category_id)
                            <div class="col-md-2 col-sm-3 col-xs-6 padding-5px">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{url('product_detail/'.$item->id)}}"><img src="{{$base_url}}stock/assets/uploads/{{$item->image}}" alt="" class="img-responsive"/></a>
                                            <p class="text-height">{{substr($item->name,0,40)}}</p>
                                            {{--<p>{{$feature->name}}</p>--}}
                                            <h4>Price :  $ {{sprintf('%0.2f', $item->price)}}</h4>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <?php
                                            if(Auth::check()){
                                                $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$item->id)->first();
                                            }
                                            ?>
                                            <input type="hidden" name="product_from" value="0" class="product_from">
                                            <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                            <li>
                                                <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$item->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                            @if(Auth::check() and $wishList)
                                                <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                            @else
                                                <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$item->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                </li>
                                            @endif
                                            <li><a href="{{url('product_detail/'.$item->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                        </ul>
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
            @endif
            <!--End product by category-->
            <!--Recommenced Item Homepage-->
            @if($pageManageRecomment->status == 0)
            <div class="row white-bg margin-top">
                <div class="col-md-12">
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title">recommended items</h2>
                        <div id="recommended-item-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                            <div class="carousel-inner">
                                @foreach($recomment_items->chunk(6) as $count => $recomments)
                                    <div class="item {{ $count == 0 ? 'active' : '' }}">
                                        @foreach($recomments as $recomment)
                                        <div class="col-md-2 col-sm-3 col-xs-6 padding-5px">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <a href="{{url('product_detail/'.$recomment->id)}}"><img src="{{$base_url}}stock/assets/uploads/{{$recomment->image}}" alt="" class="img-responsive" /></a>
                                                        <p class="text-height">{{substr($recomment->name,0,40)}}</p>
                                                        {{--<p>{{$feature->name}}</p>--}}
                                                        <h4>Price :  $ {{sprintf('%0.2f', $recomment->price)}}</h4>
                                                        {{--<a href="{{url('product_detail/'.$recomment->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>--}}
                                                    </div>
                                                </div>
                                                <div class="choose">
                                                    <ul class="nav nav-pills nav-justified">
                                                        <?php
                                                        if(Auth::check()){
                                                            $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$recomment->id)->first();
                                                        }
                                                        ?>
                                                        <input type="hidden" name="product_from" value="0" class="product_from">
                                                        <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                                        <li>
                                                            <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$recomment->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                        @if(Auth::check() and $wishList)
                                                            <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                        @else
                                                            <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$recomment->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                            </li>
                                                        @endif
                                                        <li><a href="{{url('product_detail/'.$recomment->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @endforeach
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
            @endif
            <!--End Recommenced item-->
        </div>
    </section>

@endsection

@section('js')
    <script src="{{asset('js/bootstrap-swipe-carousel/bootstrap-swipe-carousel.min.js')}}"></script>
    <script src="{{asset('js/js-to-time/jquery.time-to.js')}}"></script>
    <script>
        $('#slider-carousel').carousel().swipeCarousel({
            sensitivity : 'high',
            swipe : 20
        });
        $('.flash-sale-carousel').carousel().swipeCarousel({
            // low, medium or high
            sensitivity: 'high',
            swipe : 30
        });
        /**
         * Set theme and captions
         */
        var time = '23:59:54';
        $('.countdown-3').timeTo({
            timeTo: new Date(new Date('Sat Nov 02 2019 09:00:00 GMT+0700 (Indochina Time)')),
//            time: time,
            displayDays: 2,
            theme: "black",
            displayCaptions: false,
            fontSize: 12,
            lang: 'en'
        });
    </script>
@endsection