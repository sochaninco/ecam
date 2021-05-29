<?php
$packageId = isset($package->id) ? $package->id : null;
?>
@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($packageId)
                <h1 class="page-header"> Update Package</h1>
            @else
                <h1 class="page-header">Add Package</h1>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($packageId)
                        Update Package
                    @else
                        Add Package
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            @if($packageId)
                                {!! Form::model($package,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @else
                                {!! Form::Open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @endif
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                {!! Form::label('name','Package Name*',['class'=>'control-label']) !!}
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('package_term')) has-error @endif">
                                {!! Form::label('package_term','Package Term*',['class'=>'control-label']) !!}
                                {!! Form::select('package_term',$packageTerm,null,['class'=>'form-control','placeholder'=>'Select any package term']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('package_term')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('price')) has-error @endif">
                                {!! Form::label('price','Price*',['class'=>'control-label']) !!}
                                {!! Form::text('price',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('price')) !!}</p>
                            </div>
                            <div class="form-group">
                                {!! Form::label('no_product','Post Product Up to',['class'=>'control-label']) !!}
                                {!! Form::text('no_product',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('auto_renew','Auto Renew',['class'=>'control-label']) !!}
                                {!! Form::text('auto_renew',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('renew','Renew',['class'=>'control-label']) !!}
                                {!! Form::text('renew',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('featured_ads','Featured Ads',['class'=>'control-label']) !!}
                                {!! Form::text('featured_ads',null,['class'=>'form-control']) !!}
                            </div>
                            <hr>
                            <h5>Post Advertisement</h5>
                            <div class="form-group">
                                {!! Form::label('ads_general','Ads General',['class'=>'control-label']) !!}
                                {!! Form::text('ads_general',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('ads_specific','Ads Specific',['class'=>'control-label']) !!}
                                {!! Form::text('ads_specific',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('ads_custom','Ads Custom',['class'=>'control-label']) !!}
                                {!! Form::text('ads_custom',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('shop_info','Shop Info',['class'=>'control-label']) !!}
                                @if($packageId)
                                    <input type="checkbox" @if($package->shop_info == 1)  checked @endif value="1" name="shop_info"> Show Shop information
                                @else
                                    <input type="checkbox" value="1" name="shop_info"> Show Shop Information
                                @endif
                            </div>
                            @if($packageId)
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