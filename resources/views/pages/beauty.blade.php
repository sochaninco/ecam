@extends('layouts.app')
@section('title','Beauty Zone')
@section('content')
    <section id="advertisement">
        <div class="container no-padding">
                <?php
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>10,'category_id'=>2])->get();
                ?>
                <div id="brand-zone-item-carousel" data-interval="5500" data-type="multi" data-ride="carousel" class="carousel slide">
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
            <h2 class="title text-center">New Collection</h2>
            <div class="col-md-6 no-padding">
                <?php
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>9])->get();
                ?>
                <div id="brand-zone-item-carousel" data-interval="5000" data-type="multi" data-ride="carousel" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach($Product_banner as $key=>$banner)
                            <div class="item @if($key == 0)active @endif ">
                                <a href="{{url('')}}" >
                                    <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                                </a>
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
            <div class="hidden-xs">
            <h2 class="title text-center"> Beauty By Brands</h2>
            <div id="brand-item-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                <div class="carousel-inner">
                    @foreach($beautyBrand->chunk(6) as $count => $brands)
                        <div class="item {{ $count == 0 ? 'active' : '' }}">
                            @foreach($brands as $brand)
                                <div class="col-sm-2">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="brand-logo-scroll text-center">
                                                <a href="{{url('products/brands/'.$brand->id)}}"><img src="http://ecammall.com/stock/assets/uploads/{{$brand->image}}" alt="" /></a>
                                                {{--<p>{{substr($brand->name,0,20)}} </p>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <a class="left recommended-item-control" href="#brand-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#brand-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
            </div>
            @foreach($beautyBrand as $brands)
                <?php
                $productCount = \App\ShopProduct::where('brand',$brands->id)->count();
                ?>
                @if($productCount > 3)
                    <div class="col-sm-3 padding-bottom text-center">
                <a href="{{url('products/brands/'.$brands->id)}}">
                <div class="no-padding">
                    @if(empty($brands->banner))
                    <img src="http://ecammall.com/stock/assets/uploads/{{$brands->image}}" class="img-responsive banner-brand" style="width: 384px">
                    @else
                        <img src="{{asset('images/brand/banner/'.$brands->banner)}}" class="img-responsive " style="width: 384px">
                    @endif
                </div>
                <div class="logo-box">
                    <img class="img-brand-zone" src="http://ecammall.com/stock/assets/uploads/{{$brands->image}}">
                </div>
                </a>
                <div class="clearfix padding-bottom"></div>

                {{--<p class="brand-name"> {{substr($brands->name,0,20)}} </p>--}}
                <?php
                    $products = \App\ShopProduct::where('brand',$brands->id)->inRandomOrder()->take(3)->get();
                ?>
                @foreach($products as $product)
                    <?php
                    $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                    ?>
                <div class="col-md-4 col-sm-4 col-xs-4 no-padding">
                    <div class="text-center">
                        <a href="{{url('shop/product_detail/'.$product->id)}}">
                            {{--<img alt="" src="http://ecammall.com/stock/assets/uploads/{{$product->image}}" class="brand-product">--}}
                            <img src="{{asset('images/thumbnails/'.$imageName)}}" class="brand-product">
                        </a>
                        <p>$ {{sprintf('%0.2f', $product->price)}}</p>
                    </div>
                </div>
                @endforeach
            </div>
                @endif
            @endforeach
            <div class="clearfix"></div>
            <h2 class="title text-center"> Beauty By SubCategory</h2>
            <?php
                $i = 0;
            ?>
            @foreach($beautySubcategory as $key=>$subcategory)
                <?php
                $products = \App\ShopProduct::where('sub_category_id',$subcategory->id)->inRandomOrder()->take(3)->get();
                $productCount = \App\ShopProduct::where('sub_category_id',$subcategory->id)->count();
                ?>
                @if($productCount>3)
                    <?php $i++;?>
                <div class="col-sm-3 padding-bottom text-center">
                    <a href="{{url('products/category/'.$subcategory->id)}}">
                        <div class="banner-subcategory no-padding">
                        @if(empty($subcategory->image))
                            <img src="http://ecammall.com/stock/assets/uploads/no_image.png" alt="" class="img-responsive" style="width: 384px"/>
                        @else
                            <img src="http://ecammall.com/stock/assets/uploads/{{$subcategory->image}}" alt="" class="img-responsive" style="width: 384px"/>
                        @endif
                        </div>
                        @if(empty($subcategory->logo))
                            <div class="name-box">
                                <p>{{$subcategory->name}}</p>
                            </div>
                        @else
                            <div class="logo-box">
                                <img class="img-brand-zone" src="{{asset('images/category/'.$subcategory->logo)}}">
                            </div>
                        @endif
                    </a>
                    <div class="clearfix padding-bottom"></div>

                    {{--<p class="brand-name"> {{substr($brands->name,0,20)}} </p>--}}
                    <?php
                    $products = \App\ShopProduct::where('sub_category_id',$subcategory->id)->inRandomOrder()->take(3)->get();
                    ?>
                    @foreach($products as $product)
                        <?php
                        $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                        ?>
                        <div class="col-md-4 col-sm-4 col-xs-4 no-padding">
                            <div class="text-center">
                                <a href="{{url('shop/product_detail/'.$product->id)}}">
                                    {{--<img alt="" src="http://ecammall.com/stock/assets/uploads/{{$product->image}}" class="brand-product">--}}
                                    <img src="{{asset('images/thumbnails/'.$imageName)}}" class="brand-product">
                                </a>
                                <p>$ {{sprintf('%0.2f', $product->price)}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($i == 4)
                    <div class="clearfix"></div>
                @endif
                @endif
            @endforeach
        </div>
    </div>
@endsection