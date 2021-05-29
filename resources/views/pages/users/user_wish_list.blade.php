@extends('layouts.app')
@section('title','My eCamMall')
@section('my_wish','active')
@section('my_personal_order','active')
@section('content')
    <div class="container">
        <div class="row white-bg">
            <div class="container no-padding">
                <?php
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>11,'page'=>3])->get();
                ?>
                <div id="brand-zone-item-carousel" data-interval="300000" data-type="multi" data-ride="carousel" class="carousel slide">
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
            @include('pages.users.my_ecammall_menu_buy')
            <div class="col-sm-9 padding-5px">
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <h2 class="title text-center">
                    My WishLists
                </h2>
                <div class="col-lg-12 col-xs-12 no-padding">
                    <div class="dataTable_wrapper table-responsive">
                            <table class="hidden-xs table table-striped table-bordered table-hover" id="list-product">
                                <thead>
                                <tr>
                                    <th> Image</th>
                                    <th> Product Name</th>
                                    {{--<th> Product Cost</th>--}}
                                    <th class="nosort">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wishLists as $product)
                                    <?php
                                    if($product->product_from == 0){
                                        $firstImage = \App\Thumbnails::where('product_id',$product->product_id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                        $_product =\App\ShopProduct::where('id',$product->product_id)->first();
//                                                    $ProductImage = \App\ShopProduct::pluck('image','id');
                                    }else{
                                        $_product = \App\Product::where('id',$product->product_id)->first();
                                        /*$ProductName = \App\Product::pluck('name','id');
                                        $ProductImage = \App\Product::pluck('image','id');*/
                                    }
                                    ?>
                                    @if($_product)
                                    <tr class="even gradeC">
                                        @if($product->product_from == 0)
                                            <td>
                                                <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" width="auto" height="80px"/>
                                            </td>
                                            <td>
                                                <a href="{{url('shop/product_detail/'.$product->product_id)}}">{{$_product->name}}</a>
                                            </td>
                                            <td>
                                                <a href="{{url('shop/product_detail/'.$product->product_id)}}" class="btn btn-info">Detail</a>
                                                <a href="{{url('delete_wishlist/'.$product->id)}}" class="btn btn-danger">Delete</a>
                                            </td>
                                        @else
                                            <td>
                                                <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$_product->image}}" width="auto" height="80px">
                                            </td>
                                            <td>
                                                <a href="{{url('product_detail/'.$product->product_id)}}">{{$_product->name}}</a>
                                            </td>
                                            <td>
                                                <a href="{{url('product_detail/'.$product->product_id)}}" class="btn btn-info">Detail</a>
                                                <a href="{{url('delete_wishlist/'.$product->id)}}" class="btn btn-danger">Delete</a>

                                            </td>
                                        @endif

                                        {{--<td>{{$product->cost}}</td>--}}
                                    </tr>
                                    @else
                                        <tr>
                                            <td colspan="3">Product has been deleted from list</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <table class="visible-xs table table-striped table-bordered table-hover" id="list-product">
                            <thead>
                            <tr>
                                <th> Image</th>
                                <th> Product Name</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($wishLists as $product)
                                <?php
                                if($product->product_from == 0){
                                    $firstImage = \App\Thumbnails::where('product_id',$product->product_id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                    $_product =\App\ShopProduct::where('id',$product->product_id)->first();
//                                  $ProductImage = \App\ShopProduct::pluck('image','id');
                                }else{
                                    $_product = \App\Product::where('id',$product->product_id)->first();
                                    /*$ProductName = \App\Product::pluck('name','id');
                                    $ProductImage = \App\Product::pluck('image','id');*/
                                }
                                ?>
                                @if($_product)
                                    <tr class="even gradeC">
                                        @if($product->product_from == 0)
                                            <td>
                                                <img src="{{asset('images/thumbnails/'.$imageName)}}" alt="" width="auto" height="80px"/>
                                            </td>
                                            <td style="white-space: normal">
                                                <a href="{{url('shop/product_detail/'.$product->product_id)}}">{{$_product->name}}</a>
                                            </td>
                                            <td>
                                                <a href="{{url('shop/product_detail/'.$product->product_id)}}" class="btn btn-info">Detail</a>
                                                <a href="{{url('delete_wishlist/'.$product->id)}}" class="btn btn-danger">Delete</a>
                                            </td>
                                        @else
                                            <td>
                                                <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$_product->image}}" width="auto" height="80px">
                                            </td>
                                            <td style="white-space: normal">
                                                <a href="{{url('product_detail/'.$product->product_id)}}">{{$_product->name}}</a>
                                            </td>
                                            <td>
                                                <a href="{{url('product_detail/'.$product->product_id)}}" class="btn btn-info">Detail</a>
                                                <a href="{{url('delete_wishlist/'.$product->id)}}" class="btn btn-danger">Delete</a>

                                            </td>
                                        @endif

                                        {{--<td>{{$product->cost}}</td>--}}
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="3">Product has been deleted from list</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection