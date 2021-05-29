@extends('layouts.app')
@section('title','eCamMall Order Success')
@section('content')
    <div class="container">
        <div class="row">
            <div class="ecam-head-layout white-bg">
                <!-- <div class="site-logo"><a href="http://www.khbuy.net"><img src="http://img.khbuy.com/shop/common/mall_home_logo.png" class="pngFix"></a></div>
                 --><ul class="ecam-flow">
                    <li class=""><i class="step1"></i>
                        <p>My Cart</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
                    <li><i class="" class="step2"></i>
                        <p>Fill in and Confirm Order Info</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
                    <li class="current"><i class="step3"></i>
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
                    <div class="container col-sm-12 white-bg">
                        <div class="register-req">

                            <p>Review and confirm your order:</p>

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

                                    <tbody>

                                    @foreach($Orders->ProductOrderDetail as $key=>$order)

                                        <?php

                                        if($order->product_from == 0){

                                            $firstImage = \App\Thumbnails::where('product_id',$order->product_id)->first();

                                            $imageName = isset($firstImage->image)?$firstImage->image:$product['item']['image'];

                                            $ProductName = \App\ShopProduct::pluck('name','id');

                                        }else{

                                            $ProductName = \App\Product::pluck('name','id');

                                            $ProductImage = \App\Product::pluck('image','id');

                                        }

                                        ?>

                                        <tr class="cart_check">

                                            <td>

                                                <a href="">

                                                    @if($order->product_from == 0)

                                                        <img alt="" src="{{asset('images/thumbnails/shop/'.$imageName)}}" width="auto" height="80px">

                                                        <input type="hidden" name="orders[{{$key}}][product_from]" value="user">

                                                    @else

                                                        <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$ProductImage[$order->product_id]}}" width="auto" height="80px">

                                                        <input type="hidden" name="orders[{{$key}}][product_from]" value="admin">

                                                    @endif

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
                                                <a class="cart_quantity_delete_confirm" style="cursor: pointer"  id="{{$order->product_id}}" orderId = "{{$order->product_order_id}}"><i class="fa fa-times"></i></a>
                                            </td>

                                        </tr>

                                    @endforeach

                                    <tr>

                                        <td colspan="4">Buyer Message <input type="text" name="buyer_message" value="{{$Orders->buyer_message}}" maxlength="100" size="50"></td>

                                    </tr>

                                    <tr>

                                        <td colspan="4">&nbsp;</td>

                                        <td colspan="2">

                                            <table class="table table-condensed total-result">

                                                <tbody>

                                                <tr class="shipping-cost">

                                                    <td>Shipping</td>

                                                    <td>$ {{$Orders->shipping_cost}}</td>

                                                </tr>

                                                <tr>

                                                    <td>Amount</td>

                                                    <td>$ <span><input type="text" class="amount" value="{{$Orders->amount}}" name="amount" size="5" readonly></span></td>

                                                </tr>

                                                <tr>

                                                    <td>Discount</td>

                                                    <td>$ {{$Orders->discount}}</td>

                                                </tr>

                                                <tr>

                                                    <td>Total</td>

                                                    <td><span>$ <input type="text" class="total" value="{{$Orders->total}}" name="total" size="5" readonly> </span></td>

                                                </tr>

                                                </tbody></table>

                                        </td>

                                    </tr>

                                    </tbody>

                                </table>
                            </div>
                            <table class="table table-condensed visible-xs">

                                <thead>

                                <tr class="cart_menu">

                                    <td class="image">Item</td>

                                    <td class="description" colspan="2"></td>

                                </tr>

                                </thead>

                                @foreach($Orders->ProductOrderDetail as $key=>$order)

                                    <?php

                                    if($order->product_from == 0){

                                        $firstImage = \App\Thumbnails::where('product_id',$order->product_id)->first();

                                        $imageName = isset($firstImage->image)?$firstImage->image:$product['item']['image'];

                                        $ProductName = \App\ShopProduct::pluck('name','id');

                                    }else{

                                        $ProductName = \App\Product::pluck('name','id');

                                        $ProductImage = \App\Product::pluck('image','id');

                                    }

                                    ?>

                                    <tbody class="cart_check">

                                    <tr>

                                        <td rowspan="3" width="10%">

                                            <a href="">

                                                @if($order->product_from == 0)

                                                    <img alt="" src="{{asset('images/thumbnails/shop/'.$imageName)}}" width="auto" height="80px">

                                                    <input type="hidden" name="orders[{{$key}}][product_from]" value="user">

                                                @else

                                                    <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$ProductImage[$order->product_id]}}" width="auto" height="80px">

                                                    <input type="hidden" name="orders[{{$key}}][product_from]" value="admin">

                                                @endif

                                            </a>

                                        </td>

                                        <td colspan="3">

                                            <p><a href="">{{$ProductName[$order->product_id]}}</a></p>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td width="30%" class="cart_price" value="{{$order->price}}">

                                            <p>$ {{$order->price}}</p>

                                            <input type="hidden" name="orders[{{$key}}][product_id]" value="{{$order->product_id}}">

                                            <input type="hidden" name="orders[{{$key}}][price]" value="{{$order->price}}">

                                            <input type="hidden" name="orders[{{$key}}][id]" value="{{$order->id}}">

                                        </td>

                                        <td class="cart_quantity">

                                            <div class="cart_quantity_button">

                                                {{--<a class="cart_quantity_up" style="cursor: pointer"> + </a>--}}

                                                <input class="cart_quantity_input" type="text" name="orders[{{$key}}][qty]" value="{{$order->qty}}" autocomplete="off" size="2" readonly>

                                                {{--<a class="cart_quantity_down" style="cursor: pointer"> - </a>--}}

                                            </div>

                                        </td>

                                    <tr>

                                        <td class="cart_total">

                                            <p class="cart_total_price">$ {{$order->amount}}</p>

                                            <input type="hidden" name="orders[{{$key}}][amount]" value="{{$order->amount}}" class="cart_total_price_input">

                                        </td>

                                        <td class="cart_delete">

                                            <a class="cart_quantity_delete_confirm" style="cursor: pointer" id="{{$order->product_id}}" orderId = "{{$order->product_order_id}}"><i class="fa fa-times"></i></a>

                                        </td>

                                    </tr>

                                    </tbody>

                                @endforeach

                                <tr>

                                    <td colspan="4">Buyer Message <input type="text" name="buyer_message" value="{{$Orders->buyer_message}}" maxlength="100" size="25"></td>

                                </tr>

                                <tr>

                                    <td colspan="2">

                                        <table class="table table-condensed total-result">

                                            <tbody>

                                            <tr class="shipping-cost">

                                                <td>Shipping</td>

                                                <td>$ {{$Orders->shipping_cost}}</td>

                                            </tr>

                                            <tr>

                                                <td>Amount</td>

                                                <td>$ <span><input type="text" class="amount" value="{{$Orders->amount}}" name="amount" size="5" readonly></span></td>

                                            </tr>

                                            <tr>

                                                <td>Discount</td>

                                                <td>$ {{$Orders->discount}}</td>

                                            </tr>

                                            <tr>

                                                <td>Total</td>

                                                <td><span>$ <input type="text" class="total" value="{{$Orders->total}}" name="total" size="5" readonly> </span></td>

                                            </tr>

                                            </tbody></table>

                                    </td>

                                </tr>

                                </tbody>

                            </table>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="padding-bottom-15"></div>
                    <div class="container white-bg padding-bottom-15 no-padding">
                        <div class="col-sm-6">
                            <div class="register-req">
                                <p>Payment Method:</p>

                            </div>
                            <div class="payment-options white-bg">
                                <?php
                                $paymentMethods = \App\PaymentMethod::where('status',0)->get();
                                ?>
                                <span>
                                    <label>
                                        <input type="radio" value="0" name="payment_method" class="payment_method"> COD (Cash On Delivery)
                                    </label>
                                </span>
                                @foreach($paymentMethods as $method)
                                    <span>
                                        <label>
                                            <input type="radio" value="{{$method->id}}" class="payment_method" name="payment_method" @if($method->id == $Orders->payment_method) checked @endif>@if(!empty($method->logo))
                                                <img src="{{asset('images/payment/'.$method->logo)}}">
                                            @endif {{$method->name}}
                                        </label>
                                    </span>
                                @endforeach

                            </div>
                            <div class="choose-payment-method">

                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="buyer-payment-info">


                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="padding-bottom-15"></div>
                </div>
                <div class="clearfix"></div>
            </section> <!--/#cart_items-->
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.buyer-payment-info').hide();
            var paymentDefault = '{{$Orders->payment_method}}';
            var orderId = '{{$order_id}}';
            if(paymentDefault == 6){
                ajaxBuyerPaymentInfo(paymentDefault,orderId);
                ajaxChoosePayment(paymentDefault);
            }else{
                ajaxBuyerPaymentInfo(paymentDefault,orderId);
                ajaxChoosePayment(paymentDefault);
            }

            $('.payment_method').click(function () {
                var paymentMethod = $(this).val();
                var orderId = '{{$order_id}}';
//                alert(paymentMethod);
                if(paymentMethod == 0){
                    $('.choose-payment-method').hide();
                }else{
                    ajaxChoosePayment(paymentMethod);
                    ajaxBuyerPaymentInfo(paymentMethod,orderId);
                }

            })

            function ajaxChoosePayment(paymentMethod) {
                $.ajax({
                    dataType: "html",
                    type: "GET",
                    evalScripts: true,
                    url: "/submit_payment/choose_method/"+paymentMethod,
                    success: function(result) {
                        $('.choose-payment-method').show();
                        $('.choose-payment-method').html(result);
                    }
                });
            }
            function ajaxBuyerPaymentInfo(paymentMethod,orderId) {
                $.ajax({
                    dataType: "html",
                    type: "GET",
                    evalScripts: true,
                    url: "/submit_payment/buyer_payment_info/"+paymentMethod+"/"+orderId,
                    success: function(result) {
                        $('.buyer-payment-info').show();
                        $('.buyer-payment-info').html(result);
                    }
                });
            }
        });
    </script>
@endsection