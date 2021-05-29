@extends('layouts.app')
@section('title','My Account')
@section('my_account','active')
@section('content')
    <div class="container">
        <div class="row white-bg">
            @include('pages.users.my_ecammall_menu_buy')
            <div class="col-sm-9 padding-right">
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <h2 class="title text-center">
                    Member Account
                </h2>
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
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
@endsection