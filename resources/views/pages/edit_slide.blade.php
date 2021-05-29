@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Slide</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Slide
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::model($slide,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="form-group @if($errors->has('product_id')) has-error @endif">
                                {!! Form::label('product_id','Product Code',['class'=>'control-label']) !!}
                                {!! Form::select('product_id',$product_code,null,['class'=>'form-control','placeholder'=>'select any product code...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('product_id')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('type')) has-error @endif">
                                {!! Form::label('type','Type',['class'=>'control-label']) !!}
                                {!! Form::select('type',['0'=>'Big','1'=>'Small'],null,['class'=>'form-control','placeholder'=>'select any slide type...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('type')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image')) has-error @endif">
                                {!! form::label('image','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image" accept="image/*" name="image">
                                <p class="help-block">Image side should be (683px x 425px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('image')) !!}</p>
                            </div>
                            <div class="form-group">
                                <img src="{{asset('images/home/'.$slide->image)}}" width="120px">
                            </div>
                            <div class="form-group @if($errors->has('external_link')) has-error @endif">
                                {!! Form::label('external_link','External Link',['class'=>'control-label']) !!}
                                {!! Form::text('external_link',null,['class'=>'form-control','placeholder'=>'Enter External Link']) !!}
                                <input type="checkbox" value="1" name="open_new_tab" @if($slide->open_new_tab == 1) checked @endif> Open New Tab
                                <p class="help-block">{!! implode('<br/>', $errors->get('external_link')) !!}</p>
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
@endsection