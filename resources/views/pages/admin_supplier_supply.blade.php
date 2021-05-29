@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Seller Status</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All file for download
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?Php
                        $orderStatuses = \App\OrderStatus::pluck('status','id');
                    ?>
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover product-order-list">
                                <thead>
                                <tr>
                                    <th> OrderID</th>
                                    {{--<th> Order Address </th>--}}
                                    <th> Supplier Name</th>
                                    {{--<th> Supplier Address</th>--}}
                                    <th>Customer Name</th>
                                    <th style="width: 200px"> Product Order</th>
                                    <th> Quantity</th>
                                    <th> Price</th>
                                    <th> Amount</th>
                                    {{--<th> Delivery Status</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?Php
                                $productSupplier = \App\ProductOrderDetail::
                                join('users','product_order_details.user_id','=','users.id')->
                                join('page_shops','product_order_details.shop_id','=','page_shops.user_id')
                                    ->select('product_order_details.*','page_shops.shop_name','page_shops.phone','page_shops.address','users.first_name','users.last_name','users.phone as order_phone')
                                    ->where('product_order_details.status',1)
                                    ->get();
                                ?>
                                @foreach($productSupplier as $product)
                                    <?php
                                    $orderStatus = \App\OrderStatus::where('id',$product->order_status)->first();
                                    $getPaymentStatus = \App\ProductOrder::where('id',$product->product_order_id)->first();
                                    if($product->product_from == 0){
                                        $productInfo = \App\ShopProduct::where('id',$product->product_id)->first();
                                        $url = 'shop/product_detail/'.$product->product_id;
                                        $firstImage = \App\Thumbnails::where('product_id',$productInfo->id)->first();
                                        $imgPath = 'images/thumbnails/shop/';
                                        $imageName = $firstImage->image;
                                    }

                                    ?>
                                    <tr class="even gradeC">
                                        <td>{{$product->product_order_id}}</td>
                                        {{--<td>{{$product->order_address}}</td>--}}
                                        <td>
                                            {{$product->shop_name}}
                                            <br>
                                            ({{$product->phone}})
                                        </td>
                                        <td>
                                            {{$product->first_name.' '.$product->last_name}}
                                            <br>
                                            ({{$product->order_phone}})
                                        </td>
                                        <td>
                                            @if($productInfo)
                                                <table>
                                                    <tr>
                                                        <td style="width: 30%">
                                                            @if($product->product_from == 0)
                                                                <img src="{{asset($imgPath.$imageName)}}" width="50px" class="img-rounded"> ({{$productInfo->sku}})
                                                            @else
                                                                <img src="{{$imgPath.$imageName}}" width="50px" class="img-rounded"> ({{'E'.$productInfo->id}})
                                                            @endif
                                                        </td>
                                                        <td style="text-align: left">
                                                            <a href="{{$url}}" target="_blank">
                                                                {{substr($productInfo->name,0,40)}} @if(strlen($productInfo->name) > 40) ... @endif
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            @endif
                                        </td>
                                        <td>{{$product->qty}}</td>
                                        <td>$ {{$product->price}}</td>
                                        <td>$ {{$product->amount}}</td>
                                        <td class="center">
                                            <a class="btn btn-info">{{$orderStatuses[$product->order_status]}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>

    </script>
@endsection