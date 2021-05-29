@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create Role</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
        <div class="col-lg-12">
            {{--<a href="{{url('add_footer_page')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Footer Page</a>--}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all your Role
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="col-lg-9">
                        {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('name','Name*',['class'=>' col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('display_name')) has-error @endif">
                            {!! Form::label('display_name','Display Name*',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('display_name')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('description')) has-error @endif">
                            {!! Form::label('description','Description*',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('description')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('permission')) has-error @endif">
                            {!! Form::label('permission','Permission*',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                <div class="col-sm-6 no-padding">
                                    <p class="help-block has-error">User Shop permission</p>
                                    @foreach($permission as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            {{ $value->display_name }}</label>
                                        <br/>
                                    @endforeach
                                    <p class="help-block">{!! implode('<br/>', $errors->get('permission')) !!}</p>
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <p class="help-block has-error">Permission Admin Site</p>
                                    @foreach($permissionAdmin as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            {{ $value->display_name }}</label>
                                        <br/>
                                    @endforeach
                                    <p class="help-block">{!! implode('<br/>', $errors->get('permission')) !!}</p>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
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