@extends('layouts.app')
@section('title','eCamMall Order Success')
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
                    <li><i class="" class="step2"></i>
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
                    <li class="current"><i class="step5"></i>
                        <p>Order Successfully</p>
                        <sub></sub>
                        <div class="hr"></div>
                    </li>
                </ul>
            </div>
            <section id="cart_items">
                <div class="container padding-5px">
                    @if (Session::has('flash_notification.message'))
                        <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                            {{ Session::get('flash_notification.message') }}
                        </div>
                    @endif
                    <div class="register-req">
                        <p>Congrate your order now successfully,<a href="{{url('em-user/'.Auth::user()->id.'/my_orders')}}">My Order History</a> </p>
                    </div><!--/register-req-->
                </div>
            </section> <!--/#cart_items-->
            </form>
        </div>
    </div>
@endsection