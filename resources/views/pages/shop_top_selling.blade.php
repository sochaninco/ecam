@extends('layouts.app')
@section('title','Shop top selling')
@section('content')
    @if(Request::is('shop/*'))
        <div class="container shop-menu-bg shop-page">
            <div class="col-sm-3 margin-top-5px">
                <div class="btn-group dropdown">
                    <a href="{{url('shop/'.$ShopInfo->shop_name.'/shop_contact')}}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-animations="fadeInDown">
                        Shop : <?php echo isset($ShopInfo->shop_name)?$ShopInfo->shop_name:''; ?><span class="caret"></span>
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
                        <li><i class="fa fa-globe"></i> : {{$ShopInfo->website}}</li>
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
                </div><!--/category-tab-->
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
                                <li ><a href="{{url('shop/'.$ShopInfo->shop_name)}}" class="active">Store Home</a></li>
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
                <img alt="" src="{{asset('images/user-shop/'.$ShopImage)}}">
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
                <div class="col-sm-3 hidden-xs">
                    <div class="left-sidebar">
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
                                                @if(empty($Ad->url))
                                                    <a href="{{url($Ad->url)}}" target="_blank"> <img src="{{asset('images/home/'.$Ad->image)}}" class="img-responsive"></a>
                                                @else
                                                    <a href="{{url('product_detail/'.$Ad->product_id)}}"> <img src="{{asset('images/home/'.$Ad->image)}}" class="img-responsive"></a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div><!--/shipping-->
                        <br>
                        @foreach($RandomProducts as $random)
                            <?php
                            $firstImage = \App\Thumbnails::where('product_id',$random->id)->first();
                            $imageName = isset($firstImage->image)?$firstImage->image:$random->image;
                            ?>
                            <div class="col-sm-12 no-padding">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            {{--@if(\Request::is('shop/product_detail/*'))--}}
                                            <a href="{{url('shop/product_detail/'.$random->id)}}">
                                                <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" /></a>
                                            <p class="text-height">{{substr($random->name,0,40)}}</p>
                                            <h4>Price : $ {{sprintf('%0.2f', $random->price)}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--/category-products-->
                </div>


                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">
                            {{$subName}}
                        </h2>
                        @foreach($bestSeller as $best)
                            <?php
//                                $countOrder = \App\ProductOrderDetail::where('shop_id',$ShopInfo->user_id)
//                                    ->where('status',1)
//                                    ->where('product_id',$best->product_id)
//                                    ->count();
                            $shopProductBest = \App\ShopProduct::where('user_id',$ShopInfo->user_id)->where('id',$best->product_id)->paginate(12);
                            ?>
                            @foreach($shopProductBest as $product)
                                <?php
                                $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                ?>
                                <div class="col-md-3 col-sm-4 col-xs-6 padding-5px products">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                    <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" /></a>
                                                <p class="text-height">{{substr($product->name,0,40)}}</p>
                                                <h4>Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
                                                <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                    <p>Ordered : ({{$best->sumOrder}})</p>
                                                </a>
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
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div><!--features_items-->
                    <ul class="pagination">
                        @if(isset($shopProductBest))
                            {!! $shopProductBest->render() !!}
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection