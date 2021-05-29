@extends('layouts.app')
@section('title','eCamMall Buy Now')
@section('content')
    <div class="container">
        <div class="row">
            <div class="ecam-head-layout white-bg">
                <ul class="ecam-flow">
                    <li class=""><i class="step1"></i>
                        <p>My Cart</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
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
                            <div class="shopper-informations">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="shopper-info">
                                            {!! Form::Open(["url"=>'products/'.$product->id.'/order','method'=>'POST','files'=>true]) !!}
                                            <input type="text" value="{{$BuyerInfo->first_name}} {{$BuyerInfo->last_name}}" placeholder="Display Name" name="name" @if($errors->has('name')) style="border: 1px solid red" @endif>
                                            <input type="text" value="{{$BuyerInfo->address}}" placeholder="Address" name="address" @if($errors->has('address')) style="border: 1px solid red" @endif>
                                            <input type="text" value="{{$BuyerInfo->phone}}" placeholder="Phone Number" name="phone"@if($errors->has('phone')) style="border: 1px solid red" @endif>
                                            {!! Form::select('city',$City,$BuyerInfo->city,['name'=>'city']) !!}
                                            {{--<a class="btn btn-primary" href="">Get Quotes</a>--}}
                                            {{--<a class="btn btn-primary" href="">Continue</a>--}}
                                        </div>
                                    </div>
                                    {{--<div class="col-sm-5 clearfix">
                                        <div class="bill-to">
                                            <p>Bill To</p>
                                            <div class="form-one">
                                                <form>
                                                    <input type="text" placeholder="Company Name">
                                                    <input type="text" placeholder="Email*">
                                                    <input type="text" placeholder="Title">
                                                    <input type="text" placeholder="First Name *">
                                                    <input type="text" placeholder="Middle Name">
                                                    <input type="text" placeholder="Last Name *">
                                                    <input type="text" placeholder="Address 1 *">
                                                    <input type="text" placeholder="Address 2">
                                                </form>
                                            </div>
                                            <div class="form-two">
                                                <form>
                                                    <input type="text" placeholder="Zip / Postal Code *">
                                                    <select>
                                                        <option>-- Country --</option>
                                                        <option>United States</option>
                                                        <option>Bangladesh</option>
                                                        <option>UK</option>
                                                        <option>India</option>
                                                        <option>Pakistan</option>
                                                        <option>Ucrane</option>
                                                        <option>Canada</option>
                                                        <option>Dubai</option>
                                                    </select>
                                                    <select>
                                                        <option>-- State / Province / Region --</option>
                                                        <option>United States</option>
                                                        <option>Bangladesh</option>
                                                        <option>UK</option>
                                                        <option>India</option>
                                                        <option>Pakistan</option>
                                                        <option>Ucrane</option>
                                                        <option>Canada</option>
                                                        <option>Dubai</option>
                                                    </select>
                                                    <input type="password" placeholder="Confirm password">
                                                    <input type="text" placeholder="Phone *">
                                                    <input type="text" placeholder="Mobile Phone">
                                                    <input type="text" placeholder="Fax">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="order-message">
                                            <p>Shipping Order</p>
                                            <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                                            <label><input type="checkbox"> Shipping to bill address</label>
                                        </div>
                                    </div>--}}
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
                        <div class="table-responsive cart_info ">
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
                                    <tr class="cart_check">
                                        <td>
                                            <a href="">
                                                @if(\Request::is('shop/products/*'))
                                                    <?php
                                                    $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                                    ?>
                                                    <img alt="" src="{{asset('images/thumbnails/shop/'.$imageName)}}" width="auto" height="80px">
                                                    <input type="hidden" name="orders[0][product_from]" value="user">
                                                @else
                                                    <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$product->image}}" width="auto" height="80px">
                                                    <input type="hidden" name="orders[0][product_from]" value="admin">
                                                @endif
                                            </a>
                                        </td>
                                        <td width="50%">
                                            <p><a href="">{{$product->name}}</a></p>
                                        </td>
                                        <td class="cart_price" value="{{$product->price}}" id="{{$product->price}}">
                                            <p>$ {{$product->price}}</p>
                                            <input type="hidden" name="orders[0][product_id]" value="{{$product->id}}">
                                            <input type="hidden" name="orders[0][price]" value="{{$product->price}}">
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <a class="cart_quantity_up" style="cursor: pointer"> + </a>
                                                <input class="cart_quantity_input" type="text" name="orders[0][qty]" value="{{$quantity_order}}" readonly autocomplete="off" size="2">
                                                <a class="cart_quantity_down" style="cursor: pointer"> - </a>
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">$ {{$product->price}}</p>
                                            <input type="hidden" name="orders[0][amount]" value="{{$product->price}}" class="cart_total_price_input">
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete" style="cursor: pointer"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Buyer Message <input type="text" name="buyer_message" maxlength="100" size="50"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <table class="table table-condensed visible-xs">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Item</td>
                                    <td class="description" colspan="2"> Description</td>
                                </tr>
                                </thead>
                                <tbody class="cart_check">
                                <tr>
                                    <td rowspan="3">
                                        <a href="">
                                            @if(\Request::is('shop/products/*'))
                                                <?php
                                                $firstImage = \App\Thumbnails::where('product_id',$product->id)->first();
                                                $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                                                ?>
                                                <img alt="" src="{{asset('images/thumbnails/shop/'.$imageName)}}" width="auto" height="80px">
                                                <input type="hidden" name="orders[0][product_from]" value="user">
                                            @else
                                                <img alt="" src="http://ecammall.com/stock/assets/uploads/{{$product->image}}" width="auto" height="80px">
                                                <input type="hidden" name="orders[0][product_from]" value="admin">
                                            @endif
                                        </a>
                                    </td>
                                    <td width="90%" colspan="2">
                                        <p><a href="">{{$product->name}}</a></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_price" value="{{$product->price}}" id="{{$product->price}}" width="20%">
                                        <p>$ {{$product->price}}</p>
                                        <input type="hidden" name="orders[0][product_id]" value="{{$product->id}}">
                                        <input type="hidden" name="orders[0][price]" value="{{$product->price}}">
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <a class="cart_quantity_up" style="cursor: pointer"> + </a>
                                            <input class="cart_quantity_input" type="text" name="orders[0][qty]" value="{{$quantity_order}}" readonly autocomplete="off" size="2">
                                            <a class="cart_quantity_down" style="cursor: pointer"> - </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total">
                                        <p class="cart_total_price">$ {{$product->price}}</p>
                                        <input type="hidden" name="orders[0][amount]" value="{{$product->price}}" class="cart_total_price_input">
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" style="cursor: pointer"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                                <tr>
                                    <td colspan="4">Buyer Message <input type="text" name="buyer_message" maxlength="100" size="50"></td>
                                </tr>
                            </table>
                        </div>
                        <input type="submit" class="btn btn-primary pull-right margin-bottom-5px" value="Submit Order">
                    </div>
                    <div class="clearfix"></div>
                    <div class="padding-bottom-15"></div>
                </div>
            </section> <!--/#cart_items-->
            </form>
        </div>
    </div>
@endsection