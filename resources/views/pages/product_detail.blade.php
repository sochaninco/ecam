@extends('layouts.app')
<?php
$base_url = '/';
?>
<?php
$imageName = isset($firstImage->photo)?$firstImage->photo:$product->image;
if(\Request::is('shop/product_detail/*')){
    $imageLink = asset('images/thumbnails/large/'.$firstImage->image);
    $link = $base_url.'shop/product_detail/'.$product->id;
}else{
    $imageLink = $base_url.'stock/assets/uploads/'.$imageName;
    $link = $base_url.'product_detail/'.$product->id;
}

?>

@section('og')
    <meta property="og:url" content="{{$link}}">
    <meta property="og:title" content="{{ $product->name }}" />
    <meta property="og:description" content="{{$product->name}}" />
    <meta property="og:image" content="{{ $imageLink }}" />
    <meta property="og:type" content="website">


@endsection
@section('title',$product->name)
@section('content')
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
    <section>
        <div class="container white-bg">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <div class="hidden-xs">
                        @if(\Request::is('shop/product_detail/*'))
                                <div class="store-info">
                                    <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                        <h5>{{$ShopInfo->shop_name}}</h5>
                                    </a>
                                    <div class="store-info-content">
                                        <div class="top-seller-label">
                                            <a>
                                                <i class="fa fa-thumbs-up"></i>
                                                <span class="top-seller-text">Top Brands</span>
                                            </a>
                                        </div>
                                        <div class="store-info-data">
                                            <div>96.2%&nbsp;
                                                <span class="store-info-text">Positive Feedback</span>
                                            </div>
                                            <div class="follower-num">9999+&nbsp;
                                                <span class="store-info-text">Followers</span>
                                            </div>
                                        </div>
                                        <div class="store-info-contact">
                                            <div class="contact-block">
                                                <a>
                                                    <i class="fa fa-send"></i>
                                                    <span class="contact-text">Contact</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="store-info-btn">
                                                <div class="col-md-6 add-store-list follow-btn">
                                                    <i class="fa fa-plus"></i>
                                                    <span class="asl-btn"> Follow</span>
                                                </div>
                                                <div class="col-md-6 visit-store-btn">
                                                <span>
                                                    <a href="{{url('shop/'.$ShopInfo->shop_name)}}">Visit Store</a>
                                                </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="shipping list-item-pro-detail">
                                    @foreach($productByShop as $productLeft)
                                        <?php
                                        $firstImageLeft = \App\Thumbnails::where('product_id',$productLeft->id)->first();
                                        $imageNameLeft = isset($firstImage->image)?$firstImageLeft->image:$productLeft->image;
                                        ?>
                                        <div class="padding-top-10px">
                                            <div class="col-sm-4 padding-5px">
                                                <a href="{{url('shop/product_detail/'.$productLeft->id)}}">
                                                    <img alt="" src="{{asset('images/thumbnails/medium/'.$imageNameLeft)}}" class="img-responsive">

                                            </div>
                                            <div class="col-sm-8">
                                                <p>{{substr($productLeft->name,0,20)}}</p></a>
                                                <p> Price : $ {{sprintf('%0.2f', $productLeft->price)}}</p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endforeach
                                </div>
                        @else

                                <div class="store-info">
                                    <a href="{{url('/products')}}">
                                        <h5>{{$ShopInfo->shop_name}}</h5>
                                    </a>
                                    <div class="store-info-content">
                                        <div class="top-seller-label">
                                            <a>
                                                <i class="fa fa-thumbs-up"></i>
                                                <span class="top-seller-text">Top Brands</span>
                                            </a>
                                        </div>
                                        <div class="store-info-data">
                                            <div>96.2%&nbsp;
                                                <span class="store-info-text">Positive Feedback</span>
                                            </div>
                                            <div class="follower-num">9999+&nbsp;
                                                <span class="store-info-text">Followers</span>
                                            </div>
                                        </div>
                                        <div class="store-info-contact">
                                            <div class="contact-block">
                                                <a>
                                                    <i class="fa fa-send"></i>
                                                    <span class="contact-text">Contact</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="store-info-btn">
                                                <div class="col-md-6 add-store-list follow-btn">
                                                    <i class="fa fa-plus"></i>
                                                    <span class="asl-btn"> Follow</span>
                                                </div>
                                                <div class="col-md-6 visit-store-btn">
                                                <span>
                                                    <a href="{{url('/products')}}">Visit Store</a>
                                                </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="shipping list-item-pro-detail">
                                    @foreach($productByShop as $item)
                                        <div class="padding-top-10px">
                                            <div class="col-sm-4 padding-5px">
                                                <a href="{{url('product_detail/'.$item->id)}}">
                                                    <img alt="" src="{{$base_url}}stock/assets/uploads/{{$item->image}}" class="img-responsive">
                                            </div>
                                            <div class="col-sm-8">
                                                <p>{{substr($item->name,0,20)}}</p></a>
                                                <p> Price : $ {{sprintf('%0.2f', $item->price)}}</p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endforeach
                                </div>
                        @endif
                        <div class="clearfix"></div>
                        <h2>Shop Popular Items</h2>
                            <div id="popular-item-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                                <div class="carousel-inner">
                                    @foreach($popular_items as $key=>$popular)
                                        <div class="item @if($key == 0) active @endif">
                                            <div class="col-sm-12 no-padding">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo-left text-center">
                                                            {{--@if(\Request::is('shop/product_detail/*'))
                                                                <a href="{{url('shop/product_detail/'.$tag->id)}}">
                                                                    <img alt="" src="{{asset('images/user-shop/product/'.$tag->image)}}"></a>
                                                                <h2>$ {{sprintf('%0.2f', $tag->price)}}</h2>
                                                                <p>{{substr($tag->name,0,10)}} ...</p>
                                                                <a href="{{url('shop/product_detail/'.$tag->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>
                                                            @else--}}
                                                            <a href="{{url('product_detail/'.$popular->id)}}"><img alt="" src="{{$base_url}}stock/assets/uploads/{{$popular->image}}"></a>
                                                            <p class="text-height">{{substr($popular->name,0,40)}}</p>
                                                            <h4> Price : $ {{sprintf('%0.2f', $popular->price)}}</h4>
                                                            {{--@endif--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        <h2>Premium Item</h2>
                        <div id="premium-item-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                            <div class="carousel-inner">
                                @foreach($premium_items as $key=>$premium)
                                    <?php
                                        $imagePremium = \App\Thumbnails::where('product_id',$premium->id)->first();
                                    ?>
                                    <div class="item @if($key == 0) active @endif">
                                        <div class="col-sm-12 no-padding">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo-left text-center">
                                                        {{--@if(\Request::is('shop/product_detail/*'))--}}
                                                        <a href="{{url('shop/product_detail/'.$premium->id)}}">
                                                            <img alt="" src="{{asset('images/thumbnails/large/'.$imagePremium->image)}}"></a>
                                                        <p class="text-height">{{substr($premium->name,0,40)}}</p>
                                                        <h4>Price : $ {{sprintf('%0.2f', $premium->price)}}</h4>
                                                        {{--<a href="{{url('shop/product_detail/'.$tag->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>--}}
                                                        {{--<a href="{{url('product_detail/'.$popular->id)}}"><img alt="" src="http://heangsochan.com/stock/assets/uploads/{{$popular->image}}"></a>--}}
                                                        {{--<h2>$ {{sprintf('%0.2f', $popular->price)}}</h2>--}}
                                                        {{--<p>{{substr($popular->name,0,20)}} ...</p>--}}
                                                        {{--@endif--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--/category-products-->
                        <div class="shipping list-item-pro-detail">
                            @foreach($popular_items as $item)
                                <div class="padding-top-10px">
                                    <div class="col-sm-4 padding-5px">
                                        <a href="{{url('product_detail/'.$popular->id)}}"><img alt="" src="{{$base_url}}stock/assets/uploads/{{$item->image}}" class="img-responsive"></a>
                                    </div>
                                    <div class="col-sm-8">
                                        <p>{{substr($item->name,0,20)}}</p>
                                        <p> Price : $ {{sprintf('%0.2f', $item->price)}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            @endforeach
                        </div>
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
                        </div>
                    </div>
                </div>
                <?php $imageName = isset($firstImage->photo)?$firstImage->photo:$product->image;?>

                <div class="col-sm-9 no-padding">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5 no-padding col-xs-12">
                            <div class="hidden-xs">
                                <div class="view-product big">
                                    @if(\Request::is('shop/product_detail/*'))
                                        <a class="zoom" href="{{asset('images/thumbnails/'.$firstImage->image)}}">
                                            <img class="bigimg" id="big_image" alt="" src="{{asset('images/thumbnails/large/'.$firstImage->image)}}">
                                    @else
                                        <?php $imageName = isset($firstImage->photo)?$firstImage->photo:$product->image; ?>
                                        <a class="zoom" href="{{$base_url}}stock/assets/uploads/{{$imageName}}">
                                        <img class="bigimg" id="big_image" alt="" src="{{$base_url}}stock/assets/uploads/{{$imageName}}">
                                    @endif
                                    </a>
                                </div>
                                <div class="view-video">
                                    <embed class="video" src="" wmode="transparent" type="application/x-shockwave-flash"
                                           width="350" height="350" allowfullscreen="true" title="Adobe Flash Player"></embed>
                                </div>
                                <div data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide" id="similar-product">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <?php
                                                $i = 1;
                                            ?>
                                                @foreach($thumbnails as $count=>$thumb)
                                                @if($i%4 == 0)
                                                    </div><div class="item">
                                                @endif
                                                @if($count == 0 and  !empty($product->video_url))
                                                    <div class="col-md-3 col-sm-3 col-xs-3 no-padding">
                                                        <a class="play-video">
                                                            <img src="{{asset('images/img-play.jpg')}}" width="88px" height="auto">
                                                        </a>
                                                    </div>
                                                @endif
                                                    <div class="col-md-3 col-sm-3 col-xs-3 no-padding">
                                                        @if(\Request::is('shop/product_detail/*'))
                                                            <a href="{{asset('images/thumbnails/'.$thumb->image)}}" onclick="swap(this); return false;" class="change-image">
                                                                <img alt="" src="{{asset('images/thumbnails/shop/'.$thumb->image)}}" width="88" height="auto">
                                                            </a>
                                                        @else
                                                            <a href="{{$base_url}}stock/assets/uploads/{{$thumb->photo}}" onclick="swap(this); return false;" class="change-image">
                                                                <img alt="" src="{{$base_url}}stock/assets/uploads/thumbs/{{$thumb->photo}}" width="88" height="auto">
                                                            </a>
                                                        @endif
                                                    </div>

                                        <?Php $i++; ?>
                                        @endforeach
                                        </div>

                                    </div>

                                    <!-- Controls -->
                                    <a data-slide="prev" href="#similar-product" class="left item-control">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a data-slide="next" href="#similar-product" class="right item-control">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>

                            </div>
                            <div class="hidden-sm hidden-lg hidden-md visible-xs">
                                <div data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide product-detail-phone" id="product-detail-phone">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        @if(\Request::is('shop/product_detail/*'))
                                            @foreach($thumbnails as $count=>$thumb)
                                                <div class="item @if($count ==0) active @endif">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                                                        <a href="{{asset('images/thumbnails/'.$thumb->image)}}">
                                                            <img alt="" src="{{asset('images/thumbnails/'.$thumb->image)}}" class="img-responsive">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @if(isset($firstImage->photo))
                                            @foreach($thumbnails as $count=>$thumb)
                                            <div class="item @if($count ==0) active @endif">
                                                <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <?php $imageName = isset($firstImage->photo)?$firstImage->photo:$product->image; ?>
                                                    <a href="{{$base_url}}stock/assets/uploads/{{$imageName}}">
                                                        <img alt="" src="{{$base_url}}stock/assets/uploads/{{$imageName}}" class="img-responsive">
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                                <div class="col-xs-12 bo-padding">
                                                    <?php $imageName = isset($firstImage->photo)?$firstImage->photo:$product->image; ?>
                                                    <a href="{{$base_url}}stock/assets/uploads/{{$imageName}}">
                                                        <img alt="" src="{{$base_url}}stock/assets/uploads/{{$imageName}}" class="img-responsive">
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="display-amount-thum">
                                        <span class="badge">
                                           @if(\Request::is('shop/product_detail/*'))
                                                <div class="col-xs-6 no-padding">
                                                  <div class="carousel slide" data-interval="3000" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach($thumbnails as $count=>$thumb)
                                                            <div class="item @if($count == 0) active @endif">
                                                                {{$count+1}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                  </div>
                                               </div>
                                                <div class="col-xs-6 no-padding">
                                                  /{{$countThumbnails}} &nbsp;
                                               </div>
                                           @else
                                               @if(isset($firstImage->photo))
                                               <div class="col-xs-6 no-padding">
                                                  <div class="carousel slide" data-interval="3000" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach($thumbnails as $count=>$thumb)
                                                            <div class="item @if($count == 0) active @endif">
                                                                {{$count+1}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                  </div>
                                               </div>
                                               <div class="col-xs-6 no-padding">
                                                  / {{$countThumbnails}} &nbsp;
                                               </div>
                                               @else
                                                   1/1
                                               @endif
                                           @endif
                                        </span>
                                    </div>
                                    <!-- Controls -->
                                    <a data-slide="prev" href="#product-detail-phone" class="left item-control">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a data-slide="next" href="#product-detail-phone" class="right item-control">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                                <div class="product-detail-video-phone">
                                    @if(!empty($product->video_url))
                                        <iframe width="100%" height="350" class="video-mobile"
                                                src="">
                                        </iframe>
                                    @elseif(!empty($product->video_upload))
                                        <video class="video-mobile" width="100%" height="350" src="{{asset('images/user-shop/video/'.$product->video_upload)}}" type="video/mp4s" controls/>
                                    @endif
                                </div>
                                @if(!empty($product->video_url) || !empty($product->video_upload))
                                    <div class="padding-5px">
                                        <a class="view-image-mobile btn btn-info">Image</a> | <a class="view-video-mobile btn btn-warning">Video</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-7 no-padding col-xs-12">
                            <div class="col-sm-12 no-padding">
                                <div class="product-information"><!--/product-information-->
                                    @if($product->quantity > 0)
                                        <img alt="" class="newarrival" src="{{asset('images/product-details/new.jpg')}}">
                                    @else
                                        <img alt="" class="newarrival" src="{{asset('images/product-details/pre-order.jpg')}}">
                                    @endif
                                    @if(\Request::is('shop/product_detail/*'))
                                        @if(!empty($product->sku))<h6 class="sku">SKU : {{$product->sku}}</h6>@endif
                                    @else
                                        <h6 class="sku">SKU : {{'E'.$product->id}}</h6>
                                    @endif
                                    <div class="hidden-xs">
                                        <h2>{{$product->name}}</h2>
                                        <!-- <p>Web ID: 1089772</p> -->
                                        <!-- <img src="images/product-details/rating.png" alt="" /> -->
                                        <?php
                                            $productPrice;
                                        ?>
                                        @if(\Request::is('shop/product_detail/*'))
                                           @if(!empty($product->admin_promotion))
                                               <?php
                                                    $adminPromotion = \App\AdminPromotion::where('id',$product->admin_promotion)->first();
                                                    if($adminPromotion->value_type == 0){
                                                        $type = '%';
                                                    }
                                                    else{
                                                        $type = '$';
                                                    }
                                               ?>
                                                <span>
                                                    <p>US <strike>${{sprintf('%0.2f', $product->price)}}</strike></p>
                                                    <img src="{{asset('images/'.$adminPromotion->image_detail)}}">
                                                    <p> Discount : {{$adminPromotion->name}} ({{$adminPromotion->value }} {{$type}})</p>
                                                    <p>
                                                        <b>Price after Discount : </b>
                                                    </p>
                                                    @if($adminPromotion->value_type == 0)
                                                    <span>
                                                        <?Php
                                                            $productPrice = number_format($product->price*(1-($adminPromotion->value/100)),2);
                                                        ?>
                                                        US $ {{$productPrice}}
                                                    </span>
                                                    @else
                                                        <?php
                                                            $productPrice = number_format($product->price - $adminPromotion->value,2)
                                                        ?>
                                                        US $ {{$productPrice}}
                                                    @endif
                                                </span>
                                           @elseif($product->discount_rate > 0)
                                                <span>
                                                    <p>US <strike>${{sprintf('%0.2f', $product->price)}}</strike></p>
                                                    <p> Discount : {{$product->discount_rate}}%</p>
                                                    <p><b>Price after Discount : </b></p>
                                                    <span>US $ {{number_format($product->price*(1-($product->discount_rate/100)),2)}}</span>
                                                </span>
                                           @else
                                                <span>
                                                    <span>US ${{sprintf('%0.2f', $product->price)}}</span>
                                                </span>
                                           @endif
                                        @elseif(\Request::is('product_detail/*'))
                                            @if($product->discount_rate > 0)
                                                <span>
                                            <p>US <strike>${{sprintf('%0.2f', $product->price)}}</strike></p>
                                            <p> Discount : {{$product->discount_rate}}%</p>
                                            <p><b>Price after Discount : </b></p>
                                                <span>US $ {{number_format($product->price*(1-($product->discount_rate/100)),2)}}</span>
                                                </span>
                                            @else
                                                <span>
                                            <span>US ${{sprintf('%0.2f', $product->price)}}</span>
                                        </span>
                                            @endif
                                        @endif

                                        <p><b>Availability:</b> @if($product->quantity > 0)In Stock @else Out of Stock @endif</p>
                                        <p><b>Condition:</b> New</p>
                                        <p><b>Category:</b> {{$product->c_name}}</p>
                                        @if(\Request::is('shop/product_detail/*'))
                                            @if($checkMember->shop_info == 1)
                                            <p><b>Tel:</b> {{$ShopInfo->phone}}</p>
                                            @else
                                                <p><b>Tel:</b> 015 77 55 53</p>
                                            @endif
                                        @else
                                            <p><b>Tel:</b> 015 77 55 53</p>
                                        @endif
                                    </div>
                                    <div class="visible-xs">
                                        <div class="row col-xs-12">
                                            <div class="col-xs-12 no-padding">
                                                <h2>{{$product->name}}</h2>
                                            </div>
                                            <?php
                                            $productPrice;
                                            ?>
                                            @if(\Request::is('shop/product_detail/*'))
                                                @if(!empty($product->admin_promotion))
                                                    <?php
                                                    $adminPromotion = \App\AdminPromotion::where('id',$product->admin_promotion)->first();
                                                    if($adminPromotion->value_type == 0){
                                                        $type = '%';
                                                    }
                                                    else{
                                                        $type = '$';
                                                    }
                                                    ?>
                                                    <span>
                                                    <p>US <strike>${{sprintf('%0.2f', $product->price)}}</strike></p>
                                                    <img src="{{asset('images/'.$adminPromotion->image_detail)}}">
                                                    <p> Discount : {{$adminPromotion->name}} ({{$adminPromotion->value }} {{$type}})</p>
                                                    <p>
                                                        <b>Price after Discount : </b>
                                                    </p>
                                                            @if($adminPromotion->value_type == 0)
                                                                <span>
                                                        <?Php
                                                                    $productPrice = number_format($product->price*(1-($adminPromotion->value/100)),2);
                                                                    ?>
                                                                    US $ {{$productPrice}}
                                                    </span>
                                                            @else
                                                                <?php
                                                                $productPrice = number_format($product->price - $adminPromotion->value,2)
                                                                ?>
                                                                US $ {{$productPrice}}
                                                            @endif
                                                </span>
                                                @elseif($product->discount_rate > 0)
                                                    <div class="col-xs-6">
                                                    <span>
                                                        <p>US <strike>${{sprintf('%0.2f', $product->price)}}</strike></p>
                                                        <p> Discount : {{$product->discount_rate}}%</p>
                                                        <p><b>Price after Discount : </b></p><span>US $ {{number_format($product->price*(1-($product->discount_rate/100)),2)}}</span>
                                                    </span>
                                                    </div>
                                                @else
                                                    <div class="col-xs-12">
                                                    <span>
                                                        <span>US ${{sprintf('%0.2f', $product->price)}}</span>
                                                    </span>
                                                    </div>
                                                @endif
                                            @elseif(\Request::is('product_detail/*'))
                                                @if($product->discount_rate > 0)
                                                    <span>
                                            <p>US <strike>${{sprintf('%0.2f', $product->price)}}</strike></p>
                                            <p> Discount : {{$product->discount_rate}}%</p>
                                            <p><b>Price after Discount : </b></p>
                                                <span>US $ {{number_format($product->price*(1-($product->discount_rate/100)),2)}}</span>
                                                </span>
                                                @else
                                                    <span>
                                            <span>US ${{sprintf('%0.2f', $product->price)}}</span>
                                        </span>
                                                @endif
                                            @endif
                                            <div class="col-xs-6">
                                                <p><b>Availability:</b> @if($product->quantity > 0)In Stock @else Out of Stock @endif</p>
                                            </div>
                                            <div class="col-xs-6">
                                                <p><b>Condition:</b> New</p>
                                            </div>
                                            <div class="col-xs-6">
                                                <p><b>Category:</b> {{$product->c_name}}</p>
                                            </div>
                                            <div class="col-xs-6">
                                                @if(\Request::is('shop/product_detail/*'))
                                                    @if($checkMember->shop_info == 1)
                                                    <p><b>Tel:</b> {{$ShopInfo->phone}}</p>
                                                    @else
                                                        <p><b>Tel:</b> 015 77 55 53</p>
                                                    @endif
                                                @else
                                                    <p><b>Tel:</b> 015 77 55 53</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if(\Request::is('shop/product_detail/*'))
                                    {!! Form::open(['url'=>'shop/products/buy_now','method'=>'get','id'=>'buy_now']) !!}
                                    <span>
                                        <label>Quantity:</label>
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <input type="hidden" name="product_from" value="0" class="product_from">
                                        <input type="hidden" name="quantity_in_stock" value="{{$product->quantity}}" class="quantity_in_stock">
                                        <input type="text" value="1" name="quantity_order" class="quantity_order"/>
                                    </span>
                                        <div class="col-sm-12 no-padding">
                                            @if(Auth::check())
                                                <button type="submit" class="btn buy-now" @if($product->quantity == 0 || $product->user_id == Auth::user()->id) disabled @endif>Buy Now</button>
                                            {{--<a href="{{url('shop/products/'.$product->id.'/buy_now')}}" class="btn buy-now">Buy Now</a>--}}
                                                <a class="btn cart btn-addToCart" @if($product->quantity == 0 || $product->user_id == Auth::user()->id) disabled @endif id="{{$product->id}}">
                                                    Add cart
                                                </a>
                                                <nav class="navbar navbar-default navbar-fixed-bottom visible-xs">
                                                    <div class="container no-padding">
                                                        <div align="center">
                                                            <div class="navbar-header">
                                                                <a class="navbar-brand-detail white-bg" href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                                    <img src="{{asset('images/shop.png')}}">
                                                                    <p>Store</p>
                                                                </a>

{{--                                                                <a class="navbar-brand-detail btn-addToCart orange-bg" @if($product->quantity == 0 || $product->user_id == Auth::user()->id) disabled @endif id="{{$product->id}}"><i class="fa fa-shopping-cart"></i> <p>Add to Cart</p></a>--}}
                                                                <a class="navbar-brand-detail btn-addToCart orange-bg" href="{{url('shopping-cart')}}">
                                                                    <p style="color: #fff">Add to Cart &nbsp;&nbsp;
                                                                    <p class="badge label-danger" style="color: #fff">{{Session::has('cart') ? Session::get('cart')->totalQty : '0'}}</p>
                                                                    </p>
                                                                </a>
                                                                <a onclick="document.getElementById('buy_now').submit();" class="navbar-brand-detail" @if($product->quantity == 0 || $product->user_id == Auth::user()->id) disabled @endif> <p style="color: #fff">Buy Now</p></a>
{{--                                                                <a class="navbar-brand-detail" href="{{url('shopping-cart')}}"><i class="fa fa-money"></i> </a>--}}
                                                            </div>
                                                        </div>
                                                    </div><!-- /.container-->
                                                </nav>
                                            @else
                                                <button type="submit" class="btn buy-now" @if($product->quantity == 0) disabled @endif>Buy Now</button>
                                                {{--<a href="{{url('shop/products/'.$product->id.'/buy_now')}}" class="btn buy-now">Buy Now</a>--}}
                                                <a class="btn cart btn-addToCart" @if($product->quantity == 0) disabled @endif id="{{$product->id}}">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Add to cart
                                                </a>
                                                <nav class="navbar navbar-default navbar-fixed-bottom visible-xs">
                                                    <div class="container no-padding">
                                                        <div align="center">
                                                            <div class="navbar-header">
                                                                <a class="navbar-brand-detail white-bg" href="{{url('shop/'.$ShopInfo->shop_name)}}"><img src="{{asset('images/shop.png')}}"> <p>Store</p> </a>
                                                                <a class="navbar-brand-detail btn-addToCart orange-bg" @if($product->quantity == 0) disabled @endif id="{{$product->id}}"> <p style="color: #fff">Add Cart</p></a>
                                                                <a onclick="document.getElementById('buy_now').submit();" class="navbar-brand-detail" @if($product->quantity == 0) disabled @endif><p style="color: #fff">Buy Now</p></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.container-->
                                                </nav>
                                            @endif
                                                <a href="tel:+855{{$ShopInfo->phone}}" class="btn quick-order"> Quick Order </a>
                                                <a href="tel:+855{{$ShopInfo->phone}}" class="btn call-order"> <i class="fa fa-phone"></i> Call Order </a>

                                        </div>
                                    {!! Form::close() !!}
                                    @else
                                    {!! Form::open(['url'=>'admin/products/buy_now','method'=>'get']) !!}
                                    <span>
                                        <label>Quantity:</label>
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <input type="hidden" name="product_from" value="1" class="product_from">
                                        <input type="hidden" name="quantity_in_stock" value="{{$product->quantity}}" class="quantity_in_stock">
                                        <input type="text" value="1" name="quantity_order" class="quantity_order"/>
                                    </span>
                                        <div class="col-sm-12 no-padding">
                                                <button type="submit" class="btn buy-now" @if($product->quantity == 0) disabled @endif>Buy Now</button>
                                            {{--<a href="{{url('products/'.$product->id.'/buy_now')}}" class="btn buy-now">--}}
                                                {{--Buy Now--}}
                                            {{--</a>--}}
                                                <a class="btn cart btn-addToCart" @if($product->quantity == 0) disabled @endif id="{{$product->id}}">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Add to cart
                                                </a>
                                                <a href="tel:+85515775553" class="btn call-order"> <i class="fa fa-phone"></i> Call to order </a>
                                                <nav class="navbar navbar-default navbar-fixed-bottom visible-xs">
                                                <div class="container no-padding">
                                                    <div align="center">
                                                        <div class="navbar-header">
                                                            <a class="navbar-brand-detail white-bg" href="{{url('shop/'.$ShopInfo->shop_name)}}"><img src="{{asset('images/shop.png')}}"> <p>Store</p> </a>
                                                            <a class="navbar-brand-detail btn-addToCart orange-bg" @if($product->quantity == 0) disabled @endif id="{{$product->id}}"> <p>Add to Cart</p></a>
                                                            <button type="submit" class="btn-buyNow-mobile padding" @if($product->quantity == 0) disabled @endif> <p>Buy Now</p></button>
                                                        </div>
                                                    </div>
                                                </div><!-- /.container-->
                                            </nav>
                                        </div>
                                    {!! Form::close() !!}
                                    @endif
                                    <div class="col-sm-12 no-padding">
                                        <div class="col-md-3 col-sm-5 col-xs-4 no-padding">
                                            <?php
                                            if(Auth::check()){
                                                $wishList = \App\WishList::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
                                            }
                                            ?>
                                            @if(Auth::check() and $wishList)
                                                <div class="ecam_wish_list btn">
                                                    Add to Wish List
                                                </div>
                                            @else
                                                <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList btn" id="{{$product->id}}" @endif style="cursor: pointer">
                                                    <div class="ecam_wish_list">
                                                        Add to Wish List
                                                    </div>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 no-padding margin-top">
                                            @if(\Request::is('shop/product_detail/*'))
                                                <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else href="{{url('message/from_user/'.Auth::user()->id.'/shop_id/'.$ShopInfo->user_id.'/product_from/0/product_id/'.$product->id)}} @endif" class="btn btn-info"><i class="fa fa-inbox"></i> Send Message </a>
                                            @else
                                                <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else href="{{url('message/from_user/'.Auth::user()->id.'/shop_id/1/product_from/1/product_id/'.$product->id)}} @endif" class="btn btn-info"><i class="fa fa-inbox"></i> Send Message </a>
                                            @endif
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 margin-top">
                                            {!! Form::open(['url'=>'chat-to-shop','method'=>'post']) !!}
                                            <input type="hidden" name="shop" value="{{$ShopInfo->user_id}}">
                                            <input type="submit" class=" btn btn-info" value="Chat">
                                            {!! Form::close() !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6 ">
                                        <div class="social-shared">
                                            <ul class="list-inline">
                                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" class="facebook-shared"><i class="fa fa-facebook-square"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                                                <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div><!--/product-information-->
                            </div>
                            @if(\Request::is('shop/product_detail/*'))
                                <div class="col-sm-12 col-xs-12 no-padding">
                                    <div class="shop-information"><!--/product-information-->
                                        <div class="col-sm-3 col-xs-3">
                                            <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                <img src="{{asset('images/user-shop/'.$ShopInfo->shop_logo)}}" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="col-sm-9 col-xs-9 no-padding">
                                            <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                                <h2>{{$ShopInfo->shop_name}}</h2>
                                            </a>
                                            @if($checkMember->shop_info == 1)
                                            <i class="fa fa-phone"></i> : {{$ShopInfo->phone}} | <i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}} <br>
                                            <i class="fa fa-home"></i> : {{$ShopInfo->address}} <br>
                                            @endif
                                            <i class="fa fa-globe"></i> : <a href="{{url('shop/'.$ShopInfo->shop_name)}}" target="_blank"> {{$ShopInfo->website}} </a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-12 no-padding">
                                    <div class="shop-information"><!--/product-information-->
                                        <div class="col-sm-3 col-xs-3">
                                            <a href="{{url('/products')}}">
                                                <img src="{{asset('images/user-shop/'.$ShopInfo->shop_logo)}}" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="col-sm-9 col-xs-9 no-padding">
                                            <a href="{{url('/products')}}">
                                                <h2>{{$ShopInfo->shop_name}}</h2>
                                            </a>
                                            <i class="fa fa-phone"></i> : {{$ShopInfo->phone}} | <i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}} <br>
                                            <i class="fa fa-home"></i> : {{$ShopInfo->address}}<br>
                                            <i class="fa fa-globe"></i> : {{$ShopInfo->website}}

                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div><!--/product-details-->
                    <!--/category-tab-->
                    <div class="shop-details-tab">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#details">Details</a></li>
                            <li><a data-toggle="tab" href="#feedback">Feedback</a></li>
                            <li><a data-toggle="tab" href="#shipping">Shipping</a></li>
                            <li><a data-toggle="tab" href="#guarantee">Guarantee</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="details" class="tab-pane fade in active padding-top-10px">
                                <div class="col-sm-12">
                                    @if(\Request::is('shop/product_detail/*'))
                                        {!!  $product->detail !!}
                                        <br>
                                        @if(!empty($product->feature_image_detail))
                                            <img src="{{asset('images/user-shop/product/'.$product->feature_image_detail)}}" class="img-responsive">
                                        @endif
                                        @if(!empty($product->feature_image_detail_1))
                                            <img src="{{asset('images/user-shop/product/'.$product->feature_image_detail_1)}}" class="img-responsive">
                                        @endif
                                        @if(!empty($product->feature_image_detail_2))
                                            <img src="{{asset('images/user-shop/product/'.$product->feature_image_detail_2)}}" class="img-responsive">
                                        @endif
                                        @if(!empty($product->feature_image_detail_3))
                                            <img src="{{asset('images/user-shop/product/'.$product->feature_image_detail_3)}}" class="img-responsive">
                                        @endif
                                        @if(!empty($product->feature_image_detail_4))
                                            <img src="{{asset('images/user-shop/product/'.$product->feature_image_detail_4)}}" class="img-responsive">
                                        @endif
                                        <br>
                                        {{--@if(!empty($product->video_upload))
                                            <div class="col-sm-8">
                                                <video width="520" height="440" src="{{asset('images/user-shop/video/'.$product->video_upload)}}" type="video/mp4s" controls/>
                                            </div>
                                        @endif--}}
                                        <br>

                                    @else
                                        <p>{!!  $product->product_details  !!}</p>
                                    @endif
                                </div>
                            </div>
                            <div id="feedback" class="tab-pane fade padding-top-10px">
                                <div class="col-sm-12">
                                    <form method="post" name="contact-form" class="contact-form row" id="main-contact-form">
                                        <div class="form-group col-md-6">
                                            <input type="text" placeholder="Name" required="required" class="form-control" name="name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" placeholder="Email" required="required" class="form-control" name="email">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="text" placeholder="Subject" required="required" class="form-control" name="subject">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea placeholder="Your Message Here" rows="8" class="form-control" required="required" id="message" name="message"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="submit" value="Submit" class="btn btn-primary pull-right" name="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="shipping" class="tab-pane fade padding-top-10px">
                                <?php
                                $shipping = \App\FooterPage::where('name','Making Payments')->first();
                                ?>
                                {!! $shipping->description !!}
                            </div>
                            <div id="guarantee" class="tab-pane fade padding-top-10px">
                                <?php
                                $seller = \App\FooterPage::where('name','Refund Policy')->first();
                                ?>
                                {!! $seller->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hidden-xs">
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>

                        <div data-ride="carousel" class="carousel slide" data-type="multi" data-interval="3000" id="recommended-item-carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <?php $i = 1;?>
                                @foreach($recomment_items as $key=>$item)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$item->id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$item->image;
                                        ?>
                                    @if($i%4 == 0)
                                        </div><div class="item">
                                    @endif
                                    <div class="col-md-3 col-sm-6 col-xs-12 padding-5px">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    @if(\Request::is('shop/product_detail/*'))
                                                        <a href="{{url('shop/product_detail/'.$item->id)}}">
                                                            <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" />
                                                        </a>
                                                        <p class="text-height">{{substr($item->name,0,40)}}</p>
                                                        <h4> Price : $ {{sprintf('%0.2f', $item->price)}}</h4>
                                                    @else
                                                        <a href="{{url('product_detail/'.$item->id)}}"><img alt="" src="{{$base_url}}stock/assets/uploads/{{$item->image}}"></a>
                                                        <p class="text-height">{{substr($item->name,0,40)}}</p>
                                                        <h4> Price : $ {{sprintf('%0.2f', $item->price)}}</h4>
                                                    @endif
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
                                                    <li>
                                                        @if(\Request::is('shop/product_detail/*'))
                                                            <a href="{{url('shop/product_detail/'.$item->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
                                                        @else
                                                            <a href="{{url('product_detail/'.$item->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?Php $i++; ?>
                                @endforeach
                                </div>
                            </div>
                            <a data-slide="prev" href="#recommended-item-carousel" class="left recommended-item-control">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a data-slide="next" href="#recommended-item-carousel" class="right recommended-item-control">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                        </div><!--/recommended_items-->
                    </div>
                    <div class="related">
                        <h2 class="title text-center">Related Product</h2>
                        @foreach($related as $tag)
                            <?php
                            $firstImage = \App\Thumbnails::where('product_id',$tag->id)->first();
                            $imageName = isset($firstImage->image)?$firstImage->image:$tag->image;
                            ?>
                            <div class="col-sm-3 col-xs-6 padding-5px">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            @if(\Request::is('shop/product_detail/*'))
                                                <a href="{{url('shop/product_detail/'.$tag->id)}}">
                                                    <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" class="img-responsive"/></a>
                                                <p class="text-height">{{substr($tag->name,0,30)}}</p>
                                                <h4> Price : $ {{sprintf('%0.2f', $tag->price)}}</h4>
                                            @else
                                                <a href="{{url('product_detail/'.$tag->id)}}"><img alt="" src="{{$base_url}}stock/assets/uploads/{{$tag->image}}" class="img-responsive"></a>
                                                <p class="text-height">{{substr($tag->name,0,30)}}</p>
                                                <h4>Price : $ {{sprintf('%0.2f', $tag->price)}}</h4>
                                            @endif
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
                                                    <a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" @else class="btn-addToCart" id="{{$tag->id}}" @endif><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                @if(Auth::check() and $wishList)
                                                    <li><a><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                                                @else
                                                    <li><a @if(!Auth::check()) data-toggle="modal" data-target=".myModal" ) @else class="btn-wishList" id="{{$tag->id}}" @endif style="cursor: pointer"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                                    </li>
                                                @endif
                                                <li>
                                                    @if(\Request::is('shop/product_detail/*'))
                                                        <a href="{{url('shop/product_detail/'.$tag->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
                                                    @else
                                                        <a href="{{url('product_detail/'.$tag->id)}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
@section('js')
    <script src="{{asset('js/bootstrap-swipe-carousel/bootstrap-swipe-carousel.min.js')}}"></script>
    <script type="text/javascript">
        $('.product-detail-phone').carousel().swipeCarousel({
            sensitivity : 'high',
            swipe : 20
        });
        var popupMeta = {
            width: 400,
            height: 400
        };
        function swap(image) {
            document.getElementById("big_image").src = image.href;
        }
        $(function() {
            $('a.zoom').bigImage({
                zoom: {
                    maskElement: function() {
                        return $('<div/>', { 'class': 'zoom-mask' });
                    }
                }
            });
            $('a.change-image').click(function() {
                var url = $(this).attr('href');
                //$('.big a').attr('href', url);
                $('a.zoom').bigImage('changeImage', {
                    smallImageUrl: url,
                    largeImageUrl: url,
                });
                $('.view-video').hide();
                $('.view-product').show();
            });
        });
        $('.view-video').hide();
        $('.play-video').click(function () {
            var url1 = '{{$product->video_url}}';
            url1 = url1.split('v=')[1];
            $(".video")[0].src = "https://www.youtube.com/v/" + url1;
           $('.view-product').hide();
           $('.view-video').show();
        });
        $('.product-detail-video-phone').hide();
        $('.view-video-mobile').click(function () {
            if('{{$product->video_url}}' == ''){
               $(".video-mobile")[0].src = '{{asset('images/user-shop/video/'.$product->video_upload)}}'
            }else{
                var urlMobile = '{{$product->video_url}}';
                urlMobile = urlMobile.split('v=')[1];
                $(".video-mobile")[0].src = "https://www.youtube.com/embed/" + urlMobile;
            }
            $('.product-detail-phone').hide();
            $('.product-detail-video-phone').show();
        })
        $('.view-image-mobile').click(function () {
            $('.product-detail-phone').show();
            $('.product-detail-video-phone').hide();
        })
    </script>
@endsection
