@extends('layouts.app')

@section('content')
    <div class="page-login padding-top-10px">
        <section id="form">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 no-padding">

                    </div>
                    <div class="col-sm-4 white-bg">
                        <div class="login-form"><!--login form-->
                            <h2>Login to your account</h2>
                            @if (Session::has('flash_notification.message'))
                                <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                    {{ Session::get('flash_notification.message') }}
                                </div>
                            @endif
                            {!! Form::open(['url'=>'/login','method'=>'POST','role'=>'form']) !!}
                            <div class="form-group @if($errors->has('email')) has-error @endif">
                                {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter Email or Phone Number']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('email')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('password')) has-error @endif">
                                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('password')) !!}</p>
                            </div>
                            <span>
                            <input type="checkbox" name="remember" class="checkbox">
                            Keep me signed in
                        </span>
                            <button type="submit" class="btn btn-default">Login</button>
                            <span>
                            <br>
                            Do Not Have Account - <a href="{{url('register')}}" class="register-link"> Register New Account !!</a>
                        </span>
                            <br>
                            Sign in via
                            <a href="#" class="btn-fb"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="btn-tw"><i class="fa fa-twitter"></i></a>
                            {!! Form::close() !!}
                        </div><!--/login form-->

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
