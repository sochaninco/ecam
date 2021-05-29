@extends('layouts.app')
@section('title','All Category')
@section('content')
    <div class="container white-bg" id="contact-page">
        <div class="bg">
            <div class="row">
                <div class="col-sm-9 col-xs-12 padding-5px">
                    <div class="contact-form hidden-xs">
                        <h2 class="title text-center">All Category</h2>
                        <?php  $index =0;?>
                        @foreach($categories as $key=>$category)
                            <?php
                                $subCategory = \App\Category::where('parent_id',$category->id)->get();
                            ?>
                        @if(count($subCategory) > 0)
                        <div class="col-sm-12 col-xs-6 title-categories padding-5px">
                            <h5 class="big-title"><a href="{{url('/products/'.$category->id)}}"> {{$category->name}}</a></h5>
                                <div class="sub-title-wrapper">
                                    <ul class="sub-item-cont">
                                    @foreach($subCategory as $sub)
                                        <li><a href="{{url('/products/category/'.$sub->id)}}"> {{$sub->name}}</a></li>
                                    @endforeach
                                    </ul>
                                </div>

                        </div>
                        @endif
                        <?php $index++;?>
                        @if($index%2 ==0)
                            <div class="clearfix"></div>
                        @endif
                        @endforeach
                    </div>
                    <div class="visible-xs contact-form">
                        <h2 class="title text-center">All Category</h2>
                        <?php  $index =0;?>
                        @foreach($categories as $key=>$category)
                            <?php
                            $subCategory = \App\Category::where('parent_id',$category->id)->get();
                            ?>
                            @if(count($subCategory) > 0)
                                <div class="col-sm-12 col-xs-12 title-categories padding-5px">
                                    <h5 class="big-title"><a href="{{url('/products/'.$category->id)}}"> {{$category->name}}</a></h5>
                                </div>
                                    <div class="sub-title-wrapper">
                                        <div class="sub-item-cont">
                                    @foreach($subCategory as $sub)
                                        <div class="col-xs-3 padding-5px text-center height-sub">
                                            <a href="{{url('/products/category/'.$sub->id)}}">
                                                {{--<img class="img-subcategory" src="http://ecammall.com/stock/assets/uploads/{{$sub->image}}">--}}
                                                <img src="{{asset('images/category/sub-small/'.$sub->logo)}}" class="img-subcategory">
                                                <br> {{$sub->name}}
                                            </a>
                                        </div>
                                    @endforeach
                                        </div>
                                    </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-3 hidden-xs">
                    <h2 class="title text-center"> Advertisement</h2>
                    <div class="shipping text-center"><!--shipping-->
                        <?php $Ads = \App\CategorySlide::where(['status'=>0,'slide_type'=>15])->get()?>
                        {{--<div id="advertise-carousel" data-interval="3000" data-type="multi" data-ride="carousel" class="carousel slide">
                            <div class="carousel-inner">--}}
                                @foreach($Ads as $key=>$Ad)
                                    {{--<div class="item @if($key == 0) active @endif">--}}
                                        <div class="col-sm-12 no-padding padding-bottom-15">
                                            @if(!empty($Ad->url))
                                                <a href="{{$Ad->url}}" target="_blank"> <img src="{{asset('images/home/'.$Ad->image)}}" class="img-responsive"></a>
                                            @elseif($Ad->category_id != 0)
                                                <a href="{{url('products/'.$Ad->category_id)}}"><img src="{{asset('images/home/'.$Ad->image)}}" class="img-responsive"></a>
                                            @else
                                                <a href="{{url('product_detail/'.$Ad->product_id)}}"> <img src="{{asset('images/home/'.$Ad->image)}}" class="img-responsive"></a>
                                            @endif
                                        </div>
                                    {{--</div>--}}
                                        <div class="clearfix"></div>
                                @endforeach
                            {{--</div>
                        </div>--}}
                    </div><!--/shipping-->
                </div>
            </div>
        </div>
    </div>
@endsection