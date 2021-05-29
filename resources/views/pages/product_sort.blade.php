<?php
$base_url = 'http://ecammall.com/';
?>
<div class="display-grid">
    @if (\Request::is('products/*'))
        @foreach($UserProducts as $product)
            <?php
            $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
            $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
            ?>
            <div class="col-md-3 col-sm-4 col-xs-6 padding-5px">
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
    @if(!\Request::is('products/cities/*'))
        @if(!empty($newProducts))
            @foreach($newProducts as $product)
                <?php
                $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                ?>
                <div class="col-md-3 col-sm-4 col-xs-6 padding-5px">
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
        @if(Request::is('search'))
            @foreach($products as $product)
                <?php
                $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                ?>
                <div class="col-md-3 col-sm-4 col-xs-6 padding-5px">
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
                <div class="col-md-3 col-sm-4 col-xs-6 padding-5px">
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
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endif

</div>
</div>
<div class="display-list">
    @if (\Request::is('products/*'))
        @foreach($UserProducts as $product)
            <?php
            $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
            $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
            $ShopInfo = \App\PageShops:: where('user_id',$product->user_id)->first();
            $thumbnails = \App\Thumbnails::where('product_id',$product->id)->take(3)->get();
            ?>
            <div class="product-listing list-type">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="shop-list-view">
                            <div class="product-item">
                                <div class="product-image no-padding">
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
                                    <div class="col-sm-4 product-thumbnail-list no-padding">
                                        @foreach($thumbnails as $thumbnail)
                                            <img src="{{asset('images/thumbnails/medium/'.$thumbnail->image)}}" width="50px" height="auto">
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
                                    <div class="col-sm-8">
                                        <div class="shop-information-list-view pull-right"><!--/product-information-->
                                            <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                <h2><img src="{{asset('images/shop.png')}}"> {{$ShopInfo->shop_name}}</h2>
                                            </a>
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
                $ShopInfo = \App\PageShops:: where('user_id',1)->first();
                $thumbnails = \App\ProductThumnail::where('product_id',$product->id)->take(3)->get();
                ?>
                <div class="product-listing list-type">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <div class="shop-list-view">
                                <div class="product-item">
                                    <div class="row">
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
                                            <div class="product-thumbnail-list col-sm-4 no-padding">
                                                @foreach($thumbnails as $thumbnail)
                                                    <img alt="" src="{{$base_url}}stock/assets/uploads/{{$thumbnail->photo}}" width="50px" height="auto">
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
                                            <div class="col-sm-8">
                                                <div class="shop-information-list-view pull-right"><!--/product-information-->
                                                    <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                        <h2><img src="{{asset('images/shop.png')}}"> {{$ShopInfo->shop_name}}</h2>
                                                    </a>
                                                    {{--<i class="fa fa-phone"></i> : {{$ShopInfo->phone}} | <i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}} <br>--}}
                                                </div>
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