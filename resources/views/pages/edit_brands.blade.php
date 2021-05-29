@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Brands</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Brands
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::model($Brand,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="form-group @if($errors->has('code')) has-error @endif">
                                {!! Form::label('code','Code*',['class'=>'control-label']) !!}
                                {!! Form::text('code',null,['class'=>'form-control','placeholder'=>'Enter Code...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('code')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                {!! Form::label('name','Name*',['class'=>'control-label']) !!}
                                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Brand Name...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('category_id')) has-error @endif">
                                {!! Form::label('category_id','Category*',['class'=>'control-label']) !!}
                                {!! Form::select('category_id',$Categories,null,['class'=>'form-control','placeholder'=>'Select any category...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('category_id')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image')) has-error @endif">
                                {!! form::label('banner','Banner Brand Zone*',['class'=>'control-label']) !!}
                                {{--<img src="http://ecammall.com/stock/assets/uploads/{{$Brand->image}}" class="img-responsive">--}}
                                <input type="file" id="banner" accept="image/*" name="banner">
                                <p class="help-block">Image side should be (340px x 340px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('banner')) !!}</p>
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