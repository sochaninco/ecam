@extends('layouts.app')
@section('title','My Shop')
@section('my_new_shop','active')
@section('my_customer_order','active')
@section('content')
    <?php
    $base_url = 'http://ecammall.com/';
    ?>
    <div class="container">
        <div class="row white-bg">
            @include('pages.users.my_ecammall_menu_buy')
            <div class="col-sm-9 padding-right">
                <h2 class="title text-center">Shop Information</h2>
                <div class="row">
                    <div class="col-lg-9">
                        {!! Form::Open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                        <div class="form-group @if($errors->has('shop_name')) has-error @endif">
                            {!! Form::label('shop_name','Shop Name*',['class'=>' col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('shop_name',Auth::user()->first_name,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('shop_name')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('shop_email')) has-error @endif">
                            {!! Form::label('shop_email','Shop Email',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('shop_email',Auth::user()->email,['class'=>'form-control']) !!}
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
                                {!! Form::text('website',$base_url.'shop/'.str_replace(" ","-",Auth::user()->first_name),['class'=>'form-control']) !!}
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

                        </div>
                        <div class="form-group @if($errors->has('shop_image')) has-error @endif">
                            {!! form::label('shop_image','Banner',['class'=>'control-label col-sm-4']) !!}
                            <div class="col-sm-8">
                                <input type="file" id="shop_image" accept="image/*" name="shop_image">
                                <p class="help-block">{!! implode('<br/>', $errors->get('shop_image')) !!}</p>
                                <p class="help-block">Image should be (1170px x 150px)</p>
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('shop_image_small')) has-error @endif">
                            {!! form::label('shop_image_small','Banner Small',['class'=>'control-label col-sm-4']) !!}
                            <div class="col-sm-8">
                                <input type="file" id="shop_image_small" accept="image/*" name="shop_image_small">
                                <p class="help-block">{!! implode('<br/>', $errors->get('shop_image_small')) !!}</p>
                                <p class="help-block">Image should be (340px x 200px)</p>
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('shop_logo')) has-error @endif">
                            {!! form::label('shop_image','Shop Logo*',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                <input type="file" id="shop_logo" accept="image/*" name="shop_logo">
                                <p class="help-block">{!! implode('<br/>', $errors->get('shop_logo')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-default" value="Submit">
                            <input type="reset" class="btn btn-default" value="Reset">
                        </div>
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
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
        })
    </script>
@endsection