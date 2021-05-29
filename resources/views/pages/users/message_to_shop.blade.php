@extends('layouts.app')
@section('title','My eCamMall')
@section('my_order','active')
@section('content')
    <div class="container">
        <div class="row white-bg">
            @include('pages.users.my_ecammall_menu_buy')
            <div class="col-sm-9 padding-right">
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <h2 class="title text-center">
                    Message to Shop
                </h2>
                <div class="col-lg-12">
                    {!! Form::open(['method'=>'post','name'=>'contact-form','class'=>'contact-form row']) !!}
                        <div class="form-group col-md-6">
                            <input type="text" placeholder="Name" required="required" class="form-control" name="customer_name" value="{{$shop->shop_name}}">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" placeholder="Email" required="required" class="form-control" name="email" value="{{$shop->shop_email}}">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" placeholder="Subject" required="required" class="form-control" name="title" value="More detail about this product">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea placeholder="Your Message Here" rows="8" class="form-control" required="required" id="message" name="description">
                                Dear {{$shop->shop_name}},
                                <br>
                                  I am really interest with this product : <b>"{{$product->name}}"</b>,
                                  Can u give me more detail ?
                                <br>
                                  Please me via my number  : {{$customer->phone}} or my email : {{$customer->email}}
                                <br>
                                  Thank
                                <br>
                                  Best Regards
                                <br>
                                  <b>{{$customer->last_name}}</b>
                            </textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" value="Submit" class="btn btn-primary pull-right" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection