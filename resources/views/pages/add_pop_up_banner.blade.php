<?php
$popUpId = isset($popUp->id) ? $popUp->id : null;
?>
@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Pop Up Banner</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Banner
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            @if($popUpId)
                                {!! Form::model($popUp,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @else
                                {!! Form::Open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @endif
                            <div class="form-group">
                                {!! Form::label('url','External URL',['class'=>'control-label']) !!}
                                {!! Form::text('url',null,['class'=>'form-control','placeholder'=>'Enter URL...']) !!}
                            </div>
                            <div class="form-group @if($errors->has('image')) has-error @endif">
                                {!! form::label('image','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image_header_horizontal" accept="image/*" name="image">
                                <p class="help-block">Image side should be (750px x 350px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('image')) !!}</p>

                                @if($popUpId)
                                    <img src="{{asset('images/pop_up/'.$popUp->image)}}" width="250px">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-default">Submit</button>
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
    <script src="{{asset('js/jquery.js')}}"></script>
@endsection