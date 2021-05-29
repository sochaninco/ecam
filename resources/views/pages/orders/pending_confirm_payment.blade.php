@extends('layouts.app')
@section('title','eCamMall Confirm Payment')
@section('content')
    <div class="container">
        <div class="row white-bg">
            <div class="ecam-head-layout">
                <!-- <div class="site-logo"><a href="http://www.khbuy.net"><img src="http://img.khbuy.com/shop/common/mall_home_logo.png" class="pngFix"></a></div>
                 --><ul class="ecam-flow">
                    <li class=""><i class="step1"></i>
                        <p>My Cart</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
                    <li class=""><i class="step2"></i>
                        <p>Fill in and Confirm Order Info</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
                    <li class=""><i class="step3"></i>
                        <p>Submit Payment</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
                    <li class="current"><i class="step4"></i>
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
                <div class="container padding-5px">
                    <div class="register-req">
                        <p>This is your shipping address:</p>
                    </div><!--/register-req-->

                    <div class="shopper-informations">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="shopper-info">
                                    {!! Form::Open(['url'=>'pending_orders/order_success','method'=>'POST','files'=>true]) !!}
                                        <input type="text" value="{{$BuyerInfo->first_name}} {{$BuyerInfo->last_name}}" placeholder="Display Name" name="name" @if($errors->has('name')) style="border: 1px solid red" @endif readonly>
                                        <input type="text" value="{{$BuyerInfo->address}}" placeholder="Address" name="address" @if($errors->has('address')) style="border: 1px solid red" @endif readonly>
                                        <input type="text" value="{{$BuyerInfo->phone}}" placeholder="Phone Number" name="phone"@if($errors->has('phone')) style="border: 1px solid red" @endif readonly>
                                        {!! Form::select('city',$City,$BuyerInfo->city,['name'=>'city','readonly']) !!}
                                    {{--<a class="btn btn-primary" href="">Get Quotes</a>--}}
                                    {{--<a class="btn btn-primary" href="">Continue</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="register-req">
                        <p>2.Review and confirm your order:</p>
                    </div>
                    <div class="table-responsive cart_info">
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
                            <tbody>
                            @foreach($Orders as $key=>$order)
                                <?php
                                    if($order->product_from == 0){
                                        $ProductName = \App\ShopProduct::pluck('name','id');
                                        $ProductImage = \App\ShopProduct::pluck('image','id');
                                    }else{
                                        $ProductName = \App\Product::pluck('name','id');
                                        $ProductImage = \App\Product::pluck('image','id');
                                    }
                                ?>
                            <tr class="cart_check">
                                <td>
                                    <a href="">
                                        @if($order->product_from == 0)
                                            <?php
                                            $firstImage = \App\Thumbnails::where('product_id',$order->product_id)->first();
                                            $imageName = isset($firstImage->image)?$firstImage->image:$order->image;
                                            ?>
                                            <img alt="" src="{{asset('images/thumbnails/shop/'.$imageName)}}" width="auto" height="80px">
                                            <input type="hidden" name="orders[{{$key}}][product_from]" value="0">
                                        @else
                                            <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$order->image}}" width="auto" height="80px">
                                            <input type="hidden" name="orders[{{$key}}][product_from]" value="1">
                                        @endif
                                        {{--@if($order->product_from == 0)
                                            <img alt="" src="{{asset('images/user-shop/product/'.$ProductImage[$order->product_id])}}" width="auto" height="80px">
                                            <input type="hidden" name="orders[{{$key}}][product_from]" value="0">
                                        @else
                                            <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$ProductImage[$order->product_id]}}" width="auto" height="80px">
                                            <input type="hidden" name="orders[{{$key}}][product_from]" value="1">
                                        @endif--}}
                                    </a>
                                </td>
                                <td width="50%">
                                    <p><a href="">{{$ProductName[$order->product_id]}}</a></p>
                                </td>
                                <td class="cart_price" value="{{$order->price}}">
                                    <p>$ {{$order->price}}</p>
                                    <input type="hidden" name="orders[{{$key}}][product_id]" value="{{$order->product_id}}">
                                    <input type="hidden" name="orders[{{$key}}][price]" value="{{$order->price}}">
                                    <input type="hidden" name="orders[{{$key}}][id]" value="{{$order->id}}">
                                    <input type="hidden" name="orders[{{$key}}][product_order_id]" value="{{$order->product_order_id}}">
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        {{--<a class="cart_quantity_up" style="cursor: pointer"> + </a>--}}
                                        <input class="cart_quantity_input" type="text" name="orders[{{$key}}][qty]" value="{{$order->qty}}" autocomplete="off" size="2" readonly>
                                        {{--<a class="cart_quantity_down" style="cursor: pointer"> - </a>--}}
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">$ {{$order->amount}}</p>
                                    <input type="hidden" name="orders[{{$key}}][amount]" value="{{$order->amount}}" class="cart_total_price_input">
                                </td>
                                <td class="cart_delete">
                                    <a class="pending_order_delete" style="cursor: pointer" id="{{$order->id}}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">Buyer Message <input type="text" name="buyer_message" value="" maxlength="100" size="50"></td>
                            </tr>
                            {{--<tr>--}}
                                {{--<td colspan="4">&nbsp;</td>--}}
                                {{--<td colspan="2">--}}
                                    {{--<table class="table table-condensed total-result">--}}
                                        {{--<tbody>--}}
                                        {{--<tr class="shipping-cost">--}}
                                            {{--<td>Shipping</td>--}}
                                            {{--<td>$ </td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td>Amount</td>--}}
                                            {{--<td>$ <span><input type="text" class="amount" value="" name="amount" size="5" readonly></span></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td>Discount</td>--}}
                                            {{--<td>$ </td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td>Total</td>--}}
                                            {{--<td><span>$ <input type="text" class="total" value="" name="total" size="5" readonly> </span></td>--}}
                                        {{--</tr>--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="register-req">
                        <p>3.Payment Method:</p>
                    </div>
                    @include('pages.orders.payment_method')
                    <input type="submit" class="btn btn-primary pull-right" value="Check Out">
                </div>
            </section> <!--/#cart_items-->
            </form>
        </div>
    </div>
@endsection