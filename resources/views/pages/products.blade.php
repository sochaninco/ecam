@extends('layouts.app')
@section('title','Product')
@section('content')
    <?php
    $base_url = 'https://ecammall.com/';
    ?>
    @if(Request::is('shop/*'))
        <div class="container shop-menu-bg shop-page">
            <div class="col-sm-3 margin-top-5px">
                <div class="btn-group dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-animations="fadeInDown">
                        <a href="{{url('shop/'.$ShopInfo->shop_name)}}" class="shop-name">Store : <?php echo isset($ShopInfo->shop_name)?$ShopInfo->shop_name:''; ?></a>  <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-left margin-top-5px" role="menu">
                        <?php
                        $userShopInfo = \App\User::where('id',$ShopInfo->user_id)->first();
                        ?>
                        @if($userShopInfo->shop_info == 1)
                        <li><i class="fa fa-phone"></i> : {{$ShopInfo->phone}}</li>
                        <li><i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}}</li>
                        <li><i class="fa fa-home"></i> : {{$ShopInfo->address}}</li>
                        @endif
                        <li><i class="fa fa-globe"></i> : {{url('shop/'.$ShopInfo->shop_name)}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-9 no-padding">
                <div class="menu-tab-shop hidden-xs"><!--category-tab-->
                    <ul class="nav nav-tabs" style="margin-bottom: 0px;border-bottom: none">
                        <li><a href="{{url('shop/'.$ShopInfo->shop_name)}}" class="active">Store Home</a></li>
                        <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/all')}}">Products</a></li>
                        <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/top_selling')}}">Top Selling</a></li>
                        <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/new_arrival')}}">New Arrival</a></li>
                        <li><a href="{{url('#')}}">Feed Back</a></li>
                        <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/shop_contact')}}">Contact Us</a></li>
                    </ul>
                </div>
                <!--/category-tab-->
                <div class="visible-xs">
                    <div class="category margin-bottom-0">
                        <div class="shop-page-menu">
                            <ul class="shop-page-menu-list">
                                {{--<li><a href="{{url('/products')}}">
                                        <div class="category-bg">
                                            <img src="{{asset('images//ecammall/all-category.png')}}" class="img-responsive">
                                        </div>
                                        <span class="text">All Categories</span>
                                    </a>
                                </li>--}}
                                <li class="active"><a href="{{url('shop/'.$ShopInfo->shop_name)}}">Store Home</a></li>
                                <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/all')}}">Products</a></li>
                                <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/top_selling')}}">Top Selling</a></li>
                                <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/new_arrival')}}">New Arrival</a></li>
                                <li><a href="{{url('#')}}">Feed Back</a></li>
                                <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/shop_contact')}}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section id="advertisement">
        <div class="container no-padding">
            @if(\Request::is('shop/*'))
                <?php
                if(empty($ShopInfo->shop_image)){
                    $shopTheme = \App\ShopTheme::where('id',$ShopInfo->shop_theme)->first();
                    $ShopImage = $shopTheme->theme_banner;
                    $path = 'images/theme-shop';
                }else{
                    $ShopImage = $ShopInfo->shop_image;
                    $path = 'images/user-shop';
                }
                ?>
                @if(empty($ShopInfo->shop_image))
                    <img alt="" src="{{asset($path.'/'.$ShopImage)}}">
                @else
                    <img alt="" src="{{asset($path.'/'.$ShopImage)}}">
                @endif
            @else
                <?php
                $bannerM = \App\CategorySlide::where(['slide_type'=>17,'status'=>0])->first();
                ?>
                @if(!empty($bannerM))
                    <a href="{{$bannerM->url}}" target="_blank"> <img src="{{asset('images/home/'.$bannerM->image)}}" class="img-responsive"></a>
                @endif
            @endif
        </div>
    </section>

    @if(\Request::is('products/*'))
        <section class="visible-xs">
            <div class="category">
                <div class="category-container">
                    <ul class="category-list">
                        <li><a href="{{url('/products')}}">
                                <div class="category-bg">
                                    <img src="{{asset('images//ecammall/all-category.png')}}" class="img-responsive">
                                </div>
                                <span class="text">All Categories</span>
                            </a>
                        </li>
                        @foreach($SubCatMenu as $sub)
                            <li>
                                <a href="{{url('products/category/'.$sub->id)}}">
                                    <img src="{{asset('images/category/sub-small/'.$sub->logo)}}" class="img-responsive">
                                    <span class="text">{{$sub->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    @elseif(\Request::is('products'))
        <section class="visible-xs">
            <div class="category">
                <div class="category-container">
                    <ul class="category-list">
                        <li><a href="{{url('/products')}}">
                                <div class="category-bg">
                                    <img src="{{asset('images//ecammall/all-category.png')}}" class="img-responsive">
                                </div>
                                <span class="text">All Categories</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{url('products/'.$category->id)}}">
                                    <img src="{{$base_url}}images/{{$category->image_mobile}}" class="img-responsive">
                                    <span class="text">{{$category->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    @endif
    <section>
        <div class="container white-bg">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        @if (\Request::is('products/category/*'))
                            <div class="hidden-xs">
                                <h2>{{$categoryName}}</h2>
                                <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                                    @foreach($subcategory as $subCat)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title"><a href="{{url('products/category/'.$subCat->id)}}">{{$subCat->name}}</a></h4>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--/category-products-->
                        @elseif(\Request::is('shop/*'))
                            <div class="hidden-xs">
                                <h3>Store Category</h3>
                                <div class="panel-group category-products" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading-shop">
                                            <h4 class="panel-title"><a href="{{url('shop/'.$ShopInfo->shop_name.'/all')}}">All Product</a></h4>
                                        </div>
                                    </div>
                                @foreach($categories as $cat)
                                    <!--category-productsr-->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a>
                                                        {{$cat->name}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="panel-body" style="padding-top: 0px; padding-bottom: 0px;">
                                                <ul style="margin-bottom: 0px">
                                                    <?php $subcategory = \App\Category::join('shop_products','sma_categories.id','=','shop_products.sub_category_id')
                                                        ->select('sma_categories.*')->select('sma_categories.*')->where('parent_id',$cat->id)
                                                        ->where('shop_products.user_id',$ShopInfo->user_id)
                                                        ->take(10)->groupBy('id')->get(); ?>
                                                    @foreach($subcategory as $subCat)
                                                        <li><a href="{{url('shop/'.$ShopInfo->user_id.'/products/category/'.$subCat->id)}}">{{$subCat->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        @elseif(\Request::is('products/brands/*'))
                            <h2>Brand</h2>
                            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                                @foreach($ListBrand as $brand)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a href="{{url('products/brands/'.$brand->id)}}">{{$brand->name}}</a></h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @elseif(\Request::is('products/cities/*'))
                            <h2>City</h2>
                            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                                @foreach($ListCity as $city)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a href="{{url('products/cities/'.$city->id)}}">{{$city->name}}</a></h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @elseif(\Request::is('products/*'))
                            <div class="hidden-xs">
                                <h2>SubCategory</h2>
                                <div id="accordian" class="panel-group category-products"><!--category-productsr-->
                                    @foreach($SubCatMenu as $sub)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title"><a href="{{url('products/category/'.$sub->id)}}">{{$sub->name}}</a></h4>
                                            </div>
                                        </div>
                                    @endforeach
                                </div><!--/category-products-->
                            </div>
                        @else
                            <div class="hidden-xs">
                                <h2>Category</h2>
                                <div id="accordian" class="panel-group category-products"><!--category-productsr-->
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
                                </div><!--/category-products-->
                            </div>
                        @endif
                        {{--<div class="shipping text-center"><!--shipping-->
                            <img alt="" src="{{asset('images/home/shipping.jpg')}}">
                        </div><!--/shipping-->--}}
                        <div class="hidden-xs">
                            <h2> Popular Shop</h2>
                            <div class="row">
                                <?Php
                                $shopRandom = \App\PageShops::inRandomOrder()->take(7)->get();
                                ?>
                                @foreach($shopRandom as $shop)
                                    <?php
                                    $productByShop = \App\ShopProduct::where('user_id',$shop->user_id)->take(2)->get();
                                    $countProduct = \App\ShopProduct::where('user_id',$shop->user_id)->count();

                                    ?>
                                    @if($countProduct >= 2 && count($productByShop)>0)
                                        <div class="col-sm-12">
                                           <div class="store-info-popular gray-bg">
                                                    <a href="{{url('shop/'.$shop->shop_name)}}">
                                                        <h6> <img src="{{asset('images/user-shop/'.$shop->shop_logo)}}" class="store-info-img"> {{$shop->shop_name}}</h6>
                                                    </a>
                                                    <br>
                                                    @foreach($productByShop as $random)
                                                        <?php
                                                        $firstImage = \App\Thumbnails::where('product_id',$random->id)->first();
                                                        $imageName = isset($firstImage->image)?$firstImage->image:$random->image;
                                                        if(Auth::check()){
                                                            $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$random->id)->first();
                                                        }
                                                        ?>
                                                        <div class="col-sm-6 col-xs-6 padding-5px gray-bg">
                                                            <div class="product-image-wrapper-by-shop">
                                                                <div class="single-products">
                                                                    <div class="productinfo-left-by-shop text-center">
                                                                        {{--@if(\Request::is('shop/product_detail/*'))--}}
                                                                        <a href="{{url('shop/product_detail/'.$random->id)}}">
                                                                            <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" class="img-responsive"/></a>
                                                                        <div class="col-sm-8 no-padding">
                                                                            <h4>US$ {{sprintf('%0.2f', $random->price)}}</h4>
                                                                        </div>
                                                                        <div class="col-sm-2" style="margin: 10px 0;">
                                                                            @if(Auth::check() and $wishList)
                                                                                <a><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                                            @else
                                                                                <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$random->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="shipping text-center"><!--shipping-->
                                <?php $Ads = \App\CategorySlide::where(['status'=>0,'slide_type'=>5])->get()?>
                                <div id="advertise-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach($Ads as $key=>$Ad)
                                            <div class="item @if($key == 0) active @endif">
                                                <div class="col-sm-12 no-padding">
                                                    @if(!empty($Ad->url))
                                                        <a href="{{$Ad->url}}" target="_blank"> <img src="{{asset('images/home/'.$Ad->image)}}" class="img-responsive"></a>
                                                    @else
                                                        <a href="{{url('product_detail/'.$Ad->product_id)}}"> <img src="{{asset('images/home/'.$Ad->image)}}" class="img-responsive"></a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div><!--/shipping-->
                            @if (\Request::is('products/*'))
                                <h2>Related Product</h2>
                                <div id="recommended-item-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach($RelatedProducts as $key=>$related)
                                            <?php
                                            $firstImage = \App\Thumbnails::where('product_id',$related->id)->first();
                                            $imageName = isset($firstImage->image)?$firstImage->image:$related->image;
                                            ?>
                                            <div class="item @if($key == 0) active @endif">
                                                <div class="col-sm-12 no-padding">
                                                    <div class="product-image-wrapper">
                                                        <div class="single-products">
                                                            <div class="productinfo-left text-center">
                                                                {{--@if(\Request::is('shop/product_detail/*'))--}}
                                                                <a href="{{url('shop/product_detail/'.$related->id)}}">
                                                                    <img alt="" src="{{asset('images/thumbnails/medium/'.$imageName)}}"></a>
                                                                <p class="text-height">{{substr($related->name,0,40)}}</p>
                                                                <h4> Price : $ {{sprintf('%0.2f', $related->price)}}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <br>
                        </div>

                    </div>
                </div>


                <div class="col-sm-9 no-padding">
                    <div class="features_items"><!--features_items-->
                        @if (\Request::is('products/category/*'))
                            <h2 class="title">{{$sub_name}} Items</h2>
                        @elseif(\Request::is('products/brands/*'))
                            <h2 class="title">{{$brand_name}} Brand</h2>
                        @elseif(\Request::is('products/cities/*'))
                            <h2 class="title text-center">
                                {{$CityName}} City
                            </h2>
                        @elseif(\Request::is('shop/*'))
                            <h2 class="title text-center">
                                {{$subName}}
                            </h2>
                        @elseif(\Request::is('products/*'))
                            <h2 class="title">{{$categoryName}}</h2>
                        @else
                            <h2 class="title"> All Categories </h2>
                        @endif
                        <div id="brand-item-carousel" data-interval="false" data-type="multi" data-ride="carousel" class="carousel slide margin-top-5px hidden-xs">
                            <div class="carousel-inner">
                                @foreach($CategoryBrand->chunk(12) as $count => $brands)
                                    <div class="item {{ $count == 0 ? 'active' : '' }}">
                                        @foreach($brands as $brand)
                                            <div class="col-sm-1" style="padding-left: 1px;padding-right: 1px">
                                                <a href="{{url('products/brands/'.$brand->id)}}">
                                                    <img src="{{$base_url}}stock/assets/uploads/{{$brand->image}}" class="img-responsive img-brand-category">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <a class="left recommended-item-control-brand" href="#brand-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control-brand" href="#brand-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                        <div class="shorting mb-30">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-8 pull-right">
                                    @if(!\Request::is('shop/*'))
                                        <div class="view pull-right">
                                            <div class="list-types grid active">
                                                <a class="btn-grid-icon" style="cursor: pointer;">
                                                    <div class="grid-icon list-types-icon"></div>
                                                </a> </div>
                                            <div class="list-types list">
                                                <a class="btn-list-icon" style="cursor: pointer">
                                                    <div class="list-icon list-types-icon"></div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    <p class="count-in-list">{{$countProducts}}  <span> found </span></p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <div class="short-by float-right-sm">
                                        <div class="select-item">
                                            <select class="short-product">
                                                <option selected>Sort By  ...</option>
                                                <option value="name-asc">Name (A -> Z)</option>
                                                <option value="name-desc">Name (Z -> A)</option>
                                                <option value="price-asc">Price (Low -&gt; High)</option>
                                                <option value="price-desc">Price (High -&gt; Low)</option>
                                                {{--<option value="">rating(highest)</option>
                                                <option value="">rating(lowest)</option>--}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="display-grid">
                            @if (\Request::is('products/*'))
                                @foreach($UserProducts as $product)
                                    <?php
                                    $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                    $adminPromotion = \App\AdminPromotion::where('id',$product->admin_promotion)->first();
                                    ?>
                                    <div class="col-md-3 col-sm-4 col-xs-6 padding-5px products" data-price = "{{$product->price}}" data-name = "{{$product->name}}">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                        <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" class="img-responsive">
                                                    </a>
                                                    <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                    <h4>Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                    {{--<a href="{{url('shop/product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}
                                                </div>
                                                @if($adminPromotion)
                                                    <div class="admin-promotion-product-list-page">
                                                        <img src="{{asset('images/'.$adminPromotion->image)}}" class="img-responsive">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <?php
                                                    if(Auth::check()){
                                                        $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
                                                    }
                                                    ?>
                                                    <input type="hidden" name="product_from" value="0" class="product_from">
                                                    <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                                    <li>
                                                        <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$product->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                    @if(Auth::check() and $wishList)
                                                        <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                    @else
                                                        <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$product->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                        </li>
                                                    @endif
                                                    <li><a href="{{url('shop/product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                    <li>{{--<img src="{{asset('images/shop.png')}}">--}}
                                                        <a href="{{url('#')}}"> <i class="fa fa-home" aria-hidden="true"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if(!\Request::is('products/cities/*'))
                                @if(!empty($newProducts))
                                    @foreach($newProducts as $product)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                        $adminPromotion = \App\AdminPromotion::where('id',$product->admin_promotion)->first();
                                        ?>
                                        <div class="col-md-3 col-sm-4 col-xs-6 padding-5px products" data-price = "{{$product->price}}" data-name = "{{$product->name}}">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        @if(\Request::is('shop/*'))
                                                            <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                                <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" />
                                                            </a>
                                                            <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                            <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                            {{--<a href="{{url('shop/product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}
                                                        @else
                                                            <a href="{{url('product_detail/'.$product->id)}}">
                                                                <img alt="" src="{{$base_url}}stock/assets/uploads/{{$product->image}}">
                                                            </a>
                                                            <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                            <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                            <a href="{{url('product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>
                                                        @endif

                                                    </div>
                                                    @if($adminPromotion)
                                                        <div class="admin-promotion-product-list-page">
                                                            <img src="{{asset('images/'.$adminPromotion->image)}}" class="img-responsive">
                                                        </div>
                                                    @endif
                                                    {{--<div class="product-overlay">--}}{{--
                                                        --}}{{--<div class="overlay-content">--}}{{--
                                                            --}}{{--<h2>$ {{sprintf('%0.2f', $product->price)}}</h2>--}}{{--
                                                            --}}{{--<p>{{$product->name}}</p>--}}{{--
                                                            --}}{{--<a class="btn btn-default add-to-cart" href="{{url('product_detail/'.$product->id)}}"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}{{--
                                                        --}}{{--</div>--}}{{--
                                                    --}}{{--</div>--}}
                                                </div>
                                                <div class="choose">
                                                    <ul class="nav nav-pills nav-justified">
                                                        <?php
                                                        if(Auth::check()){
                                                            $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
                                                        }
                                                        ?>
                                                        <input type="hidden" name="product_from" value="0" class="product_from">
                                                        <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                                        <li>
                                                            <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$product->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                        @if(Auth::check() and $wishList)
                                                            <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                        @else
                                                            <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$product->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                            </li>
                                                        @endif
                                                        <li><a href="{{url('shop/product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if(!empty($newProducts))
                                    @if(!empty($products))
                                        <div class="clearfix"></div>
                                        <?php
                                        $bannerShopPage = \App\CategorySlide::where('slide_type',12)->get();
                                        ?>
                                        @foreach($bannerShopPage as $banner)
                                            <div class="col-sm-12 padding-5px margin-bottom-5px">
                                                <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                                            </div>
                                        @endforeach
                                        <h2 class="title text-center">All Products</h2>
                                    @endif
                                @endif
                                @if(Request::is('search'))
                                    @foreach($products as $product)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                        $adminPromotion = \App\AdminPromotion::where('id',$product->admin_promotion)->first();
                                        ?>
                                        <div class="col-md-3 col-sm-4 col-xs-6 padding-5px products" data-price = "{{$product->price}}" data-name = "{{$product->name}}">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                            <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" class="img-responsive">
                                                        </a>
                                                        <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                        <h4>Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                        {{--<a href="{{url('shop/product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}
                                                    </div>
                                                    @if($adminPromotion)
                                                        <div class="admin-promotion-product-list-page">
                                                            <img src="{{asset('images/'.$adminPromotion->image)}}" class="img-responsive">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="choose">
                                                    <ul class="nav nav-pills nav-justified">
                                                        <?php
                                                        if(Auth::check()){
                                                            $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
                                                        }
                                                        ?>
                                                        <input type="hidden" name="product_from" value="0" class="product_from">
                                                        <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                                        <li>
                                                            <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$product->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                        @if(Auth::check() and $wishList)
                                                            <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                        @else
                                                            <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$product->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                            </li>
                                                        @endif
                                                        <li><a href="{{url('shop/product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                        <li>{{--<img src="{{asset('images/shop.png')}}">--}}
                                                            <a href="{{url('#')}}"> <i class="fa fa-home" aria-hidden="true"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($products as $product)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                        $adminPromotion = \App\AdminPromotion::where('id',$product->admin_promotion)->first();
                                        ?>
                                        <div class="col-md-3 col-sm-4 col-xs-6 padding-5px products" data-price = "{{$product->price}}" data-name = "{{$product->name}}" >
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        @if(\Request::is('shop/*'))
                                                            <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                                <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" class="img-responsive"/>
                                                            </a>
                                                            <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                            <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                            {{--<a href="{{url('shop/product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}
                                                        @else
                                                            <a href="{{url('product_detail/'.$product->id)}}">
                                                                <img alt="" src="{{$base_url}}stock/assets/uploads/{{$product->image}}" class="img-responsive">
                                                            </a>
                                                            <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                            <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                            {{--<a href="{{url('product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}
                                                        @endif
                                                    </div>
                                                    @if($adminPromotion)
                                                        <div class="admin-promotion-product-list-page">
                                                            <img src="{{asset('images/'.$adminPromotion->image)}}" class="img-responsive">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="choose">
                                                    <ul class="nav nav-pills nav-justified">
                                                        <?php
                                                        if(Auth::check()){
                                                            $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
                                                        }
                                                        ?>
                                                        @if(\Request::is('shop/*'))
                                                            <input type="hidden" name="product_from" value="0" class="product_from">
                                                        @else
                                                            <input type="hidden" name="product_from" value="1" class="product_from">
                                                        @endif
                                                        <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                                        <li>
                                                            <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$product->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                        @if(Auth::check() and $wishList)
                                                            <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                        @else
                                                            <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$product->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                            </li>
                                                        @endif
                                                        @if(\Request::is('shop/*'))
                                                            <li><a href="{{url('shop/product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                        @else
                                                            <li><a href="{{url('product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                        @endif
                                                        <li><a href="{{url('#')}}"><i class="fa fa-home"></i> </a> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif

                        </div>
                        <div class="display-list">
                            @if (\Request::is('products/*'))
                                @foreach($UserProducts as $product)
                                    <?php
                                    $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                    $ShopInfo = \App\PageShops:: where('user_id',$product->user_id)->first();
                                    $thumbnails = \App\Thumbnails::where('product_id',$product->id)->take(3)->get();
//                                    $adminPromotion = \App\AdminPromotion::where('id',$product->admin_promotion)->first();
                                    ?>
                                    <div class="product-listing list-type products-list" data-price="{{$product->price}}" data-name = "{{$product->name}}">
                                        <div class="col-lg-12 col-xs-12 padding-5px">
                                            <div class="shop-list-view">
                                                <div class="product-item">
                                                    <div class="col-sm-6 product-image no-padding">
                                                        <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                            <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" />
                                                            {{--@if($adminPromotion)
                                                                <img src="{{asset('images/'.$adminPromotion->image)}}" class="admin-promotion-product-list-page">
                                                            @endif--}}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-item-details">
                                                    <div class="product-item-name">
                                                        <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                            <?php
                                                            $detail = $product->details;

                                                            echo substr($product->name,0,40);
                                                            ?>
                                                        </a>
                                                    </div>
                                                    <div class="price-box">
                                                        <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                    </div>
                                                    <div class="product-list-detail">
                                                        <p>{!! $detail !!}</p>
                                                    </div>

                                                    <div class="col-sm-12 no-padding">
                                                        <div class="row">
                                                            <div class="col-sm-4 col-xs-9 product-thumbnail-list no-padding">
                                                                @foreach($thumbnails as $thumbnail)
                                                                    <img src="{{asset('images/thumbnails/medium/'.$thumbnail->image)}}" width="40px" height="auto">
                                                                @endforeach
                                                                <div class="choose">
                                                                    <ul class="nav nav-pills nav-justified">
                                                                        <?php
                                                                        if(Auth::check()){
                                                                            $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
                                                                        }
                                                                        ?>
                                                                        @if(\Request::is('shop/*'))
                                                                            <input type="hidden" name="product_from" value="0" class="product_from">
                                                                        @else
                                                                            <input type="hidden" name="product_from" value="1" class="product_from">
                                                                        @endif
                                                                        <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                                                        <li>
                                                                            <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$product->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                                        @if(Auth::check() and $wishList)
                                                                            <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                                        @else
                                                                            <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$product->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                                            </li>
                                                                        @endif
                                                                        <li><a href="{{url('shop/product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-8 col-xs-3">
                                                                <div class="shop-information-list-view pull-right"><!--/product-information-->
                                                                    <div class="hidden-xs">
                                                                        <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                                            <h2><img src="{{asset('images/shop.png')}}"> {{$ShopInfo->shop_name}}</h2>
                                                                        </a>
                                                                    </div>
                                                                    <div class="visible-xs">
                                                                        <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                                            <h2><img src="{{asset('images/shop.png')}}"></h2>
                                                                        </a>
                                                                    </div>
                                                                    {{--<i class="fa fa-phone"></i> : {{$ShopInfo->phone}} | <i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}} <br>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if(!\Request::is('products/cities/*'))
                                @if(!empty($newProducts))
                                    @foreach($newProducts as $product)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                        ?>
                                        <div class="col-md-3 col-sm-4 col-xs-12 padding-5px">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        @if(\Request::is('shop/*'))
                                                            <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                                <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" />
                                                            </a>
                                                            <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                            <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                            {{--<a href="{{url('shop/product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}
                                                        @else
                                                            <a href="{{url('product_detail/'.$product->id)}}">
                                                                <img alt="" src="{{$base_url}}stock/assets/uploads/{{$product->image}}">
                                                            </a>
                                                            <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                            <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                            <a href="{{url('product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>
                                                        @endif

                                                    </div>
                                                    {{--<div class="product-overlay">--}}{{--
                                                        --}}{{--<div class="overlay-content">--}}{{--
                                                            --}}{{--<h2>$ {{sprintf('%0.2f', $product->price)}}</h2>--}}{{--
                                                            --}}{{--<p>{{$product->name}}</p>--}}{{--
                                                            --}}{{--<a class="btn btn-default add-to-cart" href="{{url('product_detail/'.$product->id)}}"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}{{--
                                                        --}}{{--</div>--}}{{--
                                                    --}}{{--</div>--}}
                                                </div>
                                                <div class="choose">
                                                    <ul class="nav nav-pills nav-justified">
                                                        <?php
                                                        if(Auth::check()){
                                                            $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
                                                        }
                                                        ?>
                                                        <input type="hidden" name="product_from" value="0" class="product_from">
                                                        <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                                        <li>
                                                            <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$product->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                        @if(Auth::check() and $wishList)
                                                            <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                        @else
                                                            <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$product->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                            </li>
                                                        @endif
                                                        <li><a href="{{url('shop/product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if(!empty($newProducts))
                                    @if(!empty($products))
                                        <div class="clearfix"></div>
                                        <?php
                                        $bannerShopPage = \App\CategorySlide::where('slide_type',12)->get();
                                        ?>
                                        @foreach($bannerShopPage as $banner)
                                            <div class="col-sm-12" style="padding-bottom: 10px">
                                                <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                                            </div>
                                        @endforeach
                                        <h2 class="title text-center">All Products</h2>
                                    @endif
                                @endif
                                @if(\Request::is('search'))
                                    @foreach($products as $product)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                        $ShopInfo = \App\PageShops:: where('user_id',$product->user_id)->first();
                                        $thumbnails = \App\Thumbnails::where('product_id',$product->id)->take(3)->get();
                                        ?>
                                        <div class="product-listing list-type products-list" data-price="{{$product->price}}" data-name = "{{$product->name}}">
                                            <div class="col-lg-12 col-xs-12 padding-5px">
                                                <div class="shop-list-view">
                                                    <div class="product-item">
                                                        <div class="col-sm-6 product-image no-padding">
                                                            <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                                <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-item-details">
                                                        <div class="product-item-name">
                                                            <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                                <?php
                                                                $detail = $product->details;
                                                                ?>

                                                                {{$product->name}}
                                                            </a>
                                                        </div>
                                                        <div class="price-box">
                                                            <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                        </div>
                                                        <div class="product-list-detail">
                                                            <p>{!! $detail !!}</p>
                                                        </div>

                                                        <div class="col-sm-12 no-padding">
                                                            <div class="row">
                                                                <div class="col-sm-4 col-xs-9 product-thumbnail-list no-padding">
                                                                    @foreach($thumbnails as $thumbnail)
                                                                        <img src="{{asset('images/thumbnails/medium/'.$thumbnail->image)}}" width="40px" height="auto">
                                                                    @endforeach
                                                                    <div class="choose">
                                                                        <ul class="nav nav-pills nav-justified">
                                                                            <?php
                                                                            if(Auth::check()){
                                                                                $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
                                                                            }
                                                                            ?>
                                                                            @if(\Request::is('shop/*'))
                                                                                <input type="hidden" name="product_from" value="0" class="product_from">
                                                                            @else
                                                                                <input type="hidden" name="product_from" value="1" class="product_from">
                                                                            @endif
                                                                            <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                                                            <li>
                                                                                <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$product->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                                            @if(Auth::check() and $wishList)
                                                                                <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                                            @else
                                                                                <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$product->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                                                </li>
                                                                            @endif
                                                                            <li><a href="{{url('shop/product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-8 col-xs-3">
                                                                    <div class="shop-information-list-view pull-right"><!--/product-information-->
                                                                        <div class="hidden-xs">
                                                                            <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                                                <h2><img src="{{asset('images/shop.png')}}"> {{$ShopInfo->shop_name}}</h2>
                                                                            </a>
                                                                        </div>
                                                                        <div class="visible-xs">
                                                                            <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                                                <h2><img src="{{asset('images/shop.png')}}"></h2>
                                                                            </a>
                                                                        </div>
                                                                        {{--<i class="fa fa-phone"></i> : {{$ShopInfo->phone}} | <i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}} <br>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($products as $product)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                        $ShopInfo = \App\PageShops:: where('user_id',1)->first();
                                        $thumbnails = \App\ProductThumnail::where('product_id',$product->id)->take(3)->get();
                                        ?>
                                        <div class="product-listing list-type products-list" data-price="{{$product->price}}" data-name = "{{$product->name}}">
                                            <div class="col-lg-12 col-xs-12 padding-5px">
                                                <div class="shop-list-view">
                                                    <div class="product-item">
                                                        <div class="col-sm-6 product-image no-padding">
                                                            @if(\Request::is('shop/*'))
                                                                <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                                    <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" />
                                                                </a>
                                                            @else
                                                                <a href="{{url('product_detail/'.$product->id)}}">
                                                                    <img alt="" src="{{$base_url}}stock/assets/uploads/{{$product->image}}">
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="product-item-details">
                                                        <div class="product-item-name">
                                                            @if(\Request::is('shop/*'))
                                                                <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                                    <?php
                                                                    $detail = $product->details;
                                                                    ?>
                                                                    @else
                                                                        <a href="{{url('product_detail/'.$product->id)}}">
                                                                            <?php
                                                                            $detail = $product->detail;
                                                                            ?>
                                                                            @endif
                                                                            {{$product->name}}
                                                                        </a>
                                                        </div>
                                                        <div class="price-box">
                                                            <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                        </div>
                                                        <p>{!! $detail !!}</p>

                                                        <div class="col-sm-12 no-padding">
                                                            <div class="row">
                                                                <div class="product-thumbnail-list col-sm-4 col-xs-9 no-padding">
                                                                    @foreach($thumbnails as $thumbnail)
                                                                        <img alt="" src="{{$base_url}}stock/assets/uploads/{{$thumbnail->photo}}" width="40px" height="auto">
                                                                    @endforeach
                                                                    <div class="choose">
                                                                        <ul class="nav nav-pills nav-justified">
                                                                            <?php
                                                                            if(Auth::check()){
                                                                                $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
                                                                            }
                                                                            ?>
                                                                            @if(\Request::is('shop/*'))
                                                                                <input type="hidden" name="product_from" value="0" class="product_from">
                                                                            @else
                                                                                <input type="hidden" name="product_from" value="1" class="product_from">
                                                                            @endif
                                                                            <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                                                            <li>
                                                                                <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$product->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                                            @if(Auth::check() and $wishList)
                                                                                <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                                            @else
                                                                                <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$product->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                                                </li>
                                                                            @endif
                                                                            @if(\Request::is('shop/*'))
                                                                                <li><a href="{{url('shop/product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                                            @else
                                                                                <li><a href="{{url('product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-8 col-xs-3">
                                                                    <div class="shop-information-list-view pull-right"><!--/product-information-->
                                                                        <div class="hidden-xs">
                                                                            <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                                                <h2><img src="{{asset('images/shop.png')}}"> {{$ShopInfo->shop_name}}</h2>
                                                                            </a>
                                                                        </div>
                                                                        <div class="visible-xs">
                                                                            <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                                                <h2><img src="{{asset('images/shop.png')}}"> </h2>
                                                                            </a>
                                                                        </div>
                                                                        {{--<i class="fa fa-phone"></i> : {{$ShopInfo->phone}} | <i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}} <br>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>


                        {{--<div class="ajax-load text-center" style="display:none">
                            <p>Loading...</p>
                        </div>--}}
                        <div class="clearfix"></div>
                        @if(\Request::is('products/cities/*'))
                            <ul class="pagination">
                                {!! $UserProducts->render() !!}
                            </ul>
                        @else
                            @if(!empty($products))
                                <ul class="pagination">
                                    {!! $products->render() !!}
                                </ul>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        var page = 1;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });
        function loadMoreData(page){
            $.ajax(
                {
                    url: '?page=' + page,
                    type: "get",
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data)
                {
                    if(data.html === ""){
                        $('.ajax-load').html("No more records found");
                        return;
                    }else{
                        $('.ajax-load').hide();
                        $(".display-grid").alert(data.html);
                    }

                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
// alert('server not responding...');
                });
        }
    </script>
@endsection