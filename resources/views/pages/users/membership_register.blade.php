@extends('layouts.app')
@section('title','My Account')
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
                    Payment Method
                </h2>
                <div class="col-lg-9">
                    {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                    <div class="form-group">
                        {!! Form::label('package_name','Package Name',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('package_name',$package->name,['class'=>'form-control','readonly']) !!}
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('first_name')) has-error @endif">
                        {!! Form::label('payment_type','Payment Type',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            <?php
                             $type = [0=>"Wing Transfer",1=>"Bank Transfer"]
                            ?>
                            {!! Form::select('payment_type',$type,null,['class'=>'form-control','placeholder'=>'Select any payment type']) !!}
                            <p class="help-block">
                                Note :
                                <br>ABA Account : 0000000
                                <br>Aceleda Account : 99999999
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-default" value="Submit">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection