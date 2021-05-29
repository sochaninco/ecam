@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Theme Shop</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add theme
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::Open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="form-group @if($errors->has('shop_type')) has-error @endif">
                                {!! Form::label('shop_type','Shop Type*',['class'=>'control-label col-sm-4']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('shop_type',null,['class'=>'form-control','placeholder'=>'Enter shop type']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('shop_type')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('theme_banner')) has-error @endif">
                                {!! form::label('theme_banner','Banner*',['class'=>'control-label col-sm-4']) !!}
                                <div class="col-sm-8">
                                    <input type="file" id="theme_banner" accept="image/*" name="theme_banner">
                                    <p class="help-block">{!! implode('<br/>', $errors->get('theme_banner')) !!}</p>
                                    <p class="help-block">Image should be (1170px x 150px)</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('theme_banner_small')) has-error @endif">
                                {!! form::label('theme_banner_small','Banner Small*',['class'=>'control-label col-sm-4']) !!}
                                <div class="col-sm-8">
                                    <input type="file" id="theme_banner_small" accept="image/*" name="theme_banner_small">
                                    <p class="help-block">{!! implode('<br/>', $errors->get('theme_banner_small')) !!}</p>
                                    <p class="help-block">Image should be (340px x 200px)</p>
                                </div>
                            </div>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-default">Submit</button>
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