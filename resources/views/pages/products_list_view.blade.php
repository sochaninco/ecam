@extends('layouts.app')
@section('title','Product')
@section('content')
    <?php
    $base_url = 'http://ecammall.com/';
    ?>
    @if(Request::is('shop/*'))
        <div class="container shop-menu-bg shop-page">
            <div class="col-sm-3 margin-top-5px">
                <div class="btn-group dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-animations="fadeInDown">
                        <a href="{{url('shop/'.$ShopInfo->shop_name)}}" class="shop-name">Store : <?php echo isset($ShopInfo->shop_name)?$ShopInfo->shop_name:''; ?></a>  <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-left margin-top-5px" role="menu">
                        <li><i class="fa fa-phone"></i> : {{$ShopInfo->phone}}</li>
                        <li><i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}}</li>
                        <li><i class="fa fa-home"></i> : {{$ShopInfo->address}}</li>
                        <li><i class="fa fa-globe"></i> : {{$ShopInfo->website}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-9 no-padding">
                <div class="menu-tab-shop"><!--category-tab-->
                    <ul class="nav nav-tabs" style="margin-bottom: 0px;border-bottom: none">
                        <li><a href="{{url('shop/'.$ShopInfo->shop_name)}}" class="active">Store Home</a></li>
                        <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/all')}}">Products</a></li>
                        <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/top_selling')}}">Top Selling</a></li>
                        <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/new_arrival')}}">New Arrival</a></li>
                        <li><a href="{{url('#')}}">Feed Back</a></li>
                        <li><a href="{{url('shop/'.$ShopInfo->shop_name.'/shop_contact')}}">Contact Us</a></li>
                    </ul>
                </div><!--/category-tab-->
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
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>7])->get();
                ?>
                @foreach($Product_banner as $banner)
                        <a href="{{url('product_detail/'.$banner->product_id)}}" >
                            <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                        </a>

                @endforeach
            @endif
        </div>
    </section>
    <section>
        <div class="container white-bg">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        @if (\Request::is('products/category/*'))
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
                            <!--/category-products-->
                        @elseif(\Request::is('shop/*'))
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
                        @else
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
                        @endif
                        {{--<div class="shipping text-center"><!--shipping-->
                            <img alt="" src="{{asset('images/home/shipping.jpg')}}">
                        </div><!--/shipping-->--}}
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
                            @foreach($RandomProducts as $random)
                                <?php
                                $firstImage = \App\Thumbnails::where('product_id',$random->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$random->image;
                                ?>
                            <div class="col-sm-12 no-padding">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo-left text-center">
                                            {{--@if(\Request::is('shop/product_detail/*'))--}}
                                            <a href="{{url('shop/product_detail/'.$random->id)}}">
                                                <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" /></a>
                                            <p class="text-height">{{substr($random->name,0,40)}}</p>
                                            <h4>Price : $ {{sprintf('%0.2f', $random->price)}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                    </div>
                </div>


                <div class="col-sm-9">
                    <div class="features_items"><!--features_items-->
                        @if (\Request::is('products/category/*'))
                            <h2 class="title">Brand</h2>
                            <div id="brand-item-carousel" data-interval="false" data-type="multi" data-ride="carousel" class="carousel slide margin-top-5px">
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
                            <h2 class="title text-center">
                                    {{$sub_name}} Items
                            </h2>
                        @elseif(\Request::is('products/brands/*'))
                            <h2 class="title">Brand Logo</h2>
                            <div id="brand-item-carousel" data-interval="false" data-type="multi" data-ride="carousel" class="carousel slide margin-top-5px">
                                <div class="carousel-inner">
                                    @foreach($ListBrand->chunk(12) as $count => $brands)
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
                            <h2 class="title text-center">
                                {{$brand_name}} Brand
                            </h2>
                        @elseif(\Request::is('products/cities/*'))
                            <h2 class="title text-center">
                                {{$CityName}} City
                            </h2>
                        @elseif(\Request::is('shop/*'))
                            <h2 class="title text-center">
                                {{$subName}}
                            </h2>
                        @else
                            <h2 class="title">Brand</h2>
                            <div id="brand-item-carousel" data-interval="false" data-type="multi" data-ride="carousel" class="carousel slide margin-top-5px">
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
                                    <div class="col-md-3 pull-right">
                                        <div class="view">
                                            <div class="list-types grid"> <a href="{{url('products/')}}">
                                                    <div class="grid-icon list-types-icon"></div>
                                                </a> </div>
                                            <div class="list-types list active"> <a href="{{$_SERVER['REQUEST_URI']}}">
                                                    <div class="list-icon list-types-icon"></div>
                                                </a> </div>
                                        </div>
                                        {{--<div class="short-by float-right-sm"> <span>Sort By</span>
                                            <div class="select-item">
                                                <select>
                                                    <option selected="selected" value="">Name (A to Z)</option>
                                                    <option value="">Name(Z - A)</option>
                                                    <option value="">price(low&gt;high)</option>
                                                    <option value="">price(high &gt; low)</option>
                                                    <option value="">rating(highest)</option>
                                                    <option value="">rating(lowest)</option>
                                                </select>
                                            </div>
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (\Request::is('products/*'))
                            @foreach($UserProducts as $product)
                                <?php
                                $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                $ShopInfo = \App\PageShops:: where('user_id',$product->user_id)->first();
                                ?>
                                <div class="col-md-3 col-sm-4 col-xs-12 padding-5px">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                    <img src="{{asset('images/thumbnails/medium/'.$imageName)}}">
                                                </a>
                                                <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                <h4>Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                {{--<a href="{{url('shop/product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}
                                            </div>
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
                                        <div class="col-sm-12 no-padding">
                                            <div class="shop-information"><!--/product-information-->
                                                <div class="col-sm-3">
                                                    <a href="{{url('/products')}}">
                                                        <img src="{{asset('images/user-shop/'.$ShopInfo->shop_logo)}}" class="img-responsive">
                                                    </a>
                                                </div>
                                                <div class="col-sm-9">
                                                    <a href="{{url('/products')}}">
                                                        <h2>{{$ShopInfo->shop_name}}</h2>
                                                    </a>
                                                    <i class="fa fa-phone"></i> : {{$ShopInfo->phone}} | <i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}} <br>
                                                    <i class="fa fa-home"></i> : {{$ShopInfo->address}} <br>
                                                    <i class="fa fa-globe"></i> : {{$ShopInfo->website}}

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
                                                        <a href="{{url('shop/product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>
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
                                                    <li><a href="#"><i aria-hidden="true" class="fa fa-shopping-cart"></i>Add to Cart</a></li>
                                                    <li><a href="#"><i aria-hidden="true" class="fa fa-heart"></i></a></li>
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
                        @if(Request::is('search'))
                                    @foreach($products as $product)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                        ?>
                                        <div class="col-md-3 col-sm-4 col-xs-12 padding-5px">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                            <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                                <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" />
                                                            </a>
                                                            <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                            <h4> Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                            {{--<a href="{{url('shop/product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>--}}
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
                        @else
                            @foreach($products as $product)
                                <?php
                                $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                ?>
                                <div class="product-listing list-type">
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12">
                                                <div class="shop-list-view">
                                                    <div class="product-item">
                                                        <div class="product-image">
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
                                                                <li><a href="{{url('product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-sm-12 no-padding">
                                                            <div class="shop-information-list-view"><!--/product-information-->
                                                                    <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                                        <h2>{{$ShopInfo->shop_name}}</h2>
                                                                    </a>
                                                                    <i class="fa fa-phone"></i> : {{$ShopInfo->phone}} | <i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}} <br>
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

                    </div><!--features_items-->
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
    </section>
@endsection