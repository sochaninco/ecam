@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Footer Page</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Footer Page
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::model($FooterPage,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            {{--<div class="form-group @if($errors->has('code')) has-error @endif">--}}
                                {{--{!! Form::label('code','Category Code*',['class'=>'control-label']) !!}--}}
                                {{--{!! Form::text('code',null,['class'=>'form-control']) !!}--}}
                                {{--<p class="help-block">{!! implode('<br/>', $errors->get('code')) !!}</p>--}}
                            {{--</div>--}}
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                {!! Form::label('name','Name*',['class'=>'control-label']) !!}
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('footer_type_id')) has-error @endif">
                                {!! Form::label('footer_type_id','Footer Type*',['class'=>'control-label']) !!}
                                {!! Form::select('footer_type_id',$FooterType,null,['class'=>'form-control','placeholder'=>'Select any type ..']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('footer_type_id')) !!}</p>
                            </div>
                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <label>Description*</label>
                                {!! Form::textarea('description',null,['id'=>'description','class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('description')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image')) has-error @endif">
                                {!! form::label('image','Image',['class'=>'control-label']) !!}
                                <img src="{{asset('images/footer/'.$FooterPage->image)}}" class="img-responsive">
                                <input type="file" id="image" accept="image/*" name="image">
                                <p class="help-block">{!! implode('<br/>', $errors->get('image')) !!}</p>
                            </div>
                            <div class="form-group">
                                {!! Form::label('url','URL*',['class'=>'control-label']) !!}
                                {!! Form::text('url',null,['class'=>'form-control']) !!}
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