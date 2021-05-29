@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Category</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Category
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::model($category,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="form-group @if($errors->has('code')) has-error @endif">
                                {!! Form::label('code','Category Code*',['class'=>'control-label']) !!}
                                {!! Form::text('code',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('code')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                {!! Form::label('name','Category Name*',['class'=>'control-label']) !!}
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image')) has-error @endif">
                                {!! form::label('image','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image" accept="image/*" name="image">
                                <p class="help-block">{!! implode('<br/>', $errors->get('image')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image_mobile')) has-error @endif">
                                {!! form::label('image_mobile','Image For Mobile*',['class'=>'control-label']) !!}
                                <input type="file" id="image_mobile" accept="image/*" name="image_mobile">
                                <p class="help-block">Image size 60px X 60px</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('image_mobile')) !!}</p>
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