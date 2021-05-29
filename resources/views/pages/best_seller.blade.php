@extends('layouts.app')
@section('title','Best Seller')
@section('content')
    <section id="advertisement">
        <div class="container no-padding">
                <?php
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>11,'page'=>1])->get();
                ?>
                <div id="brand-zone-item-carousel" data-interval="300000" data-type="multi" data-ride="carousel" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach($Product_banner as $key=>$banner)
                            <div class="item @if($key == 0)active @endif ">
                                @if(!empty($banner->url))
                                    <a href="https://{{$banner->url}}" @if($banner->open_new_tab ==1) target="_blank" @endif>
                                        <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                                    </a>
                                @else
                                    <a href="{{url('product_detail/'.$banner->product_id)}}" >
                                        <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </section>
    <div class="container white-bg">
        <div class="row">
            <h2 class="title text-center">Best Sell</h2>
            @foreach($bestSeller as $best)
                @if($best->product_from == 0)
                    <?php
                     $shopProductBest = \App\ShopProduct::where('id',$best->product_id)->get();
                    ?>
                    @foreach($shopProductBest as $product)
                            <?php
                            $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                            $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                            ?>
                    <div class="col-md-2 col-sm-4 col-xs-6 padding-5px">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{url('shop/product_detail/'.$product->id)}}">
                                        <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" class="img-responsive"/></a>
                                    <p class="text-height">{{substr($product->name,0,30)}}</p>
                                    <h4>Price : $ {{sprintf('%0.2f', $product->price)}}</h4>
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
                                    <li>
                                        <a href="{{url('shop/product_detail/'.$product->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <?php
                     $productBest = \App\Product::where('id',$best->product_id)->get();
                    ?>
                    @foreach($productBest as $shopBest)
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{url('product_detail/'.$shopBest->id)}}"><img src="http://ecammall.com/stock/assets/uploads/{{$shopBest->image}}" alt="" /></a>
                                    <p class="text-height">{{substr($shopBest->name,0,40)}}</p>
                                    <h4>Price : $ {{sprintf('%0.2f', $shopBest->price)}}</h4>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <?php
                                    if(Auth::check()){
                                        $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$shopBest->id)->first();
                                    }
                                    ?>
                                    <input type="hidden" name="product_from" value="0" class="product_from">
                                    <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                    <li>
                                        <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$shopBest->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                    @if(Auth::check() and $wishList)
                                        <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                    @else
                                        <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$shopBest->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                        </li>
                                    @endif
                                    <li>
                                            <a href="{{url('product_detail/'.$shopBest->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            @endforeach

        </div>
    </div>
@endsection