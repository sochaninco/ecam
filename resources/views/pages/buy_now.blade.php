@extends('layouts.app')
@section('title','eCamMall Buy Now')
@section('content')
    <div class="container">
        <div class="row white-bg">
            <section id="cart_items">
                <div class="container">
                    <div class="register-req">
                        <p>1.Select your shipping information:</p>
                    </div><!--/register-req-->

                    <div class="shopper-informations">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="shopper-info">
                                    <form>
                                        <input type="text" value="{{$BuyerInfo->name}}" placeholder="Display Name">
                                        <input type="text" value="{{$BuyerInfo->address}}" placeholder="Address">
                                        <input type="text" value="{{$BuyerInfo->phone}}" placeholder="Phone Number">
                                        {!! Form::select('city',$City,$BuyerInfo->city) !!}
                                    </form>
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
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="{{asset('images/shop/product9.jpg')}}" alt="" width="auto" height="80px"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">ABCD</a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>$59</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" href=""> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">$59</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="register-req">
                        <p>3.Payment Method:</p>
                    </div>
                    <div class="payment-options">
                        <span>
                            <label><input type="radio" value="0" name="payment_method"> COD (Cash On Delivery)</label>
                        </span>
                            <span>
                            <label><input type="radio" value="1" name="payment_method"> Pay with <img src="{{asset('images/ecammall/wing-pay.png')}}" </label>
                        </span>
                    </div>
                    <a class="btn btn-primary pull-right" href="">Confirm &Pay</a>
                </div>
            </section> <!--/#cart_items-->
        </div>
    </div>
@endsection