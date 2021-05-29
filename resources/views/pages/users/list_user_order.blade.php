@extends('layouts.app')
@section('title','My eCamMall')
@section('my_order','active')
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

                    <div class="padding-bottom-15">
                        <div class="col-sm-6 col-xs-6 no-padding">
                            <h2 class="title">
                                My Order
                            </h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                <div class="col-lg-12 no-padding">
                    <div class="padding-bottom-15">
                        <div class="col-sm-6 col-xs-6 no-padding">
                            <h2 class="title">
                                Pending Order
                            </h2>
                        </div>
                        <div class="col-sm-6 col-xs-6 pull-left no-padding padding-top-5px padding-bottom-5">
                        <span>
                        <a href="{{url('pending_orders/confirm_all_payment')}}" class="btn btn-danger pull-right">Confirm all payment</a>
                        </span>
                        </div>
                    </div>
                    <noscript>
                        <table class="hidden-xs table table-striped table-hover" id="list-pending-order">
                            <thead>
                            <tr>
                                <th>OrderID</th>
                                <th> Image</th>
                                <th> Product Name</th>
                                {{--<th> Product Cost</th>--}}
                                <th> Price</th>
                                <th> Order Quantity </th>
                                <th> Amount</th>
                                <th>Order Status</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pendingOrder as $product)
                                <?php
                                if($product->product_from == 0){
                                    $checkProduct = \App\ShopProduct::where('id',$product->product_id)->first();
                                    $ProductName = \App\ShopProduct::pluck('name','id');
                                    $firstImage = \App\Thumbnails::where('product_id',$product->product_id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                }else{
                                    $checkProduct = \App\Product::where('id',$product->product_id)->first();
                                    $ProductName = \App\Product::pluck('name','id');
                                    $ProductImage = \App\Product::pluck('image','id');
                                }
                                ?>
                                @if($checkProduct)
                                    <tr class="even gradeC">
                                        <td>{{$product->product_order_id}}</td>
                                        @if($product->product_from == 0)
                                            <td>
                                                <img alt="" src="{{asset('images/thumbnails/medium/'.$imageName)}}" width="auto" height="80px">
                                            </td>
                                            <td>
                                                <a href="{{url('shop/product_detail/'.$product->product_id)}}">{{$ProductName[$product->product_id]}}</a>
                                            </td>
                                        @else
                                            <td>
                                                <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$ProductImage[$product->product_id]}}" width="auto" height="80px">
                                            </td>
                                            <td>
                                                <a href="{{url('product_detail/'.$product->product_id)}}">{{$ProductName[$product->product_id]}}</a>
                                            </td>
                                        @endif

                                        {{--<td>{{$product->cost}}</td>--}}
                                        <td>$ {{number_format($product->price,2)}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>$ {{number_format($product->amount,2)}}</td>
                                        <td>
                                            @if($product->status == 0)
                                                Pending
                                                <br>
                                                <a href="{{url('orders/'.$product->product_order_id.'/confirm_payment')}}">Confirm Payment</a>
                                            @else
                                                Success
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                        </td>
                                    </tr>
                                @else
                                    <tr class="even gradeC">
                                        <td colspan="7">
                                            This product was removed from system
                                        </td>
                                        <td>
                                            <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <table class="visible-xs table table-striped table-hover" id="list-pending-order">
                            <thead>
                            <tr>
                                <th> Image</th>
                                <th> Name</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pendingOrder as $product)
                                <?php
                                if($product->product_from == 0){
                                    $checkProduct = \App\ShopProduct::where('id',$product->product_id)->first();
                                    $ProductName = \App\ShopProduct::pluck('name','id');
                                    $firstImage = \App\Thumbnails::where('product_id',$product->product_id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                }else{
                                    $checkProduct = \App\Product::where('id',$product->product_id)->first();
                                    $ProductName = \App\Product::pluck('name','id');
                                    $ProductImage = \App\Product::pluck('image','id');
                                }
                                ?>
                                @if($checkProduct)
                                    <tr class="even gradeC">
                                        @if($product->product_from == 0)
                                            <td>
                                                <img alt="" src="{{asset('images/thumbnails/medium/'.$imageName)}}" width="auto" height="80px">
                                            </td>
                                            <td style="white-space: normal">
                                                <a href="{{url('shop/product_detail/'.$product->product_id)}}">{{substr($ProductName[$product->product_id],0,16)}} ...</a>
                                                <br>
                                                $ {{number_format($product->price,2)}} x ({{$product->qty}})
                                                <br>
                                                = $ {{number_format($product->amount,2)}}
                                            </td>
                                        @else
                                            <td>
                                                <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$ProductImage[$product->product_id]}}" width="auto" height="80px">
                                            </td>
                                            <td style="white-space: normal">
                                                <a href="{{url('product_detail/'.$product->product_id)}}">{{substr($ProductName[$product->product_id],0,16)}} ...</a>
                                                <br>
                                                $ {{number_format($product->price,2)}} x ({{$product->qty}})
                                                <br>
                                                = $ {{number_format($product->amount,2)}}
                                            </td>
                                        @endif
                                        <td>
                                            @if($product->status == 0)

                                                <a href="{{url('orders/'.$product->product_order_id.'/confirm_payment')}}" class="btn btn-info" style="width: 150px">Confirm Payment</a>
                                            @else
                                                Success
                                            @endif
                                            <p></p>
                                            <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" style="width: 150px" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                        </td>
                                    </tr>
                                @else
                                    <tr class="even gradeC">
                                        <td colspan="7">
                                            This product was removed from system
                                        </td>
                                        <td>
                                            <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </noscript>
                    <table class="table table-hover">
                        <thead>
                        <tr class="gray-bg">
                            <th colspan="2">
                                Product
                            </th>
                            <th colspan="3">Product Action</th>
                            <th>Order Status</th>
                            <th colspan="2">Order Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pendingOrder as $order)
                            <?php
                            $shopInfo = \App\PageShops::where('user_id',$order->shop_id)->first();
                            if($shopInfo){
                                $shopName = $shopInfo->shop_name;
                                $shopPhone = $shopInfo->phone;
                            }else{
                                $shopName = 'ECAMMall Collection';
                                $shopPhone= '015 77 55 53';
                            }
                            $orderStatus = \App\OrderStatus::where('id',$order->order_status)->first();
                            if($order->product_from == 0){
                                $productInfo = \App\ShopProduct::where('id',$order->product_id)->first();
                                $url = 'shop/product_detail/'.$order->product_id;
                                $firstImage = \App\Thumbnails::where('product_id',$productInfo->id)->first();
                                $imgPath = 'images/thumbnails/shop/';
                                $imageName = $firstImage->image;
                            }else{
                                $productInfo = \App\Product::where('id',$order->product_id)->first();
                                $url = 'product_detail/'.$order->product_id;
                                $imgPath = 'http://ecammall.com/stock/assets/uploads/';
                                $imageName =$productInfo->image;
                            }
                            ?>
                            @if($productInfo)
                            <tr>
                                <th colspan="2"> Order ID : {{$order->product_order_id}}
                                    <br>Order Time : {{$order->created_at->format('H:i M d Y')}}
                                </th>
                                <th colspan="4"> Store Name : {{$shopName . ' ('. $shopPhone.')'}}
                                    <br><a href="{{url('shop/'.$shopName)}}" target="_blank"> Visit Store</a> | <i class="fa fa-envelope"></i> Contact Seller
                                </th>
                                <th> Order Amount : <br><span class="order-amount">$ {{number_format($order->amount,2)}}</span></th>
                                <td> <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" onclick="return confirm('Are you sure you want to delete this order?');"><i class="fa fa-trash"></i> </a></td>
                            </tr>
                            <tr>
                                <td>
                                    @if($order->product_from == 0)
                                        <img src="{{asset($imgPath.$imageName)}}" width="50px" class="img-rounded"> <br>({{$productInfo->sku}})
                                    @else
                                        <img src="{{$imgPath.$imageName}}" width="50px" class="img-rounded"> <br>({{'E'.$productInfo->id}})
                                    @endif
                                </td>
                                <td>

                                    <a href="{{url($url)}}" target="_blank">
                                        {{substr($productInfo->name,0,40)}} @if(strlen($productInfo->name) > 40) ... @endif
                                    </a>
                                    <br>
                                    ($ {{number_format($order->price,2)}} x {{$order->qty}})
                                </td>
                                <td colspan="3">
                                    @if($order->order_status == 7)
                                        <a class="btn btn-success">{{$orderStatus->status}}</a>
                                    @endif</td>

                                <td>@if($order->status == 0)
                                        <a href="{{url('orders/'.$order->product_order_id.'/confirm_payment')}}" class="btn btn-danger">Confirm Payment</a>
                                    @else
                                        Success
                                    @endif</td>
                                <td>
                                    {{--<a class="btn cart btn-addToCart" @if($productInfo->quantity == 0) disabled @endif id="{{$productInfo->id}}">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </a>--}}
                                </td>
                                <td></td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>

                    </table>

                    <hr>

                    <div class="padding-bottom-15">
                        <div class="col-sm-6 col-xs-6 no-padding">
                            <h2 class="title">
                                Success Order
                            </h2>
                        </div>
                    </div>
                    <noscript>
                        <table class="hidden-xs table table-striped table-hover" id="list-product">
                            <thead>
                            <tr>
                                <th>OrderID</th>
                                <th> Image</th>
                                <th> Product Name</th>
                                {{--<th> Product Cost</th>--}}
                                <th> Price</th>
                                <th> Order Quantity </th>
                                <th> Amount</th>
                                <th>Order Status</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($successOrder as $product)
                                <?php
                                if($product->product_from == 0){
                                    $checkProduct = \App\ShopProduct::where('id',$product->product_id)->first();
                                    $firstImage = \App\Thumbnails::where('product_id',$product->product_id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                    $ProductName = \App\ShopProduct::pluck('name','id');
//                                                    $ProductImage = \App\ShopProduct::pluck('image','id');
                                }else{
                                    $checkProduct = \App\Product::where('id',$product->product_id)->first();
                                    $ProductName = \App\Product::pluck('name','id');
                                    $ProductImage = \App\Product::pluck('image','id');
                                }
                                ?>
                                @if($checkProduct)
                                    <tr class="even gradeC">
                                        <td>{{$product->product_order_id}}</td>
                                        @if($product->product_from == 0)
                                            <td>
                                                <img src="{{asset('images/thumbnails/shop/'.$imageName)}}" alt="" width="auto" height="80px"/>
                                            </td>
                                            <td>
                                                <a href="{{url('shop/product_detail/'.$product->product_id)}}">{{$ProductName[$product->product_id]}}</a>
                                            </td>
                                        @else
                                            <td>
                                                <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$ProductImage[$product->product_id]}}" width="auto" height="80px">
                                            </td>
                                            <td>
                                                <a href="{{url('product_detail/'.$product->product_id)}}">{{$ProductName[$product->product_id]}}</a>
                                            </td>
                                        @endif

                                        {{--<td>{{$product->cost}}</td>--}}
                                        <td>$ {{number_format($product->price,2)}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>$ {{number_format($product->amount,2)}}</td>
                                        <td>
                                            @if($product->status == 0)
                                                Pending
                                                <br>
                                                <a href="{{url('orders/'.$product->product_order_id.'/confirm_payment')}}">Confirm Payment</a>
                                            @else
                                                Success
                                            @endif
                                        </td>
                                        <td>
                                            <?php
                                            $shippingOrder = \App\ShippingOrder::where('order_id',$product->product_order_id)->first();
                                            ?>
                                            @if($shippingOrder)
                                                <?php
                                                $orderStatus = \App\OrderStatus::where('id',$shippingOrder->status)->first();
                                                ?>
                                                <a class="btn btn-success">{{$orderStatus->status}}</a>
                                            @else
                                                <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                @else
                                    <tr class="even gradeC">
                                        <td colspan="7">This product was removed from system</td>
                                        <td>
                                            <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <table class="visible-xs table table-striped table-hover" id="list-product">
                            <thead>
                            <tr>
                                <th> Image</th>
                                <th> Order Description</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($successOrder as $product)
                                <?php

                                if($product->product_from == 0){
                                    $checkProduct = \App\ShopProduct::where('id',$product->product_id)->first();
                                    $firstImage = \App\Thumbnails::where('product_id',$product->product_id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                    $ProductName = \App\ShopProduct::pluck('name','id');
//                                                    $ProductImage = \App\ShopProduct::pluck('image','id');
                                }else{
                                    $checkProduct = \App\Product::where('id',$product->product_id)->first();
                                    $ProductName = \App\Product::pluck('name','id');
                                    $ProductImage = \App\Product::pluck('image','id');
                                }
                                ?>
                                @if($checkProduct)
                                    <tr class="even gradeC">
                                        @if($product->product_from == 0)
                                            <td>
                                                <img src="{{asset('images/thumbnails/shop/'.$imageName)}}" alt="" width="auto" height="80px"/>
                                            </td>
                                            <td style="white-space: normal">
                                                <a href="{{url('shop/product_detail/'.$product->product_id)}}">{{substr($ProductName[$product->product_id],0,16)}} ...</a>
                                                <br>
                                                $ {{number_format($product->price,2)}} x ({{$product->qty}})
                                                <br> =$ {{number_format($product->amount,2)}}
                                            </td>
                                        @else
                                            <td>
                                                <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$ProductImage[$product->product_id]}}" width="auto" height="80px">
                                            </td>
                                            <td style="white-space: normal">
                                                <a href="{{url('product_detail/'.$product->product_id)}}">{{substr($ProductName[$product->product_id],0,16)}} ...</a>
                                                <br>
                                                $ {{number_format($product->price,2)}} x ({{$product->qty}})
                                                <br> =$ {{number_format($product->amount,2)}}
                                            </td>
                                        @endif
                                        <td>
                                            @if($product->status == 0)
                                                <a href="{{url('orders/'.$product->product_order_id.'/confirm_payment')}}">Confirm Payment</a>
                                            @else
                                                <a class="btn btn-info" style="width: 80px"> Success </a>
                                            @endif
                                            <?php
                                            $shippingOrder = \App\ShippingOrder::where('order_id',$product->product_order_id)->first();
                                            ?>
                                            <p></p>
                                            @if($shippingOrder)
                                                <?php
                                                $orderStatus = \App\OrderStatus::where('id',$shippingOrder->status)->first();
                                                ?>
                                                <a class="btn btn-success">{{$orderStatus->status}}</a>
                                            @else
                                                <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" style="width: 80px" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                            @endif
                                        </td>

                                        {{--<td>{{$product->cost}}</td>--}}
                                    </tr>
                                @else
                                    <tr class="even gradeC">
                                        <td colspan="7">This product was removed from system</td>
                                        <td>
                                            <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </noscript>

                    <table class="table table-hover">
                        <thead>
                        <tr class="gray-bg">
                            <th colspan="2">
                                Product
                            </th>
                            <th colspan="3">Product Action</th>
                            <th>Order Status</th>
                            <th colspan="2">Order Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($successOrder as $order)
                            <?php
                            $successOrderDetail = \App\ProductOrderDetail::where('product_order_id',$order->id)
                                ->where('status',1)
                                ->orderBy('product_order_id','desc')
                                ->get();
                            ?>
                            @foreach($successOrderDetail as $orderDetail)
                            <?Php
                            $shopInfo = \App\PageShops::where('user_id',$orderDetail->shop_id)->first();
                            if($shopInfo){
                                $shopName = $shopInfo->shop_name;
                                $shopPhone = $shopInfo->phone;
                            }else{
                                $shopName = 'ECAMMall Collection';
                                $shopPhone= '015 77 55 53';
                            }
                            $orderStatus = \App\OrderStatus::where('id',$orderDetail->order_status)->first();
                            if($orderDetail->product_from == 0){
                                $productInfo = \App\ShopProduct::where('id',$orderDetail->product_id)->first();
                                $url = 'shop/product_detail/'.$orderDetail->product_id;
                                $firstImage = \App\Thumbnails::where('product_id',$productInfo->id)->first();
                                $imgPath = 'images/thumbnails/shop/';
                                $imageName = $firstImage->image;
                            }else{
                                $productInfo = \App\Product::where('id',$orderDetail->product_id)->first();
                                $url = 'product_detail/'.$orderDetail->product_id;
                                $imgPath = 'http://ecammall.com/stock/assets/uploads/';
                                $imageName =$productInfo->image;
                            }
                            ?>
                            @if($order->id == $orderDetail->product_order_id)
                            <tr>
                                <th colspan="2"> Order ID : {{$order->id}}
                                    <br>Order Time : {{$order->created_at->format('H:i M d Y')}}
                                </th>
                                <th colspan="4"> Store Name : {{$shopName . ' ('. $shopPhone.')'}}
                                    <br><a href="{{url('shop/'.$shopName)}}" target="_blank"> Visit Store</a> | <i class="fa fa-envelope"></i> Contact Seller
                                </th>
                                <th> Order Amount : <br><span class="order-amount">$ {{number_format($order->amount,2)}}</span></th>
                                <td> <a href="{{url('orders/'.$orderDetail->product_order_id.'/delete')}}" onclick="return confirm('Are you sure you want to delete this order?');"><i class="fa fa-trash"></i> </a></td>
                            </tr>
                            @if($productInfo)
                                <tr>
                                    <td>
                                        @if($orderDetail->product_from == 0)
                                            <img src="{{asset($imgPath.$imageName)}}" width="50px" class="img-rounded"> <br>({{$productInfo->sku}})
                                        @else
                                            <img src="{{$imgPath.$imageName}}" width="50px" class="img-rounded"> <br>({{'E'.$productInfo->id}})
                                        @endif
                                    </td>
                                    <td>

                                        <a href="{{url($url)}}" target="_blank">
                                            {{substr($productInfo->name,0,40)}} @if(strlen($productInfo->name) > 40) ... @endif
                                        </a>
                                        <br>
                                        ($ {{number_format($orderDetail->price,2)}} x {{$orderDetail->qty}})
                                    </td>
                                    <td colspan="3">
                                        @if($orderDetail->order_status == 7)
                                            <a class="btn btn-success">{{$orderStatus->status}}</a>
                                        @endif</td>

                                    <td><button class="btn btn-info"> {{$orderStatus->status}} </button></td>
                                    <td><a class="btn cart btn-addToCart" @if($productInfo->quantity == 0) disabled @endif id="{{$productInfo->id}}">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </a></td>
                                    <td></td>
                                </tr>
                            @endif
                            @endif

                            @endforeach
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection