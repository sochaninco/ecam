@extends('layouts.app')
@section('title','eCamMall Buy Now')
@section('content')
    <div class="container">
        <div class="row">
            <div class="ecam-head-layout white-bg">
                 <ul class="ecam-flow">
                    <a href="{{url('shopping-cart')}}">
                        <li class=""><i class="step1"></i>
                            <p>My Cart</p>
                            <sub></sub>
                            <div class="hr"></div>
                        </li>
                    </a>
                    <li class="current"><i class="step2"></i>
                        <p>Fill in and Confirm Order Info</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
                    <li class=""><i class="step3"></i>
                        <p>Submit Payment</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
                    <li class=""><i class="step4"></i>
                        <p>Confirm Payment</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
                    <li class=""><i class="step5"></i>
                        <p>Order Successfully</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
                </ul>
            </div>

            <section id="cart_items">
                <div class="container no-padding">
                    <div class="container white-bg padding-bottom-15">
                        <div class="col-sm-6">
                            <div class="register-req">
                                <p>1.Select your shipping information:</p>
                            </div><!--/register-req-->
                            <div class="shopper-informations white-bg">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="shopper-info">
                                            {!! Form::Open(["url"=>'shopping_cart/products/order','method'=>'POST','files'=>true]) !!}
                                            <input type="text" value="{{$BuyerInfo->last_name}}" placeholder="Display Name" name="name" @if($errors->has('name')) style="border: 1px solid red" @endif>
                                            <input type="text" value="{{$BuyerInfo->address}}" placeholder="Address" name="address" @if($errors->has('address')) style="border: 1px solid red" @endif>
                                            <input type="text" value="{{$BuyerInfo->phone}}" placeholder="Phone Number" name="phone"@if($errors->has('phone')) style="border: 1px solid red" @endif>
                                            {!! Form::select('city',$City,$BuyerInfo->city,['name'=>'city']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="register-req">
                                <p>3.Payment Method:</p>
                            </div>
                            @include('pages.orders.payment_method')

                        </div>
                    </div>
                    <div class="padding-bottom-15"></div>
                    <div class="container col-sm-12 white-bg">
                        <div class="register-req">
                            <p>2.Review and confirm your order:</p>
                        </div>

                        <div class="table-responsive cart_info">
                            <div class="hidden-xs">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Item</td>
                                        <td class="description"></td>
                                        <td class="price">Price</td>
                                        <td class="quantity">Quantity</td>
                                        <td class="total">Total</td>
                                        <td></td>
                                    </tr>
                                    </thead>

                                    @foreach($pendingProduct as $index=>$order)
                                        <?php
                                        if($order->product_from == 0){

                                            $firstImage = \App\Thumbnails::where('product_id',$order->product_id)->first();
                                            $imageName = isset($firstImage->image)?$firstImage->image:null;

                                            $ProductName = \App\ShopProduct::pluck('name','id');
                                        }else{
                                            $ProductName = \App\Product::pluck('name','id');
                                            $ProductImage = \App\Product::pluck('image','id');
                                        }
                                        ?>
                                        <tbody>
                                        <tr class="cart_check">
                                            <td>
                                                <a href="">
                                                    @if($order->product_from == 0)
                                                        <img alt="" src="{{asset('images/thumbnails/shop/'.$imageName)}}" width="auto" height="80px">
                                                        <input type="hidden" name="orders[{{$index}}][product_from]" value="0">
                                                    @else
                                                        <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$ProductImage[$order->product_id]}}" width="auto" height="80px">
                                                        <input type="hidden" name="orders[{{$index}}][product_from]" value="1">
                                                    @endif
                                                </a>
                                            </td>
                                            <td width="50%">
                                                <p><a href="">{{$ProductName[$order->product_id]}}</a></p>
                                            </td>
                                            <td class="cart_price" value="{{$order->price}}">
                                                <p>$ {{$order->price}}</p>
                                                <input type="hidden" name="orders[{{$index}}][product_id]" value="{{$order->product_id}}">
                                                <input type="hidden" name="orders[{{$index}}][price]" value="{{$order->price}}">
                                                <input type="hidden" name="orders[{{$index}}][id]" value="{{$order->id}}">
                                                <input type="hidden" name="orders[{{$index}}][product_order_id]" value="{{$order->product_order_id}}">
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    {{--<a class="cart_quantity_up" style="cursor: pointer"> + </a>--}}
                                                    <input class="cart_quantity_input" type="text" name="orders[{{$index}}][qty]" value="{{$order->qty}}" autocomplete="off" size="2" readonly>
                                                    {{--<a class="cart_quantity_down" style="cursor: pointer"> - </a>--}}
                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">$ {{$order->amount}}</p>
                                                <input type="hidden" name="orders[{{$index}}][amount]" value="{{$order->amount}}" class="cart_total_price_input">
                                            </td>
                                            <td class="cart_delete">
                                                <a class="pending_order_delete" style="cursor: pointer" id="{{$order->id}}"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                    @if(Session::has('cart'))
                                        <?php
                                        $index = isset($index)?$index:-1;
                                        $key = $index+1
                                        ?>
                                        @foreach($products as $product)
                                            <?php
                                            $firstImage = \App\Thumbnails::where('product_id',$product['id'])->first();
                                            $imageName = isset($firstImage->image)?$firstImage->image:$product['item']['image'];
                                            ?>
                                            <tbody>
                                            <tr class="cart_check">
                                                <td>
                                                    <a href="">
                                                        @if($product['product_from'] == 0)
                                                            <img alt="" src="{{asset('images/thumbnails/shop/'.$imageName)}}" width="auto" height="80px">
                                                            <input type="hidden" name="orders[{{$key}}][product_from]" value="user">
                                                        @else
                                                            <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$product['item']['image']}}" width="auto" height="80px">
                                                            <input type="hidden" name="orders[{{$key}}][product_from]" value="admin">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td width="50%">
                                                    <p><a href="">{{$product['item']['name']}}</a></p>
                                                </td>
                                                <td class="cart_price" value="{{$product['price']}}">
                                                    <p>$ {{$product['price']}}</p>
                                                    <input type="hidden" name="orders[{{$key}}][product_id]" value="{{$product['id']}}">
                                                    <input type="hidden" name="orders[{{$key}}][price]" value="{{$product['price']}}">
                                                </td>
                                                <td class="cart_quantity">
                                                    <div class="cart_quantity_button">
                                                        <input class="cart_quantity_input" type="text" name="orders[{{$key}}][qty]" value="{{$product['quantity']}}" autocomplete="off" size="2" readonly="readonly">
                                                    </div>
                                                </td>
                                                <td class="cart_total">
                                                    <p class="cart_total_price">$ {{number_format($product['price']*$product['quantity'],2)}}</p>
                                                    <input type="hidden" name="orders[{{$key}}][amount]" value="{{$product['price']*$product['quantity']}}" class="cart_total_price_input">
                                                </td>
                                                <td class="cart_delete">
                                                    <a class="cart_quantity_delete" style="cursor: pointer" id="{{$product['id']}}"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php $key++;?>
                                        @endforeach
                                    @else

                                        <td>Cart Empty</td>
                                    @endif

                                </table>
                            </div>

                            <table class="table table-condensed visible-xs">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Item</td>
                                    <td class="description" colspan="2"></td>
                                </tr>
                                </thead>

                                @foreach($pendingProduct as $index=>$order)
                                    <?php
                                    if($order->product_from == 0){
                                        $firstImage = \App\Thumbnails::where('product_id',$order->product_id)->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:null;
                                        $ProductName = \App\ShopProduct::pluck('name','id');
                                    }else{
                                        $ProductName = \App\Product::pluck('name','id');
                                        $ProductImage = \App\Product::pluck('image','id');
                                    }
                                    ?>
                                    <tbody class="cart_check">
                                    <tr>
                                        <td rowspan="3">
                                            <a href="">
                                                @if($order->product_from == 0)
                                                    <img alt="" src="{{asset('images/thumbnails/shop/'.$imageName)}}" width="auto" height="80px">
                                                    <input type="hidden" name="orders[{{$index}}][product_from]" value="0">
                                                @else
                                                    <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$ProductImage[$order->product_id]}}" width="auto" height="80px">
                                                    <input type="hidden" name="orders[{{$index}}][product_from]" value="1">
                                                @endif
                                            </a>
                                        </td>
                                        <td width="50%" colspan="2">
                                            <p><a href="">{{substr($ProductName[$order->product_id],0,30)}}</a></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_price" id="{{$order->price}}">
                                            <p>$ {{$order->price}}</p>
                                            <input type="hidden" name="orders[{{$index}}][product_id]" value="{{$order->product_id}}">
                                            <input type="hidden" name="orders[{{$index}}][price]" value="{{$order->price}}">
                                            <input type="hidden" name="orders[{{$index}}][id]" value="{{$order->id}}">
                                            <input type="hidden" name="orders[{{$index}}][product_order_id]" value="{{$order->product_order_id}}">
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                {{--<a class="cart_quantity_up" style="cursor: pointer"> + </a>--}}
                                                <input class="cart_quantity_input" type="text" name="orders[{{$index}}][qty]" value="{{$order->qty}}" autocomplete="off" size="2" readonly>
                                                {{--<a class="cart_quantity_down" style="cursor: pointer"> - </a>--}}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total">
                                            <p class="cart_total_price">$ {{$order->amount}}</p>
                                            <input type="hidden" name="orders[{{$index}}][amount]" value="{{$order->amount}}" class="cart_total_price_input">
                                        </td>
                                        <td class="cart_delete">
                                            <a class="pending_order_delete" style="cursor: pointer" id="{{$order->id}}"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                                @if(Session::has('cart'))
                                    <?php
                                    $index = isset($index)?$index:-1;
                                    $key = $index+1
                                    ?>
                                    @foreach($products as $product)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$product['id'])->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product['item']['image'];
                                        ?>
                                        <tbody class="cart_check">
                                        <tr>
                                            <td rowspan="3">
                                                <a href="">
                                                    @if($product['product_from'] == 0)
                                                        <img alt="" src="{{asset('images/thumbnails/shop/'.$imageName)}}" width="auto" height="80px">
                                                        <input type="hidden" name="orders[{{$key}}][product_from]" value="user">
                                                    @else
                                                        <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$product['item']['image']}}" width="auto" height="80px">
                                                        <input type="hidden" name="orders[{{$key}}][product_from]" value="admin">
                                                    @endif
                                                </a>
                                            </td>
                                            <td width="70%">
                                                <p><a href="">{{substr($product['item']['name'],0,30)}}</a></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_price" value="{{$product['price']}}">
                                                <p>$ {{$product['price']}}</p>
                                                <input type="hidden" name="orders[{{$key}}][product_id]" value="{{$product['id']}}">
                                                <input type="hidden" name="orders[{{$key}}][price]" value="{{$product['price']}}">
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    <input class="cart_quantity_input" type="text" name="orders[{{$key}}][qty]" value="{{$product['quantity']}}" autocomplete="off" size="2" readonly="readonly">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total">
                                                <p class="cart_total_price">$ {{number_format($product['price']*$product['quantity'],2)}}</p>
                                                <input type="hidden" name="orders[{{$key}}][amount]" value="{{$product['price']*$product['quantity']}}" class="cart_total_price_input">
                                            </td>
                                            <td class="cart_delete">
                                                <a class="cart_quantity_delete" style="cursor: pointer" id="{{$product['id']}}"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <?php $key++;?>
                                    @endforeach
                                @else

                                    <td>Cart Empty</td>
                                @endif

                            </table>
                        </div>
                        <input type="submit" class="btn btn-primary pull-right margin-bottom-5px" value="Submit Order">
                    </div>
                    <div class="clearfix"></div>
                    <div class="padding-bottom-15"></div>
                </div>
            </section> <!--/#cart_items-->
            {!! Form::close() !!}
        </div>
    </div>
@endsection