@extends('layouts.app')
@section('title','My ShopInformation')
@section('my_account','active')
@section('my_customer_order','active')
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
                    {!! Form::model($shippingInfo,['method'=>'POST','files'=>true,'role'=>'form']) !!}
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
                            {!! Form::select('city',$city,null,['class'=>'form-control','placeholder'=>'Select any city..']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('city')) !!}</p>
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
@endsection