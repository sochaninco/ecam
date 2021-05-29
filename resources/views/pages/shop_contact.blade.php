@extends('layouts.app')
@section('title','Shop Contact')
@section('content')
    @if(Request::is('shop/*'))
        <div class="container shop-menu-bg shop-page">
            <div class="col-sm-3 margin-top-5px">
                <div class="btn-group dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-animations="fadeInDown">
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
                </div>
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
                </div><!--/category-tab-->
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
                <div class="col-sm-3">
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
                        <div class="shipping text-center hidden-xs"><!--shipping-->
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
                            <div class="col-md-12 col-sm-12 col-xs-12 padding-5px products">
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
                </div>
                <div class="col-sm-9 padding-right">
                    <div class="col-sm-8">
                        <div class="contact-form">
                            <h2 class="title text-center">Get In Touch</h2>
                            <div style="display: none" class="status alert alert-success"></div>
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
                    <div class="col-sm-4">
                        <div class="contact-info">
                            <h2 class="title text-center">Contact Information</h2>
                            <?php
                            $userShopInfo = \App\User::where('id',$ShopInfo->user_id)->first();
                            ?>
                            @if($userShopInfo->shop_info == 1)
                                <div class="shop-information" style="border: none"><!--/product-information-->
                                    <div class="col-sm-12 col-xs-12" align="center">
                                        <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                            <img src="{{asset('images/user-shop/'.$ShopInfo->shop_logo)}}" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 no-padding">
                                        <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                            <h2>{{$ShopInfo->shop_name}}</h2>
                                        </a>
                                        <i class="fa fa-phone"></i> : {{$ShopInfo->phone}} <br> <i class="fa fa-envelope"></i> : {{$ShopInfo->shop_email}} <br>
                                        <i class="fa fa-home"></i> : {{$ShopInfo->address}} <br>
                                        <i class="fa fa-globe"></i> : <a href="{{url('shop/'.$ShopInfo->shop_name)}}" target="_blank"> {{$ShopInfo->website}} </a>
                                    </div>
                                </div>
                            @else
                                <div class="shop-information" style="border: none">
                                    <div class="col-sm-12 col-xs-12" align="center">
                                        <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                            <img src="{{asset('images/user-shop/'.$ShopInfo->shop_logo)}}" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 no-padding">
                                        <a href="{{url('shop/'.$ShopInfo->shop_name)}}">
                                            <h2>{{$ShopInfo->shop_name}}</h2>
                                        </a>
                                        <i class="fa fa-globe"></i> : <a href="{{url('shop/'.$ShopInfo->shop_name)}}" target="_blank"> {{$ShopInfo->website}} </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
