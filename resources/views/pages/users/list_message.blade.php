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
                        My Message Center
                    </h2>
                    <div class="col-lg-12 no-padding">
                        <div class="category-tab">
                            <div class="col-sm-12 no-padding">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#buyer">Buyer Role</a></li>
                                    <li><a data-toggle="tab" href="#shopOwner">Shop Owner</a></li>
                                    {{--<li class="active"><a data-toggle="tab" href="#tag">Related</a></li>--}}
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div id="buyer" class="tab-pane fade active in">
                                    <div class="col-sm-12 no-padding">
                                        <h2 class="title text-center">
                                            Message To You
                                        </h2>
                                        <div class="col-lg-12 no-padding">
                                            <div class="col-sm-12 no-padding">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="list-product">
                                                        <thead>
                                                        <tr>
                                                            <th> Form Shop</th>
                                                            <th> Title</th>
                                                            {{--<th> Product Name</th>--}}
                                                            <th> Description</th>
                                                            {{--<th class="nosort">Action</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($messageToUserShopOwner as $message)
                                                            <tr>
                                                                <td>{{$shop[$message->shop_id]}}</td>
                                                                <td>{{$message->title}}</td>
                                                                {{--<td>{{$message->product_id}}</td>--}}
                                                                <td>{!! $message->description !!}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="title text-center">
                                            Message To Shop
                                        </h2>
                                        <div class="col-lg-12 no-padding">
                                            <div class="col-sm-12 no-padding">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="list-product">
                                                        <thead>
                                                        <tr>
                                                            <th> To Shop</th>
                                                            <th> Title</th>
                                                            {{--<th> Product Name</th>--}}
                                                            <th> Description</th>
                                                            {{--<th class="nosort">Action</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($messageFromUserShopOwner as $message)
                                                            <tr>
                                                                <td>{{$shop[$message->shop_id]}}</td>
                                                                <td>{{$message->title}}</td>
                                                                {{--<td>{{$message->product_id}}</td>--}}
                                                                <td>{!! $message->description !!}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="shopOwner" class="tab-pane fade">
                                    <div class="col-sm-12 no-padding">
                                        <h2 class="title text-center">
                                            Message From Shop
                                        </h2>
                                        <div class="col-lg-12 no-padding">
                                            <div class="col-sm-12 no-padding">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="list-product">
                                                        <thead>
                                                        <tr>
                                                            <th> Form Shop</th>
                                                            <th> Title</th>
                                                            {{--<th> Product Name</th>--}}
                                                            <th> Description</th>
                                                            {{--<th class="nosort">Action</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($messageToUserShopOwner as $message)
                                                            <tr>
                                                                <td>{{$shop[$message->shop_id]}}</td>
                                                                <td>{{$message->title}}</td>
                                                                {{--<td>{{$message->product_id}}</td>--}}
                                                                <td>{!! $message->description !!}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="title text-center">
                                            Message To Shop
                                        </h2>
                                        <div class="col-lg-12 no-padding">
                                            <div class="col-sm-12 no-padding">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="list-product">
                                                        <thead>
                                                        <tr>
                                                            <th> To Shop</th>
                                                            <th> Title</th>
                                                            {{--<th> Product Name</th>--}}
                                                            <th> Description</th>
                                                            {{--<th class="nosort">Action</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($messageFromUserBuyerRole as $message)
                                                            <tr>
                                                                <td>{{$shop[$message->shop_id]}}</td>
                                                                <td>{{$message->title}}</td>
                                                                {{--<td>{{$message->product_id}}</td>--}}
                                                                <td>{!! $message->description !!}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection