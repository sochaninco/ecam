@extends('layouts.app')
@section('title','eCamMall My Cart')
@section('content')
    <div class="container">
        <div class="row white-bg">
            <div class="ecam-head-layout">
                <!-- <div class="site-logo"><a href="http://www.khbuy.net"><img src="http://img.khbuy.com/shop/common/mall_home_logo.png" class="pngFix"></a></div>
                 --><ul class="ecam-flow">
                    <li class="current"><i class="step1"></i>
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
                <div class="container padding-5px">
                    <div class="register-req">
                        <p>My cart</p>
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
                                @if(Session::has('cart'))
                                    <?php $key = 0;?>
                                    @foreach($products as $product)
                                        <?php
                                        $firstImage = \App\Thumbnails::where('product_id',$product['id'])->first();
                                        $imageName = isset($firstImage->image)?$firstImage->image:$product['item']['image'];
                                        ?>
                                        <tr class="cart_check">
                                            <td>
                                                @if($product['product_from'] == 0)
                                                    <a href="{{url('shop/product_detail/'.$product['item']['id'])}}">
                                                        <img src="{{asset('images/thumbnails/shop/'.$imageName)}}" alt="" width="auto" height="80px"/>
                                                        <input type="hidden" name="orders[{{$key}}][product_from]" value="user">
                                                        @else
                                                            <a href="{{url('product_detail/'.$product['item']['id'])}}">
                                                                <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$product['item']['image']}}" width="auto" height="80px">
                                                                <input type="hidden" name="orders[{{$key}}][product_from]" value="admin">
                                                                @endif
                                                            </a>
                                            </td>
                                            <td width="50%">
                                                <p><a href="">{{substr($product['item']['name'],0,30)}}</a></p>
                                            </td>
                                            <td class="cart_price" id="{{$product['price']}}">
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
                                        <?php $key++;?>
                                    @endforeach
                                @else
                                    <td>Cart Empty</td>
                                @endif
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
                            @if(Session::has('cart'))
                                <?php $key = 0;?>
                                @foreach($products as $product)
                                    <?php
                                    $firstImage = \App\Thumbnails::where('product_id',$product['id'])->first();
                                    $imageName = isset($firstImage->image)?$firstImage->image:$product['item']['image'];
                                    ?>
                                    <tbody class="cart_check">
                                    <tr>
                                        <td rowspan="3">
                                            @if($product['product_from'] == 0)
                                                <a href="{{url('shop/product_detail/'.$product['item']['id'])}}">
                                                    <img src="{{asset('images/thumbnails/shop/'.$imageName)}}" alt="" width="auto" height="80px"/>
                                                    <input type="hidden" name="orders[{{$key}}][product_from]" value="user">
                                                </a>
                                            @else
                                                <a href="{{url('product_detail/'.$product['item']['id'])}}">
                                                    <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$product['item']['image']}}" width="auto" height="80px">
                                                    <input type="hidden" name="orders[{{$key}}][product_from]" value="admin">
                                                    @endif
                                                </a>
                                        </td>
                                        <td colspan="3">
                                            <p><a href="">{{substr($product['item']['name'],0,30)}}</a></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="cart_price" id="{{$product['price']}}">
                                            <p>$ {{$product['price']}}</p>
                                            <input type="hidden" name="orders[{{$key}}][product_id]" value="{{$product['id']}}">
                                            <input type="hidden" name="orders[{{$key}}][price]" value="{{$product['price']}}">
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <input class="cart_quantity_input" type="text" name="orders[{{$key}}][qty]" value="{{$product['quantity']}}" autocomplete="off" size="2" readonly="readonly">
                                            </div>
                                        </td>
                                    <tr>
                                        <td class="cart_total" width="30%">
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
                            </tbody>
                        </table>
                    </div>
                    <a href="{{url('shopping_cart/buy_now_from_cart')}}" class="btn btn-primary pull-right">Check Out</a>
                </div>
            </section> <!--/#cart_items-->
            </form>
        </div>
    </div>
@endsection