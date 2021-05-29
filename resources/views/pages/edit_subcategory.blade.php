@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Subcategory</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit subcategory
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::model($subcategory,['method'=>'POST','files'=>true,'role'=>'form']) !!}

                            <div class="form-group @if($errors->has('code')) has-error @endif">
                                {!! Form::label('code','Subcategory Code*',['class'=>'control-label']) !!}
                                {!! Form::text('code',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('code')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                {!! Form::label('name','Subcategory Name*',['class'=>'control-label']) !!}
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('logo')) has-error @endif">
                                {!! form::label('logo','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="logo" accept="image/*" name="logo">
                                <p class="help-block">Image should be 400px x 200px</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('logo')) !!}</p>
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