@extends('layouts.app')
@section('title','Discount Sell')
@section('content')
    <section id="advertisement">
        <div class="container no-padding">
                <?php
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>11,'page'=>3])->get();
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
            @if(count($discount50Up)>0)<h2 class="title text-center">Discount up to 90%</h2>@endif
            @foreach($discount50Up as $discount)
                    <?php
                    $firstImage = \App\Thumbnails::where('product_id',$discount->id)->first();
                    $imageName = isset($firstImage->image)?$firstImage->image:$discount->image;
                    ?>
                <div class="col-md-2 col-sm-4 col-xs-6 padding-5px">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{url('shop/product_detail/'.$discount->id)}}">
                                    <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" class="img-responsive"/>
                                </a>
                                <p class="text-height">{{substr($discount->name,0,20)}}</p>
                                <h4>
                                    <div class="col-xs-6 no-padding">
                                        <strike style="color: #000;font-weight: 300">$ {{sprintf('%0.2f', $discount->price)}}</strike>
                                    </div>
                                    <div class="col-xs-6">
                                        ${{number_format($discount->price *(1-($discount->discount_rate/100)),2)}}
                                    </div>
                                </h4>
                                {{--<h5><strike>$ {{sprintf('%0.2f', $discount->price) }}</strike> ( {{$discount->discount_rate}}% off )</h5>
                                <h2>$ {{number_format($discount->price *(1-($discount->discount_rate/100)),2)}}</h2>
                                <p>{{substr($discount->name,0,15)}}...</p>--}}
                            </div>
                            <div class="discount">
                                <img src="{{asset('images/home/discount.png')}}">
                                <p>{{$discount->discount_rate}}</p>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <?php
                                if(Auth::check()){
                                    $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$discount->id)->first();
                                }
                                ?>
                                <input type="hidden" name="product_from" value="0" class="product_from">
                                <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                <li>
                                    <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$discount->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                @if(Auth::check() and $wishList)
                                    <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                @else
                                    <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$discount->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                    </li>
                                @endif
                                <li>
                                    <a href="{{url('shop/product_detail/'.$discount->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="clearfix"></div>
            @if(count($discount50_40)>0)<h2 class="title text-center">Discount from 40% up to 50%</h2>@endif
            @foreach($discount50_40 as $discount)
                    <?php
                    $firstImage = \App\Thumbnails::where('product_id',$discount->id)->first();
                    $imageName = isset($firstImage->image)?$firstImage->image:$discount->image;
                    ?>
                <div class="col-md-2 col-sm-4 col-xs-6 padding-5px">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{url('shop/product_detail/'.$discount->id)}}">
                                    <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" class="img-responsive"/></a>
                                <p class="text-height">{{substr($discount->name,0,20)}}</p>
                                <h4>
                                    <div class="col-xs-6 no-padding">
                                        <strike style="color: #000;font-weight: 300">$ {{sprintf('%0.2f', $discount->price)}}</strike>
                                    </div>
                                    <div class="col-xs-6">
                                        ${{number_format($discount->price *(1-($discount->discount_rate/100)),2)}}
                                    </div>
                                </h4>
                            </div>
                            <div class="discount">
                                <img src="{{asset('images/home/discount.png')}}">
                                <p>{{$discount->discount_rate}}</p>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <?php
                                if(Auth::check()){
                                    $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$discount->id)->first();
                                }
                                ?>
                                <input type="hidden" name="product_from" value="0" class="product_from">
                                <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                <li>
                                    <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$discount->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                @if(Auth::check() and $wishList)
                                    <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                @else
                                    <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$discount->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                    </li>
                                @endif
                                <li>
                                    <a href="{{url('shop/product_detail/'.$discount->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
            @if(count($discount39_20)>0)<h2 class="title text-center">Discount from 20% up to 40%</h2>@endif
            @foreach($discount39_20 as $discount)
                    <?php
                    $firstImage = \App\Thumbnails::where('product_id',$discount->id)->first();
                    $imageName = isset($firstImage->image)?$firstImage->image:$discount->image;
                    ?>
                <div class="col-md-2 col-sm-4 col-xs-6 padding-5px">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{url('shop/product_detail/'.$discount->id)}}">
                                    <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" class="img-responsive"/></a>
                                <p class="text-height">{{substr($discount->name,0,20)}}</p>
                                <h4>
                                    <div class="col-xs-6 no-padding">
                                        <strike style="color: #000;font-weight: 300">$ {{sprintf('%0.2f', $discount->price)}}</strike>
                                    </div>
                                    <div class="col-xs-6">
                                        ${{number_format($discount->price *(1-($discount->discount_rate/100)),2)}}
                                    </div>
                                </h4>
                            </div>
                            <div class="discount">
                                <img src="{{asset('images/home/discount.png')}}">
                                <p>{{$discount->discount_rate}}</p>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <?php
                                if(Auth::check()){
                                    $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$discount->id)->first();
                                }
                                ?>
                                <input type="hidden" name="product_from" value="0" class="product_from">
                                <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                <li>
                                    <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$discount->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                @if(Auth::check() and $wishList)
                                    <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                @else
                                    <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$discount->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                    </li>
                                @endif
                                <li>
                                    <a href="{{url('shop/product_detail/'.$discount->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
            @if(count($discount19_1)>0)<h2 class="title text-center">Discount from 1% up to 20%</h2>@endif
            @foreach($discount19_1 as $discount)
                    <?php
                    $firstImage = \App\Thumbnails::where('product_id',$discount->id)->first();
                    $imageName = isset($firstImage->image)?$firstImage->image:$discount->image;
                    ?>
                <div class="col-md-2 col-sm-4 col-xs-6 padding-5px">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{url('shop/product_detail/'.$discount->id)}}">
                                    <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" class="img-responsive"/></a>
                                <p class="text-height">{{substr($discount->name,0,20)}}</p>
                                <h4>
                                    <div class="col-xs-6 no-padding">
                                        <strike style="color: #000;font-weight: 300">$ {{sprintf('%0.2f', $discount->price)}}</strike>
                                    </div>
                                    <div class="col-xs-6">
                                        ${{number_format($discount->price *(1-($discount->discount_rate/100)),2)}}
                                    </div>
                                </h4>
                            </div>
                            <div class="discount">
                                <img src="{{asset('images/home/discount.png')}}">
                                <p>{{$discount->discount_rate}}</p>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <?php
                                if(Auth::check()){
                                    $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$discount->id)->first();
                                }
                                ?>
                                <input type="hidden" name="product_from" value="0" class="product_from">
                                <input type="hidden" value="1" name="quantity_order" class="quantity_order"/>
                                <li>
                                    <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$discount->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                @if(Auth::check() and $wishList)
                                    <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                @else
                                    <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$discount->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                    </li>
                                @endif
                                <li>
                                    <a href="{{url('shop/product_detail/'.$discount->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection