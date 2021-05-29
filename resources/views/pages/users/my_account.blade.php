@extends('layouts.app')
@section('title','My Account')
@section('my_account','active')
@section('my_personal_order','active')
@section('content')
    <div class="container">
        <div class="row white-bg">
            <div class="container no-padding">
                <?php
                $Product_banner = \App\CategorySlide::where(['status'=>0,'slide_type'=>11,'page'=>3])->get();
                ?>
                <div id="brand-zone-item-carousel" data-interval="300000" data-type="multi" data-ride="carousel" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach($Product_banner as $key=>$banner)
                            <div class="item @if($key == 0)active @endif ">
                                <a href="{{url('')}}" >
                                    <img alt="" src="{{asset('images/home/'.$banner->image)}}" class="img-responsive">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('pages.users.my_ecammall_menu_buy')
            <div class="col-sm-9 padding-5px">
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <h2 class="title text-center">
                    My Account
                </h2>
                <div class="col-lg-12 col-xs-12 no-padding">
                    {!! Form::model($Account,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                    <div class="form-group">
                        {!! Form::label('image','Image',['class'=>'control-label col-sm-4 no-padding']) !!}
                        <div class="col-sm-8 no-padding">
                            <div class="col-xs-4 col-sm-2 current-img no-padding">
                                @if($Account->image =='default_profile.jpg')
                                    <img src="{{asset('images/'.$Account->image)}}" class="img-profile">
                                @else
                                    <img src="{{asset('images/'.$Account->image)}}" class="img-profile">
                                @endif
                            </div>
                            <div class="col-sm-10 col-xs-8 no-padding">
                                <div class="col-lg-12 no-padding">
                                    <div class="col-sm-12 no-padding">
                                        <div class="dropzone" id="dropzoneFileUpload">
                                            <div class="dz-message" data-dz-message><span>Upload Image (146px x180px)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
                        <script type="text/javascript">
                            var baseUrl = "{{ url('/'.$userId) }}";
                            var token = "{{ Session::token() }}";
                            // Dropzone.autoDiscover = false;
                            var myDropzone = new Dropzone("div#dropzoneFileUpload", {
                                url: baseUrl + "/user_profile/uploadFiles",
                                params: {
                                    _token: token
                                },
                                success: function(file, response){

                                    $('.current-img').html(response)
                                }
                            });
                            Dropzone.options.myDropzone = {
                                maxFiles: 1,
                                paramName: "file", // The name that will be used to transfer the file
                                maxFilesize: 2, // MB
                                addRemoveLinks: true,
                                dictCancelUpload:true,
                                dictCancelUploadConfirmation:true,
                                dictRemoveFile:true,
                                accept: function(file, done) {
                                    ('.current-img').hide();
                                },
                                init: function() {
                                    myDropzone.on("maxfilesexceeded", function (file) {
                                        this.removeFile(file);
                                    });
                                },
                            };
                        </script>
                    </div>
                    <div class="form-group @if($errors->has('first_name')) has-error @endif">
                        {!! Form::label('first_name','First Name',['class'=>'col-sm-4 no-padding control-label']) !!}
                        <div class="col-sm-8 no-padding">
                            {!! Form::text('first_name',null,['class'=>'form-control','placeholder'=>'Enter your First Name']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('first_name')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('last_name')) has-error @endif">
                        {!! Form::label('last_name','Last Name',['class'=>'col-sm-4 no-padding control-label']) !!}
                        <div class="col-sm-8 no-padding">
                            {!! Form::text('last_name',null,['class'=>'form-control','placeholder'=>'Enter your Last Name']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('last_name')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                        {!! Form::label('phone','Phone*',['class'=>'col-sm-4 no-padding control-label']) !!}
                        <div class="col-sm-8 no-padding">
                            {!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'Enter your phone number']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('phone')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('address')) has-error @endif">
                        {!! Form::label('address','Address*',['class'=>'col-sm-4 no-padding control-label']) !!}
                        <div class="col-sm-8 no-padding">
                            {!! Form::text('address',null,['class'=>'form-control','placeholder'=>'Enter your address']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('address')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('city')) has-error @endif">
                        {!! Form::label('city','City*',['class'=>'col-sm-4 no-padding control-label']) !!}
                        <div class="col-sm-8 no-padding">
                            {!! Form::select('city',$location,null,['class'=>'form-control','placeholder'=>'Select any city..']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('city')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('password')) has-error @endif">
                        {!! Form::label('password','New Password',['class'=>'col-sm-4 no-padding control-label']) !!}
                        <div class="col-sm-8 no-padding">
                            {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter your new password']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('password')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
                        {!! Form::label('password_confirmation','Confirmation Password',['class'=>'col-sm-4 no-padding control-label']) !!}
                        <div class="col-sm-8 no-padding">
                            {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Enter Confirmation password']) !!}
                            <p class="help-block">{!! implode('<br/>', $errors->get('password_confirmation')) !!}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" value="Update">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
