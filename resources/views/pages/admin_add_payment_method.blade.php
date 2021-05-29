<?php
$payment = isset($paymentMethod->id) ? $paymentMethod->id : null;
?>
@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($payment)
                <h1 class="page-header"> Update Payment Method</h1>
            @else
                <h1 class="page-header">Add Payment Method</h1>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($payment)
                        Update Payment Method
                    @else
                        Add Payment Method
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            @if($payment)
                                {!! Form::model($paymentMethod,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @else
                                {!! Form::Open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @endif
                            <div class="col-sm-12 no-padding">
                                <div class="form-group col-sm-6 no-padding @if($errors->has('name')) has-error @endif">
                                    {!! Form::label('name','Name*',['class'=>'control-label']) !!}
                                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                                </div>
                            </div>
                            <div class="col-sm-12 no-padding">
                                <div class="form-group col-sm-6 no-padding">
                                    {!! Form::label('description','Description',['class'=>'control-label']) !!}
                                    {!! Form::text('description',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('description')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('logo')) has-error @endif">
                                {!! form::label('logo','Logo*',['class'=>'control-label']) !!}
                                <input type="file" id="logo" accept="image/*" name="logo">
                                <p class="help-block">Image side should be (50px x 26px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('logo')) !!}</p>
                                @if($payment)
                                <img src="{{asset('images/payment/'.$paymentMethod->logo)}}">
                                @endif
                            </div>
                            <div class="col-sm-12 no-padding @if($errors->has('account_number')) has-error @endif">
                                <div class="form-group col-sm-6 no-padding">
                                    {!! Form::label('account_number','Admin Account Number',['class'=>'control-label']) !!}
                                    {!! Form::text('account_number',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('account_number')) !!}</p>
                                </div>
                            </div>


                            @if($payment)
                                <button type="submit" class="btn btn-default">Update</button>
                            @else
                                <button type="submit" class="btn btn-default">Submit</button>
                            @endif
                            <button type="reset" class="btn btn-default">Reset</button>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection
@section('js')

@endsection