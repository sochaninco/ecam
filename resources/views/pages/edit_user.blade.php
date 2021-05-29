@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit User</h1>
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
                            {!! Form::model($ShopInfo,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="form-group @if($errors->has('first_name')) has-error @endif">
                                {!! Form::label('first_name','First Name*',['class'=>' col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('first_name',$userInfo->first_name,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('first_name')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('last_name')) has-error @endif">
                                {!! Form::label('last_name','Last Name*',['class'=>' col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('last_name',$userInfo->last_name,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('last_name')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('shop_name')) has-error @endif">
                                {!! Form::label('shop_name','Shop Name*',['class'=>' col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('shop_name',$ShopInfo->shop_name,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('shop_name')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('shop_email')) has-error @endif">
                                {!! Form::label('shop_email','Shop Email',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('shop_email',$ShopInfo->shop_email,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('shop_email')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('phone')) has-error @endif">
                                {!! Form::label('phone','Shop Phone',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('phone',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('phone')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('address','Shop Address',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('address',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('address')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('city')) has-error @endif">
                                {!! Form::label('city','City*',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('city',$location,null,['class'=>'form-control','placeholder'=>'Select any city..']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('city')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('website','Shop Website',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('website',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('website')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('password')) has-error @endif">
                                {!! Form::label('password','New Password',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter your new password']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('password')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
                                {!! Form::label('password_confirmation','Confirmation Password',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Enter Confirmation password']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('password_confirmation')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('roles','User Role',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple','size'=>'13')) !!}
                                </div>
                                <p></p>
                            </div>
                            <div class="form-group @if($errors->has('description')) has-error @endif">
                                {!! Form::label('description','Description',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('description')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('shop_theme')) has-error @endif">
                                {!! Form::label('shop_theme','Shop Theme*',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('shop_theme',$shopTheme,null,['class'=>'form-control','placeholder'=>'Select any shop theme..']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('shop_theme')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('shop_image')) has-error @endif">
                                {!! form::label('shop_image','Banner*',['class'=>'control-label col-sm-4']) !!}
                                <div class="col-sm-8">
                                    @if(!empty($ShopInfo->shop_image))
                                        <img src="{{asset('images/user-shop/'.$ShopInfo->shop_image)}}" class="img-responsive"><br>
                                    @endif
                                    <input type="file" id="shop_image" accept="image/*" name="shop_image">
                                    <p class="help-block">{!! implode('<br/>', $errors->get('shop_image')) !!}</p>
                                    <p class="help-block">Image should be (1170px x 150px)</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('shop_image_small')) has-error @endif">
                                {!! form::label('shop_image_small','Banner Small',['class'=>'control-label col-sm-4']) !!}
                                <div class="col-sm-8">
                                    @if(!empty($ShopInfo->shop_image_small))
                                        <div class="banner-shop-small">
                                            <div class="col-sm-11 col-md-11">
                                                <img src="{{asset('images/user-shop/'.$ShopInfo->shop_image_small)}}" class="img-responsive"><br>
                                            </div>
                                            <div class="col-sm-1 col-md-1">
                                                <i class="fa fa-trash delete_banner_shop_small" image-name="{{$ShopInfo->shop_image_small}}" style="cursor: pointer"></i>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file" id="shop_image_small" accept="image/*" name="shop_image_small">
                                    <p class="help-block">{!! implode('<br/>', $errors->get('shop_image_small')) !!}</p>
                                    <p class="help-block">Image should be (340px x 250px)</p>
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('shop_logo')) has-error @endif">
                                {!! form::label('shop_image','Shop Logo*',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    @if(!empty($ShopInfo->shop_logo))
                                        <img src="{{asset('images/user-shop/'.$ShopInfo->shop_logo)}}" class="img-responsive"><br>
                                    @endif
                                    <input type="file" id="shop_logo" accept="image/*" name="shop_logo">
                                    <p class="help-block">{!! implode('<br/>', $errors->get('shop_logo')) !!}</p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">Update</button>
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