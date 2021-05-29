@extends('layouts.app')
@section('title','Membership')
@section('membership_list','active')
@section('content')
    <div class="container">
        <div class="row white-bg">
            <div class="container no-padding">
                <?php
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>11,'page'=>3])->get();
                ?>
                <div id="brand-zone-item-carousel" data-interval="300000" data-type="multi" data-ride="carousel" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach($Product_banner as $key=>$banner)
                            <div class="item @if($key == 0)active @endif ">
                                <a href="{{url('')}}" >
                                    <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if($membership)
            <div class="col-sm-12 padding-5px">
                    <h2 class="title text-center">
                        My Membership Account
                    </h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="list-product">
                            <thead>
                            <tr>
                                <th rowspan="2"> Your Transaction</th>
                                <th rowspan="2"> Post Product Up to</th>
                                <th rowspan="2"> Auto Renew</th>
                                <th rowspan="2"> Renew</th>
                                <th rowspan="2"> Featured Ads</th>
                                <th colspan="3"> Post Advertisement</th>
                            </tr>
                            <tr>
                                <th> General ads</th>
                                <th> Specific ads</th>
                                <th> Custom ads</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $package = \App\Packages::where('id',1)->first();
                            ?>
                            <tr>
                                <td> {{$package->name}}</td>
                                <td>{{$package->no_product}}</td>
                                <td>{{$package->auto_renew}}</td>
                                <td>{{$package->renew}}</td>
                                <td>{{$package->featured_ads}}</td>
                                <td>{{$package->ads_general}}</td>
                                <td>{{$package->ads_specific}}</td>
                                <td>{{$package->ads_custom}}</td>
                            </tr>
                            @foreach($tranInfo as $tran)
                                <?php
                                $package = \App\Packages::where('id',$tran->package_id)->first();
                                ?>
                                <tr>
                                    <td> {{$package->name}} ({{$tran->created_at->format('Y-m-d')}})</td>
                                    <td>{{$package->no_product}}</td>
                                    <td>{{$package->auto_renew}}</td>
                                    <td>{{$package->renew}}</td>
                                    <td>{{$package->featured_ads}}</td>
                                    <td>{{$package->ads_general}}</td>
                                    <td>{{$package->ads_specific}}</td>
                                    <td>{{$package->ads_custom}}</td>
                                </tr>
                            @endforeach
                            <tr bgcolor="#f5f5dc">
                                <th align="center"> Your Balance <br>(Expired Date : {{$membership->package_expired_date}})</th>
                                <th>{{$membership->no_product}}</th>
                                <th>{{$membership->auto_renew}}</th>
                                <th>{{$membership->renew}}</th>
                                <th>{{$membership->featured_ads}}</th>
                                <th>{{$membership->ads_general}}</th>
                                <th>{{$membership->ads_specific}}</th>
                                <th>{{$membership->ads_custom}}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
            @endif
            <div class="col-sm-12 padding-5px">
                @foreach($packages as $package)
                <div class="col-xs-6 col-sm-3 padding-5px">
                    <div class="pricing-table">
                        <h3 class="pricing-title">{{$package->name}}</h3>
                        <div class="price">${{$package->price}}<sup>/ {{$package->package_term}}</sup></div>
                        <ul class="table-list">
                            <li>{{$package->no_product}} <span>Product Upload</span></li>
                            <li>{{$package->auto_renew}} <span>Auto Renew</span></li>
                            <li>{{$package->renew}} <span>Renew</span></li>
                            <li>{{$package->featured_ads}} <span>Featured Ads</span></li>
                            <li>{{$package->ads_general}} <span>Ads General Product</span></li>
                            <li>{{$package->ads_specific}} <span>Ads Specific Product</span></li>
                            <li>{{$package->ads_custom}}<span>Ads Customer Product</span></li>
                        </ul>
                        <!-- Contratar / Comprar -->
                        <div class="table-buy">
                            <p>${{$package->price}}<sup>/ {{$package->package_term}}</sup></p>
                            @if($package->id == 1)
                                <a class="pricing-action">Registered</a>
                            @else
                                <a href="{{url('em-user/'.$userId.'/membership/'.$package->id)}}" class="pricing-action">SignUp</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection