@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Brands</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Brands
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::Open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                {!! Form::label('name','Name*',['class'=>'control-label']) !!}
                                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Brand Name...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('describe')) has-error @endif">
                                {!! Form::label('describe','Describe*',['class'=>'control-label']) !!}
                                {!! Form::text('describe',null,['class'=>'form-control','placeholder'=>'Enter Description...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('describe')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image')) has-error @endif">
                                {!! form::label('image','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image" accept="image/*" name="image">
                                {{--<p class="help-block">Image side should be (683px x 425px)</p>--}}
                                <p class="help-block">{!! implode('<br/>', $errors->get('image')) !!}</p>
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