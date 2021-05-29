@extends('layouts.app')
@section('title','New Coupon')
@section('my_account','active')
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
                    New Coupon
                </h2>
                <div class="col-lg-9">
                    {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                    <div class="form-group @if($errors->has('type')) has-error @endif">
                        {!! Form::label('type','Coupon Name',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('type',null,['class'=>'form-control','placeholder'=>'Enter coupon name']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('type')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('description')) has-error @endif">
                        {!! Form::label('description','Description',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::textarea('description',null,['class'=>'form-control','placeholder'=>'Enter description coupon']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('description')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-default" value="Save">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection