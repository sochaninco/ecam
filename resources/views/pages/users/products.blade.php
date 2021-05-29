@extends('layouts.app')
@section('title','My Shop')
@section('my_shop','active')
@section('content')
    <section id="advertisement">
        <div class="container no-padding">
                <img alt="" src="{{asset('images/user-shop/'.$ShopImage)}}">
        </div>
    </section>
    <section>
        <div class="container white-bg">
            <div class="row">
                @include('pages.users.my_ecammall_menu_buy')
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">
                            My Products
                        </h2>
                            @foreach($products as $product)
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                                <a href="{{url('shop/product_detail/'.$product->id)}}">
                                                    <img src="{{asset('images/user-shop/product/'.$product->image)}}">
                                                </a>
                                                <h2>$ {{sprintf('%0.2f', $product->price)}}</h2>
                                                <p>{{substr($product->name,0,20)}}...</p>
                                                <a href="{{url('shop/product_detail/'.$product->id)}}" class="btn btn-default add-to-cart"><i aria-hidden="true" class="fa fa-info-circle"></i>View Detail</a>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i aria-hidden="true" class="fa fa-shopping-cart"></i>Add to Cart</a></li>
                                            <li><a href="#"><i aria-hidden="true" class="fa fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div><!--features_items-->
                    <ul class="pagination">
                        {!! $products->render() !!}
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection