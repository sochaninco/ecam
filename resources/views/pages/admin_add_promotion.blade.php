<?php
$promotionId = isset($promotion->id) ? $promotion->id : null;
?>
@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($promotionId)
                <h1 class="page-header"> Update Promotion</h1>
            @else
                <h1 class="page-header">Add Promotion</h1>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($promotionId)
                        Update Promotion
                    @else
                        Add Promotion
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            @if($promotionId)
                                {!! Form::model($promotion,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @else
                                {!! Form::Open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @endif
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                {!! Form::label('name','Promotion Name*',['class'=>'control-label']) !!}
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                            </div>
                            <div class="col-sm-12 no-padding">
                                <div class="form-group col-sm-10 no-padding @if($errors->has('value')) has-error @endif">
                                    {!! Form::label('value','Value',['class'=>'control-label']) !!}
                                    {!! Form::number('value',null,['class'=>'form-control','placeholder'=>'Enter the value promotion']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('value')) !!}</p>
                                </div>
                                <div class="form-group col-sm-2 no-padding @if($errors->has('value_type')) has-error @endif">
                                    {!! Form::label('value_type','Value Type',['class'=>'control-label']) !!}
                                    {!! Form::select('value_type',['0'=>'%','1'=>'$'],null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('value_type')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('started_date')) has-error @endif">
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                                    </div>
                                </div>

                                {!! Form::label('started_date','Start Date',['class'=>'control-label']) !!}
                                @if($promotionId)
                                    {!! Form::text('started_date',null,['class'=>'form-control']) !!}
                                @else
                                    {!! Form::text('started_date',date('Y-m-d'),['class'=>'form-control']) !!}
                                @endif
                                <p class="help-block">{!! implode('<br/>', $errors->get('started_date')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('finished_date')) has-error @endif">
                                {!! Form::label('finished_date','Finish Date',['class'=>'control-label']) !!}
                                @if($promotionId)
                                    {!! Form::text('finished_date',null,['class'=>'form-control']) !!}
                                @else
                                    {!! Form::text('finished_date',date('Y-m-d'),['class'=>'form-control']) !!}
                                @endif
                                <p class="help-block">{!! implode('<br/>', $errors->get('finished_date')) !!}</p>
                            </div>
                            <div class="form-group">
                                <div class="form-group @if($errors->has('image')) has-error @endif">
                                    {!! form::label('image','Image*',['class'=>'control-label']) !!}
                                    <input type="file" id="image" accept="image/*" name="image">
                                    <p class="help-block">Image side should be (183px x 40px)</p>
                                    <p class="help-block">{!! implode('<br/>', $errors->get('image')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group @if($errors->has('image_detail')) has-error @endif">
                                    {!! form::label('image_detail','Image Detail*',['class'=>'control-label']) !!}
                                    <input type="file" id="image" accept="image/*" name="image_detail">
                                    <p class="help-block">Image side should be (470px x 40px)</p>
                                    <p class="help-block">{!! implode('<br/>', $errors->get('image')) !!}</p>
                                </div>
                            </div>
                            @if($promotionId)
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