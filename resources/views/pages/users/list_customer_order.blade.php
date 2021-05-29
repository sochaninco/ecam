@extends('layouts.app')
@section('title','My eCamMall')
@section('my_order','active')
@section('my_customer_order','active')
@section('my_customer_order_sub','active-sub')
@section('content')
    <div class="container">
        <div class="row white-bg">
            @include('pages.users.my_ecammall_menu_sell')
            <div class="col-sm-9 padding-right">
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <h2 class="title text-center">
                    Customer Order
                </h2>
                <div class="col-lg-12">
                    <div class="category-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#success">Success Orders</a></li>
                                <li><a data-toggle="tab" href="#pending">Pending Orders</a></li>
                                {{--<li class="active"><a data-toggle="tab" href="#tag">Related</a></li>--}}
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="success" class="tab-pane fade active in">
                                <div class="col-sm-12">
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="list-product">
                                            <thead>
                                            <tr>
                                                <th> Image</th>
                                                <th> Product Name</th>
                                                {{--<th> Product Cost</th>--}}
                                                <th> Price</th>
                                                <th> Order Quantity </th>
                                                <th> Amount</th>
                                                <th>Customer Info</th>
                                                <th class="nosort">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($successOrder as $product)
                                                <?php
                                                if($product->product_from == 0){
                                                    $firstImage = \App\Thumbnails::where('product_id',$product->product_id)->first();
                                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                                    $ProductName = \App\ShopProduct::pluck('name','id');
//                                                    $ProductImage = \App\ShopProduct::pluck('image','id');
                                                }else{
                                                    $ProductName = \App\Product::pluck('name','id');
                                                    $ProductImage = \App\Product::pluck('image','id');
                                                }
                                                $customerInfo = \App\User::where('id',$product->user_id)->first();
                                                ?>
                                                <tr class="even gradeC">
                                                    @if($product->product_from == 0)
                                                        <td>
                                                            <img src="{{asset('images/thumbnails/shop/'.$imageName)}}" alt="" width="auto" height="80px"/>
                                                        </td>
                                                        <td>
                                                            <a href="{{url('shop/product_detail/'.$product->product_id)}}">{{$ProductName[$product->product_id]}}</a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <img alt="" src="http://heangsochan.com/stock/assets/uploads/{{$ProductImage[$product->product_id]}}" width="auto" height="80px">
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
                                                        <p>Name : {{$customerInfo->first_name.' '.$customerInfo->last_name}} ,
                                                        <br> Email :{{$customerInfo->email}},
                                                        <br> Phone :{{$customerInfo->phone}},
                                                        <br> Address :{{$customerInfo->address}}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                                        <?php
                                                            $orderStatuses = \App\OrderStatus::pluck('status','id');
                                                            $orderStatus = \App\OrderStatus::where('id',$product->order_status)->first();
                                                            $shippingOrder = \App\ShippingOrder::where('order_id',$product->product_order_id)->first();
                                                        ?>
                                                        {!! Form::open(['url'=>url('orders/'.$product->product_order_id.'/start_shipping'),'method'=>'POST','files'=>true,'role'=>'form']) !!}
                                                        <div class="form-group">
                                                            {!! Form::select('status',$orderStatuses,$product->order_status,['id'=>'orderStatus','class'=>'form-control','placeholder'=>'Select order Status ...']) !!}
                                                            <input type="hidden" value="{{$product->product_id}}" name="product_id">
                                                        </div>
                                                        </form>
                                                        <button class="btn btn-success">{{$orderStatus->status}}</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="pending" class="tab-pane fade">
                                <div class="col-sm-12">
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="list-pending-order">
                                            <thead>
                                            <tr>
                                                <th> Image</th>
                                                <th> Product Name</th>
                                                {{--<th> Product Cost</th>--}}
                                                <th> Price</th>
                                                <th> Order Quantity </th>
                                                <th> Amount</th>
                                                <th> Order Status</th>
                                                <th> Customer Info</th>
                                                <th class="nosort">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pendingOrder as $product)
                                                <?php
                                                if($product->product_from == 0){
                                                    $ProductName = \App\ShopProduct::pluck('name','id');
                                                    $ProductImage = \App\ShopProduct::pluck('image','id');
                                                }else{
                                                    $ProductName = \App\Product::pluck('name','id');
                                                    $ProductImage = \App\Product::pluck('image','id');
                                                }
                                                $customerInfo = \App\User::where('id',$product->user_id)->first();
                                                ?>
                                                <tr class="even gradeC">
                                                    @if($product->product_from == 0)
                                                        <td>
                                                            <img alt="" src="{{asset('images/user-shop/product/'.$ProductImage[$product->product_id])}}" width="auto" height="80px">
                                                        </td>
                                                        <td>
                                                            <a href="{{url('shop/product_detail/'.$product->product_id)}}">{{$ProductName[$product->product_id]}}</a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <img alt="" src="http://heangsochan.com/stock/assets/uploads/{{$ProductImage[$product->product_id]}}" width="auto" height="80px">
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
                                                        <p>Name : {{$customerInfo->first_name.' '.$customerInfo->last_name}} ,
                                                            <br> Email : {{$customerInfo->email}},
                                                            <br> Phone : {{$customerInfo->phone}},
                                                            <br> Address : {{$customerInfo->address}}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a><br>
                                                        <a href="{{url('message/to_user/'.$product->user_id.'/shop_id/'.$product->shop_id.'/product_from/'.$product->product_from.'/product_id/'.$product->product_id)}}" class="btn btn-info">Message</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pull-right" style="padding-top: 20px">
                                        <a href="{{url('pending_orders/confirm_all_payment')}}" class="btn btn-danger">Confirm all payment</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!--/category-tab-->
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        $(function() {
            $('#orderStatus').on('change', function(e) {
                $(this).closest('form')
                    .trigger('submit')
            })
        })
    </script>
@endsection