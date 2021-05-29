@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Banner</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Banner
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::model($bannerMobile,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="form-group">
                                {!! Form::label('url','External URL',['class'=>'control-label']) !!}
                                {!! Form::text('url',null,['class'=>'form-control','placeholder'=>'Enter URL...']) !!}
                                <input type="checkbox" value="1" name="open_new_tab" @if($bannerMobile->open_new_tab == 1) checked @endif> Open new tab
                            </div>
                            <div class="form-group @if($errors->has('image_header_horizontal')) has-error @endif image_header_horizontal">
                                {!! form::label('image_header_horizontal','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image_header_horizontal" accept="image/*" name="image_header_horizontal">
                                <p class="help-block">Image side should be (1400px x 150px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('image_header_horizontal')) !!}</p>
                            </div>
                            <div class="form-group">
                                <img src="{{asset('images/home/'.$bannerMobile->image)}}" width="120px">
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
    <script src="{{asset('js/jquery.js')}}"></script>
@endsection