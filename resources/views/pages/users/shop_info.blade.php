@extends('layouts.app')
@section('title','My ShopInformation')
@section('my_account','active')
@section('my_customer_order','active')
@section('my_customer_order_sub','active-sub')
@section('content')
    <div class="container">
        <div class="row white-bg">
            @include('pages.users.my_ecammall_menu_sell')
            <div class="col-sm-9 padding-right">
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <h2 class="title text-center">
                    My Shop Information
                </h2>
                <div class="col-lg-9">
                    {!! Form::model($ShopInfo,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                    <div class="form-group @if($errors->has('shop_name')) has-error @endif">
                        {!! Form::label('shop_name','Shop Name*',['class'=>' col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('shop_name',$ShopInfo->shop_name,['class'=>'form-control']) !!}
                            <input type="hidden" name="user_id" value="{{$ShopInfo->user_id}}">
                            <p class="help-block">{!! implode('<br/>', $errors->get('shop_name')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('shop_email')) has-error @endif">
                        {!! Form::label('shop_email','Shop Email',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('shop_email',$ShopInfo->shop_email,['class'=>'form-control']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('shop_email')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                        {!! Form::label('phone','Shop Phone',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('phone',null,['class'=>'form-control']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('phone')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('address','Shop Address',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('address',null,['class'=>'form-control']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('address')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('city')) has-error @endif">
                        {!! Form::label('city','City*',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('city',$location,null,['class'=>'form-control','placeholder'=>'Select any city..']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('city')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('website','Shop Website',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('website',null,['class'=>'form-control']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('website')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('description')) has-error @endif">
                        {!! Form::label('description','Description',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('description')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('shop_theme')) has-error @endif">
                        {!! Form::label('shop_theme','Shop Theme*',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('shop_theme',$shopTheme,null,['class'=>'form-control','placeholder'=>'Select any shop theme..']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('shop_theme')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group theme_info">
                    @if($ShopInfo->shop_theme != 0)

                            {!! Form::label('shop_theme_info','Theme Info',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                <?php
                                    $themeInfo = \App\ShopTheme::where('id',$ShopInfo->shop_theme)->first();
                                ?>
                                @if($themeInfo)
                                <table class="table table-responsive table-responsive table-striped">
                                    <tr>
                                        <td>Banner</td>
                                        <td>Banner Small</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{asset('images/theme-shop/'.$themeInfo->theme_banner)}}" class="img-responsive"></td>
                                        <td><img src="{{asset('images/theme-shop/'.$themeInfo->theme_banner_small)}}" class="img-responsive"> </td>
                                    </tr>
                                </table>
                                @endif
                            </div>
                    @endif
                    </div>
                    <div class="form-group @if($errors->has('shop_image')) has-error @endif">
                        {!! form::label('shop_image','Banner',['class'=>'control-label col-sm-4']) !!}
                        <div class="col-sm-8">
                            @if(!empty($ShopInfo->shop_image))
                                <div class="banner-shop">
                                    <div class="col-sm-11 col-md-11">
                                        <img src="{{asset('images/user-shop/'.$ShopInfo->shop_image)}}" class="img-responsive"><br>
                                    </div>
                                    <div class="col-sm-1 col-md-1">
                                        <i class="fa fa-trash delete_banner_shop" image-name="{{$ShopInfo->shop_image}}" style="cursor: pointer"></i>
                                    </div>
                                </div>
                            @endif
                            <input type="file" id="shop_image" accept="image/*" name="shop_image">
                            <p class="help-block">{!! implode('<br/>', $errors->get('shop_image')) !!}</p>
                            <p class="help-block">Image should be (1170px x 200px)</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('shop_image_small')) has-error @endif">
                        {!! form::label('shop_image_small','Banner Small',['class'=>'control-label col-sm-4']) !!}
                        <div class="col-sm-8">
                            @if(!empty($ShopInfo->shop_image_small))
                                <div class="banner-shop-small">
                                    <div class="col-sm-11 col-md-11">
                                        <img src="{{asset('images/user-shop/'.$ShopInfo->shop_image_small)}}" class="img-responsive"><br>
                                    </div>
                                    <div class="col-sm-1 col-md-1">
                                        <i class="fa fa-trash delete_banner_shop_small" image-name="{{$ShopInfo->shop_image_small}}" style="cursor: pointer"></i>
                                    </div>
                                </div>
                            @endif
                            <input type="file" id="shop_image_small" accept="image/*" name="shop_image_small">
                            <p class="help-block">{!! implode('<br/>', $errors->get('shop_image_small')) !!}</p>
                            <p class="help-block">Image should be (340px x 250px)</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('shop_logo')) has-error @endif">
                        {!! form::label('shop_logo','Shop Logo*',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            @if(!empty($ShopInfo->shop_logo))
                                <img src="{{asset('images/user-shop/'.$ShopInfo->shop_logo)}}" class="img-responsive"><br>
                            @endif
                            <input type="file" id="shop_logo" accept="image/*" name="shop_logo">
                            <p class="help-block">{!! implode('<br/>', $errors->get('shop_logo')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <input type="submit" class="btn btn-default" value="Update">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#shop_theme').change(function(){
                var themeId = $(this).val();
                $.ajax({
                    dataType: "html",
                    type: "GET",
                    evalScripts: true,
                    url: "/get_shop_theme_info/"+themeId,
                    success: function(themeInfo) {
                        $('.theme_info').html(themeInfo);

                    }
                });
            });
            $('.delete_banner_shop').click(function () {
               var banner = $(this).attr('image-name');
                alert('Do you want to delete shop banner ?');
                $.ajax({
                    dataType:"html",
                    type:"GET",
                    evalScripts: true,
                    url:"/delete_banner_shop/"+banner,
                    success:function () {
                        $('.banner-shop').remove();
                    }
                })
            });
            $('.delete_banner_shop_small').click(function () {
                var banner = $(this).attr('image-name');
                alert('Do you want to delete shop banner small ?');
                $.ajax({
                    dataType:"html",
                    type:"GET",
                    evalScripts: true,
                    url:"/delete_banner_shop_small/"+banner,
                    success:function () {
                        $('.banner-shop-small').remove();
                    }
                })
            });
        })
    </script>
@endsection