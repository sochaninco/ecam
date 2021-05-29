@extends('layouts.app')
@section('title','Store Zone')
@section('content')
    <section id="advertisement">
        <div class="container no-padding">
                <?php
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>11,'page'=>2])->get();
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
                                    <a href="{{url('products/'.$banner->category_id)}}" >
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
            <h2 class="title text-center">New Collection</h2>
            <div class="col-md-6 no-padding">
                <?php
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>9])->get();
                ?>
                <div id="brand-zone-item-carousel" data-interval="5000" data-type="multi" data-ride="carousel" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach($Product_banner as $key=>$banner)
                            <div class="item @if($key == 0)active @endif ">
                                @if(!empty($banner->url))
                                    <a href="https://{{$banner->url}}" @if($banner->open_new_tab ==1) target="_blank" @endif>
                                        <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                                    </a>
                                @else
                                    <a href="{{url('products/'.$banner->category_id)}}" >
                                        <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 no-padding">
                <div id="collection-item-carousel" data-interval="3500" data-type="multi" data-ride="carousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php
                            $Products = \App\Product::where('featured','!=',Null)->inRandomOrder()->take(12)->get();
                        ?>
                        @foreach($Products->chunk(3) as $count => $Product)
                            <div class="item {{ $count == 0 ? 'active' : '' }}">
                                @foreach($Product as $item)
                                    <div class="col-sm-4 col-xs-4 no-padding">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo-collection text-center">
                                                    <a href="{{url('product_detail/'.$item->id)}}">
                                                        <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$item->image}}" class="brand-product img-responsive">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            @foreach($listShop as $shop)
                    <?php
                    $products = \App\ShopProduct::where('user_id',$shop->user_id)->where('status',0)->take(3)->get();
                    $countProduct = \App\ShopProduct::where('user_id',$shop->user_id)->where('status',0)->count();
                    ?>
                    @if($countProduct > 3)
                        <div class="col-sm-3 no-padding text-center border hidden-xs">
                            <a href="{{url('shop/'.$shop->shop_name)}}">
                                <div class="no-padding">
                                @if(empty($shop->shop_image_small))
                                    <?php
                                        $themeShop = \App\ShopTheme::where('id',$shop->shop_theme)->first();
                                    ?>
                                    @if($themeShop)
                                    <img src="{{asset('images/theme-shop/'.$themeShop->theme_banner_small)}}" style="width: 340px;height: 200px" class="img-responsive">
                                    @endif
                                @else
                                    @if(empty($shop->shop_image_small))
                                        <img src="{{asset('images/user-shop/'.$shop->shop_image)}}" style="width: 340px;height: 200px" class="img-responsive">
                                    @else
                                        <img src="{{asset('images/user-shop/'.$shop->shop_image_small)}}" style="width: 340px;height: 200px" class="img-responsive">
                                    @endif
                                @endif
                                </div>
                                <div class="logo-box-seller-zone">
                                    <img class="img-seller-zone" src="{{asset('images/user-shop/'.$shop->shop_logo)}}">
                                </div>
                            </a>
                            <div class="clearfix padding-bottom"></div>
                            @foreach($products as $product)
                                <?php
                                $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                ?>
                                <div class="col-md-4 col-sm-4 col-xs-4 no-padding">
                                    <div class="text-center">
                                        <a href="{{url('shop/product_detail/'.$product->id)}}">
                                            <img src="{{asset('images/thumbnails/'.$imageName)}}" class="brand-product">
                                        </a>
                                        <p>$ {{sprintf('%0.2f', $product->price)}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-3 text-center visible-xs">
                            <a href="{{url('shop/'.$shop->shop_name)}}">
                                <div class="no-padding">
                                    @if(empty($shop->shop_image_small))
                                        <?php
                                        $themeShop = \App\ShopTheme::where('id',$shop->shop_theme)->first();
                                        ?>
                                        @if($themeShop)
                                            <img src="{{asset('images/theme-shop/'.$themeShop->theme_banner_small)}}" style="width: 384px;height: auto" class="img-responsive">
                                        @endif
                                    @else
                                        @if(empty($shop->shop_image_small))
                                            <img src="{{asset('images/user-shop/'.$shop->shop_image)}}" style="width: 384px;height: auto" class="img-responsive">
                                        @else
                                            <img src="{{asset('images/user-shop/'.$shop->shop_image_small)}}" style="width: 384px;height: auto" class="img-responsive">
                                        @endif
                                    @endif
                                </div>
                                <div class="logo-box-seller-zone">
                                    <img class="img-seller-zone" src="{{asset('images/user-shop/'.$shop->shop_logo)}}">
                                </div>
                            </a>
                            <div class="clearfix padding-bottom-5"></div>
                            @foreach($products as $product)
                                <?php
                                $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                ?>
                                <div class="col-md-4 col-sm-4 col-xs-4 no-padding">
                                    <div class="text-center">
                                        <a href="{{url('shop/product_detail/'.$product->id)}}">
                                            <img src="{{asset('images/thumbnails/'.$imageName)}}" class="brand-product">
                                        </a>
                                        <p>$ {{sprintf('%0.2f', $product->price)}}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="clearfix"></div>
                            <hr class="no-margin">
                        </div>
                    @endif
            @endforeach
        </div>
    </div>
@endsection