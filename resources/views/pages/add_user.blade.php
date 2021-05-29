@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add User</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit User
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-9">
                            {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="form-group @if($errors->has('first_name')) has-error @endif">
                                {!! Form::label('first_name','First Name*',['class'=>' col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('first_name',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('first_name')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('last_name')) has-error @endif">
                                {!! Form::label('last_name','Last Name*',['class'=>' col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('last_name',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('last_name')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('email')) has-error @endif">
                                {!! Form::label('email','Email',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('email',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('email')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('password')) has-error @endif">
                                {!! Form::label('password','New Password',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter your new password']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('password')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('confirm-password')) has-error @endif">
                                {!! Form::label('confirm-password','Confirmation Password',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('confirm-password',['class'=>'form-control','placeholder'=>'Enter Confirmation password']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('confirm-password')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('role','Role',['class'=>'control-label col-sm-4']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('roles[]', $roles,[], ['class' => 'form-control','multiple']) !!}
                                </div>
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