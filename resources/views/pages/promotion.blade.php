@extends('layouts.app')
@section('title','Promotion')
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
            <h2 class="title text-center">Store for you</h2>
            @foreach($shops as $shop)
                <?php
                $promotion = \App\ShopProduct::where('status',0)->where('promotion','>',0)->where('user_id',$shop->user_id)->inRandomOrder()->take(4)->get();
                ?>
                @if(count($promotion)>0)
                    <div class="col-sm-12 text-center">
                        <div class="shop-promotion">
                            <div class="menu-tab-shop padding-bottom-15"><!--category-tab-->
                                <ul class="nav nav-tabs" style="margin-bottom: 0px;border-bottom: none">
                                    <?php
                                        $subcategory = \App\Category::join('shop_products','sma_categories.id','=','shop_products.sub_category_id')
                                        ->select('sma_categories.*')->select('sma_categories.*')
                                        ->where('shop_products.user_id',$shop->user_id)
                                        ->take(10)->groupBy('id')->get();
                                        $coupon = \App\Coupon::where('user_id',$shop->user_id)->first();
                                    ?>
                                    @foreach($subcategory as $sub)
                                        <li><a href="{{url('shop/'.$shop->user_id.'/products/category/'.$sub->id)}}">{{$sub->name}}</a> </li>
                                    @endforeach
                                </ul>
                            </div><!--/category-tab-->
                            <div class="col-sm-3 no-padding">
                                <a href="{{url('shop/'.$shop->shop_name)}}">
                                    <div class="no-padding">
                                        @if(empty($shop->shop_image_small))
                                            <img src="{{asset('images/user-shop/'.$shop->shop_image)}}" style="width: 340px;height: 200px" class="img-responsive">
                                        @else
                                            <img src="{{asset('images/user-shop/'.$shop->shop_image_small)}}" style="width: 340px;height: 200px" class="img-responsive">
                                        @endif
                                    </div>
                                    <div class="logo-box-seller-zone">
                                        <img class="img-seller-zone" src="{{asset('images/user-shop/'.$shop->shop_logo)}}">
                                    </div>
                                    <div class="title-seller-zone">
                                        <p>{{$shop->shop_name}}</p>
                                    </div>
                                </a>

                                @if($coupon)
                                    <div class="coupon-shop">
                                        Get US $ {{$coupon->type}}.00 coupon
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-9 no-padding">

                                @foreach($promotion as $discount)
                                    <?php
                                    $firstImage = \App\Thumbnails::where('product_id',$discount->id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$discount->image;
                                    ?>
                                    <div class="white-bg col-md-3 col-sm-3 col-xs-6 padding-5px">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <a href="{{url('shop/product_detail/'.$discount->id)}}">
                                                        <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" /></a>
                                                    <h2>$ {{number_format($discount->price *(1-($discount->discount_rate/100)),2)}}</h2>
                                                    <h5>{{$promotionStatus[$discount->promotion]}}</h5>
                                                    <p>{{substr($discount->name,0,40)}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach


        </div>
    </div>
@endsection