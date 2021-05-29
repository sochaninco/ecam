@extends('layouts.app')
@section('title','My eCamMall')
@section('my_ecammall','active')
@section('my_personal_order','active')
@section('content')
    <?php
    $userInfo = \App\User::where('id',$userId)->first();
    $check_shop = \App\PageShops::where('user_id',$userId)->first();
    $packages = \App\Packages::pluck('name','id');
    ?>
    @if($check_shop)
    <div class="container">
        <div class="row white-bg">
            <div class="col-sm-12 shop-info-header col-xs-12 no-padding">
                <div class="col-sm-8 col-xs-12 padding-5px">
                    <div class="col-sm-2 col-xs-3 no-padding">
                        <a href="{{url('em-user/'.$userInfo->id.'/my_account')}}"> <img src="{{asset('images/'.$userInfo->image)}}"></a>
                    </div>
                    <div class="col-sm-9 col-xs-9 padding-right">
                        <p>Name : {{$userInfo->first_name.' '.$userInfo->last_name}}</p>
                        <p>Email : {{$userInfo->email}}</p>
                        <p>Account Type : {{$packages[$userInfo->package_id]}}</p>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 padding-5px">
                    @if($check_shop)
                        <p>Shop Name : {{$check_shop->shop_name}}</p>
                        <p>Shop Email : {{$check_shop->shop_email}}</p>
                        <p>Shop Address : {{$check_shop->address}}</p>
                        <p>Shop URL : <a href="{{url('shop/'.$check_shop->shop_name)}}">{{url('shop/'.$check_shop->shop_name)}}</a></p>
                    @else
                        <a href="{{url('em-user/'.$userInfo->id.'/new_shop')}}"> Create Shop</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="container">
        <div class="row white-bg">
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
                        <div class="col-sm-6 col-xs-6 pull-left no-padding padding-top-5px padding-bottom-5">
                        <span>
                        @if(Auth::user()->user_role == 0)
                                <a href="{{url('em-user/'.$userInfo->id.'/my_orders')}}" class="btn btn-danger pull-right">View Ordered</a>
                            @endif
                        </span>
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
                    <div class="hidden-xs">
                        <table class="table table-striped table-hover margin-bottom-5px" id="list-pending-order">
                            <thead class="thead-dark">
                            <tr>
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
                                        <td colspan="6">This product was removed from system</td>
                                        <td>
                                            <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <table class="visible-xs table table-striped table-hover margin-bottom-5px" id="list-pending-order">
                        <thead class="thead-dark">
                        <tr>
                            <th> Image</th>
                            <th> Order Description</th>
                            <th class="nosort">Action</th>
                            {{--<th> Product Cost</th>--}}
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
                                            <a href="{{url('orders/'.$product->product_order_id.'/confirm_payment')}}" class="btn btn-info" style="width: 110px">Confirm Payment</a>
                                        @else
                                            Success
                                        @endif
                                        <p></p>
                                        <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" style="width: 110px" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                    </td>

                                    {{--<td>{{$product->cost}}</td>--}}
                                </tr>
                            @else
                                <tr class="even gradeC">
                                    <td colspan="6">This product was removed from system</td>
                                    <td>
                                        <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                    </td>
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
                    <div class="clearfix"></div>
                    <table class="hidden-xs table table-striped table-hover margin-bottom-5px" id="list-product">
                        <thead class="thead-dark">
                        <tr>
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
                                    @if($product->product_from == 0)
                                        <td>
                                            <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" width="auto" height="80px"/>
                                        </td>
                                        <td>
                                            <a href="{{url('shop/product_detail/'.$product->product_id)}}">{{$ProductName[$product->product_id]}}</a>
                                        </td>
                                    @else
                                        <td>
                                            <img alt="" src="{{asset('stock/assets/uploads/'.$ProductImage[$product->product_id])}}" width="auto" height="80px">
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
                                    <td colspan="6"> Product was removed from System</td>
                                    <td>
                                        <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <table class="visible-xs table table-striped table-hover margin-bottom-5px" id="list-product">
                        <thead class="thead-dark">
                        <tr>
                            <th> Image</th>
                            <th> Order Description</th>
                            {{--<th> Product Cost</th>--}}
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
                                            <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" alt="" width="auto" height="80px"/>
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
                                            <img alt="" src="{{asset('stock/assets/uploads/'.$ProductImage[$product->product_id])}}" width="auto" height="80px">
                                        </td>
                                        <td style="white-space: normal">
                                            <a href="{{url('product_detail/'.$product->product_id)}}">{{substr($ProductName[$product->product_id],0,16)}} ... </a>
                                            <br>
                                            $ {{number_format($product->price,2)}} x ({{$product->qty}})
                                            <br>
                                            = $ {{number_format($product->amount,2)}}
                                        </td>
                                    @endif
                                    <td>
                                        @if($product->status == 0)
                                            <a href="{{url('orders/'.$product->product_order_id.'/confirm_payment')}}">Confirm Payment</a>
                                        @else
                                            <a class="btn btn-info" style="width: 80px"> Success </a>
                                        @endif
                                        <p></p>
                                        <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" style="width: 80px;" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                    </td>
                                </tr>
                            @else
                                <tr class="even gradeC">
                                    <td colspan="6"> Product was removed from System</td>
                                    <td>
                                        <a href="{{url('orders/'.$product->product_order_id.'/delete')}}" class="btn btn-danger" style="width: 80px" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-sm-9 col-xs-12 padding-5px pull-right">
                <div class="col-sm-12 col-xs-12 no-padding">
                    <?php
                    $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>10,'category_id'=>2])->get();
                    ?>
                    <div id="brand-zone-item-carousel" data-interval="5500" data-type="multi" data-ride="carousel" class="carousel slide">
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
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <div class="padding-bottom-15">
                    <div class="col-sm-6 col-xs-6 no-padding">
                        <h2 class="title">
                            My Product
                        </h2>
                    </div>
                    <div class="col-sm-6 col-xs-6 pull-left no-padding padding-top-5px padding-bottom-5">
                        <span>
                        @if($check_shop)
                            @if(Auth::user()->user_role == 0)
                                <a href="{{url('em-user/shop/'.$ShopName.'/new_product')}}" class="btn btn-danger pull-right"><i class="fa fa-plus"></i> Add Product</a>
                            @endif
                        @else
                                <a href="{{url('em-user/'.$userId.'/new_shop')}}" class="btn btn-danger pull-right"><i class="fa fa-plus"></i> Create Shop</a>
                        @endif
                        </span>
                    </div>
                </div>
                <?php
                $expiredDate = date('Y-m-d',strtotime($expiredDateStr));
                $currentDate = date('Y-m-d');
                ?>
                <div class="col-lg-12 col-sm-12 col-xs-12 no-padding">
                    <div class="dataTable_wrapper table-responsive">
                        <div class="hidden-xs">
                            <table class="table table-striped table-bordered table-hover" id="list-product">
                                <thead>
                                <tr>
                                    <th> Image</th>
                                    <th> Code </th>
                                    <th> Name</th>
                                    {{--<th> Product Cost</th>--}}
                                    <th> Price</th>
                                    <th> QTY </th>
                                    <th class="nosort">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Products as $product)
                                    <?php
                                    $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                    ?>
                                    <tr class="even gradeC">
                                        <td>
                                            {{--<img src="{{asset('images/thumbnails/'.$imageName)}}" class="img-responsive" width="50px">--}}
                                            <img src="{{asset('images/thumbnails/medium/'.$imageName)}}" class="img-responsive" width="50px">
                                        </td>
                                        <td>
                                            {{$product->sku}}
                                            @if($product->promotion > 0)
                                                <span class="label label-warning">promotion</span>
                                            @endif
                                        </td>
                                        <td>{{$product->name}} </td>
                                        {{--<td>{{$product->cost}}</td>--}}
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td class="center">
                                            <a href="{{url('em-user/shop/'.$product->user_id.'/edit_product/'.$product->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                            </a>
                                            @if($expiredDate != $currentDate)
                                                @if($product->status == 0)
                                                    <a href="{{url('user_product/'.$product->user_id.'/disable_product/'.$product->id)}}" class="btn btn-danger"><i class="fa fa-times"></i>
                                                    </a>
                                                @else
                                                    <a href="{{url('user_product/'.$product->user_id.'/enable_product/'.$product->id)}}" class="btn btn-info"><i class="fa fa-check"></i>
                                                    </a>
                                                @endif
                                                <a href="{{url('user_product/'.$product->user_id.'/delete_product/'.$product->id)}}" class="btn btn-success"><i class="fa fa-trash"></i> </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <table class="visible-xs table table-striped table-bordered table-hover" id="list-product">
                            <thead>
                            <tr>
                                <th> Image</th>
                                <th colspan="4"> Product Description</th>
                                {{--<th> Product Cost</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Products as $product)
                                <?php
                                $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                ?>
                                <tr class="even gradeC">
                                    <td rowspan="2">
                                        {{--<img src="{{asset('images/thumbnails/'.$imageName)}}" class="img-responsive" width="50px">--}}
                                        <img src="http://ecammall.com/images/thumbnails/medium/{{$imageName}}" class="img-responsive" width="60px">
                                    </td>
                                    <td colspan="4">{{substr($product->name,0,33)}}...</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{$product->sku}}
                                        @if($product->promotion > 0)
                                            <span class="label label-warning">Pro</span>
                                        @endif
                                    </td>
                                    {{--<td>{{$product->cost}}</td>--}}
                                    <td>{{$product->price}}</td>
                                    <td>{{number_format($product->quantity,0)}}</td>
                                    <td class="center">
                                        <a href="{{url('em-user/shop/'.$product->user_id.'/edit_product/'.$product->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                        </a>
                                        @if($expiredDate != $currentDate)
                                        @if($product->status == 0)
                                            <a href="{{url('user_product/'.$product->user_id.'/disable_product/'.$product->id)}}" class="btn btn-danger"><i class="fa fa-times"></i>
                                            </a>
                                        @else
                                            <a href="{{url('user_product/'.$product->user_id.'/enable_product/'.$product->id)}}" class="btn btn-info"><i class="fa fa-check"></i>
                                            </a>
                                        @endif
                                        <a href="{{url('user_product/'.$product->user_id.'/delete_product/'.$product->id)}}" class="btn btn-success"><i class="fa fa-trash"></i> </a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection