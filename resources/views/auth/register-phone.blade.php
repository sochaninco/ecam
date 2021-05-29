@extends('layouts.app')

@section('content')
    <style>
        #help-block{
            color: #a94442;
        }
    </style>
    <div class="page-register padding-top-10px">
        <section id="form"><!--form-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 no-padding">

                    </div>
                    <div class="col-sm-4 white-bg">
                        <div class="signup-form"><!--sign up form-->
                            <h2>New User Signup!</h2>
                            <ul class="nav nav-tabs">
                                <li><a href="{{url('register')}}">Email Register</a></li>
                                <li class="active"><a href="{{url('register-phone')}}">Phone Register</a></li>
                            </ul>
                            <br>
                            {!! Form::open(['url'=>'/register-phone','method'=>'POST','role'=>'form']) !!}
                            <div class="form-group @if($errors->has('first_name')) has-error @endif">
                                {!! Form::text('first_name',null,['class'=>'form-control','placeholder'=>'Enter First Name']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('first_name')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('last_name')) has-error @endif">
                                {!! Form::text('last_name',null,['class'=>'form-control','placeholder'=>'Enter Last Name']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('last_name')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('phone')) has-error @endif">
                                {!! Form::text('phone',null,['class'=>'form-control','id'=>'phone-number','autocomplete'=>'off','placeholder'=>'Enter Phone Number']) !!}
                                <span id="help-block"></span>
                                <p class="help-block">{!! implode('<br/>', $errors->get('phone')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('password')) has-error @endif">
                                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter Password']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('password')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
                                {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Enter Password Confirmation']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('password_confirmation')) !!}</p>
                            </div>
                            <div class="form-group">
                                <div class="label col-sm-6">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-btn fa-user"></i> Signup</button>
                                </div>
                                <div class="col-sm-6">
                                    Sign in via
                                    <a href="#" class="btn-fb"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="btn-tw"><i class="fa fa-twitter"></i></a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div><!--/sign up form-->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        /*$("#phone-number").keyup(function(){
            var number = convertPhone($(this).val());
            $("#phone-number").val(number);
        });
        function convertPhone(number)
        {
            return number
                .toLowerCase()
                .replace(/ /g,'-')
                .replace(/[^\w]+/g,'')
                ;
        }*/
        $("#phone-number").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#help-block").html("Number Only").show().fadeOut("slow");
                return false;
            }
        });
    </script>
@endsection
