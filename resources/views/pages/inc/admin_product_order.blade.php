<?Php
$orderStatuses = \App\OrderStatus::get();
?>
<ul class="nav nav-tabs">
    @foreach($orderStatuses as $status)
        <li @if($status->id == 1) class="active" @endif>
            <a  href="#{{$status->id}}" data-toggle="tab">{{$status->status}}</a>
        </li>
    @endforeach
</ul>
<div class="tab-content ">
    <br>
    @foreach($orderStatuses as $statusContent)
        <?Php
        $productOrders = \App\ProductOrderDetail::
        join('users','product_order_details.user_id','=','users.id')
//                                join('page_shops','product_order_details.shop_id','=','page_shops.user_id')
            ->select('product_order_details.*','users.first_name','users.last_name','users.phone as order_phone','users.address as order_address')
            ->where('product_order_details.status',1)
            ->where('product_order_details.order_status',$statusContent->id)
            ->get();
        ?>

        <div class="tab-pane @if($statusContent->id == 1) active @endif" id="{{$statusContent->id}}">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover product-order-list">
                    <thead>
                    <tr>
                        <th> OrderID</th>
                        <th> Customer Name </th>
                        {{--<th> Order Address </th>--}}
                        <th> Supplier Name</th>
                        {{--<th> Supplier Address</th>--}}
                        <th style="width: 200px"> Product Order</th>
                        <th> Quantity</th>
                        <th> Price</th>
                        <th> Amount</th>
                        <th> Delivery Status</th>
                        <th class="nosort">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productOrders as $product)
                        <?php
                        $shopInfo = \App\PageShops::where('user_id',$product->shop_id)->first();
                        if($shopInfo){
                            $shopName = $shopInfo->shop_name;
                            $shopPhone = $shopInfo->phone;
                        }else{
                            $shopName = 'ECAMMall Collection';
                            $shopPhone= '015 77 55 53';
                        }
                        $orderStatus = \App\OrderStatus::where('id',$product->order_status)->first();
                        $getPaymentStatus = \App\ProductOrder::where('id',$product->product_order_id)->first();
                        if($product->product_from == 0){
                            $productInfo = \App\ShopProduct::where('id',$product->product_id)->first();
                            $url = 'shop/product_detail/'.$product->product_id;
                            $firstImage = \App\Thumbnails::where('product_id',$productInfo->id)->first();
                            $imgPath = 'images/thumbnails/shop/';
                            $imageName = $firstImage->image;
                        }else{
                            $productInfo = \App\Product::where('id',$product->product_id)->first();
                            $url = 'product_detail/'.$product->product_id;
                            $imgPath = 'http://ecammall.com/stock/assets/uploads/';
                            $imageName =$productInfo->image;
                        }

                        ?>
                        <tr class="even gradeC">
                            <td>{{$product->product_order_id}}</td>
                            <td>
                                {{$product->last_name}}
                                <br>
                                ({{$product->order_phone}})
                            </td>
                            {{--<td>{{$product->order_address}}</td>--}}
                            <td>
                                {{$shopName}}
                                <br>
                                ({{$shopPhone}})
                            </td>
                            {{--<td>{{$product->address}}</td>--}}
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
                            <td> {{--{{$orderStatus->status}}--}}
                                @if($getPaymentStatus && $getPaymentStatus->payment_status == 0)
                                    <a onclick="return confirm('Confirm payment with accountant?');" class="btn btn-danger">Confirm Payment</a>
                                @else
                                    @if($product->order_status == 7)
                                        <a class="btn btn-success">{{$statusContent->status}}</a>
                                    @else
                                        {!! Form::open(['url'=>url('orders/'.$product->product_order_id.'/start_shipping'),'method'=>'POST','files'=>true,'role'=>'form']) !!}
                                        <div class="form-group">
                                            {{--{!! Form::select('status',$orderStatuses,$product->order_status,['class'=>'orderStatus form-control','placeholder'=>'Select order Status ...']) !!}--}}
                                            {{--<select class="form-control col-sm-2" name="status">
                                                <option value="" disabled>Select order Status ...</option>
                                                @foreach($orderStatuses as $value)
                                                    <option value="{{$value->id}}" @if($product->order_status == $value->id) selected @endif @if($value->id <= $product->order_status) disabled @endif>{{$value->status}}</option>
                                                @endforeach
                                            </select>--}}
                                            <input type="hidden" value="{{$product->order_status+1}}" name="status">
                                            <input type="hidden" value="{{$product->product_id}}" name="product_id">
                                            {{--@foreach($orderStatuses as $value)
                                                @if($value->id == $product->order_status)--}}
                                            <input type="submit" class="form-control col-sm-2 btn btn-info" value="{{$statusContent->status}}">
                                            {{--@endif--}}
                                            {{--@endforeach--}}
                                        </div>
                                        </form>
                                    @endif
                                @endif
                            </td>
                            <td class="center">
                                @if($product->order_status == 7)
                                    <a href="{{url('admin_payment_delete/'.$product->product_order_id)}}" class="btn btn-danger" onclick="return confirm('Do you want to delete this payment');"><i class="fa fa-trash"></i> </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
