@extends('layouts.app_admin')
@section('content')
    @if(Auth::user()->user_role == 1)
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin shop Info</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="panel-body">
            <div class="row">
                <div class="col-lg-6">
                    {!! Form::model($ShopInfo,['url'=>'admin_own_shop_edit','method'=>'POST','files'=>true,'role'=>'form']) !!}
                    <div class="form-group @if($errors->has('code')) has-error @endif">
                        {!! Form::label('shop_name','Shop Name*',['class'=>'control-label']) !!}
                        {!! Form::text('shop_name',null,['class'=>'form-control']) !!}
                        <p class="help-block">{!! implode('<br/>', $errors->get('shop_code')) !!}</p>
                    </div>
                    <div class="form-group @if($errors->has('shop_email')) has-error @endif">
                        {!! Form::label('shop_email','Shop Email*',['class'=>'control-label']) !!}
                        {!! Form::text('shop_email',null,['class'=>'form-control']) !!}
                        <p class="help-block">{!! implode('<br/>', $errors->get('shop_email')) !!}</p>
                    </div>
                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                        {!! Form::label('phone','Shop Phone*',['class'=>'control-label']) !!}
                        {!! Form::text('phone',null,['class'=>'form-control']) !!}
                        <p class="help-block">{!! implode('<br/>', $errors->get('phone')) !!}</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('address','Shop Address*',['class'=>'control-label']) !!}
                        {!! Form::text('address',null,['class'=>'form-control']) !!}
                        <p class="help-block">{!! implode('<br/>', $errors->get('address')) !!}</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('website','Shop Website*',['class'=>'control-label']) !!}
                        {!! Form::text('website',null,['class'=>'form-control']) !!}
                        <p class="help-block">{!! implode('<br/>', $errors->get('website')) !!}</p>
                    </div>
                    <div class="form-group @if($errors->has('description')) has-error @endif">
                        {!! Form::label('description','Description',['class'=>'control-label']) !!}
                        {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                        <p class="help-block">{!! implode('<br/>', $errors->get('description')) !!}</p>
                    </div>
                    <div class="form-group @if($errors->has('shop_image')) has-error @endif">
                        {!! form::label('shop_image','Banner*',['class'=>'control-label']) !!}
                        @if(!empty($ShopInfo->shop_image))
                            <img src="{{asset('images/user-shop/'.$ShopInfo->shop_image)}}" class="img-responsive"><br>
                        @endif
                        <input type="file" id="shop_image" accept="image/*" name="shop_image">
                        <p class="help-block">{!! implode('<br/>', $errors->get('shop_image')) !!}</p>
                        <p class="help-block">Image should be (1170px x 150px)</p>
                    </div>
                    <div class="form-group @if($errors->has('shop_logo')) has-error @endif">
                        {!! form::label('shop_image','Shop Logo*',['class'=>'control-label']) !!}
                        @if(!empty($ShopInfo->shop_logo))
                            <img src="{{asset('images/user-shop/'.$ShopInfo->shop_logo)}}" class="img-responsive"><br>
                        @endif
                        <input type="file" id="shop_logo" accept="image/*" name="shop_logo">
                        <p class="help-block">{!! implode('<br/>', $errors->get('shop_logo')) !!}</p>
                    </div>
                    <button type="submit" class="btn btn-default">Update</button>
                    {{--<button type="reset" class="btn btn-default">Reset</button>--}}
                    </form>
                </div>
            </div>
        <!-- /.row -->
        </div>
    </div>
    <!-- /#page-wrapper -->
    @endif
@endsection
