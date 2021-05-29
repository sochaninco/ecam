@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Product Shop</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Product Shop
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::model($Product,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('category_id')) has-error @endif">
                                    {!! Form::label('category_id','Category',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::hidden('sku',null,['class'=>'form-control']) !!}
                                        {!! Form::select('category_id',$Category,null,['class'=>'form-control','placeholder'=>'Select any category..']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('category_id')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('sub_category_id')) has-error @endif">
                                    {!! Form::label('sub_category_id','SubCategory',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        <select class="form-control " name="sub_category_id" id="sub_category_id">
                                            <option value="{{$SubCategory->id}}">{{$SubCategory->name}}</option>
                                        </select>
                                        <p class="help-block">{!! implode('<br/>', $errors->get('sub_category_id')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('brand')) has-error @endif">
                                    {!! Form::label('brand','Brand',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('brand',$brand,null,['class'=>'form-control','placeholder'=>'Select any brand..']) !!}
                                        {!! Form::hidden('location',$location) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('brand')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('code')) has-error @endif">
                                    {!! Form::label('code','Product Code*',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('code',null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('code')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('name')) has-error @endif">
                                    {!! Form::label('name','Product Name*',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('quantity')) has-error @endif">
                                    {!! Form::label('quantity','Quantity in Stock*',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('quantity',null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('quantity')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('cost')) has-error @endif">
                                    {!! Form::label('cost','Cost*',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('cost',null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('cost')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('price')) has-error @endif">
                                    {!! Form::label('price','Selling Price*',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('price',null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('price')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('promotion')) has-error @endif">
                                    {!! Form::label('promotion','Promotion',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('promotion',$promotion,null,['class'=>'form-control','placeholder'=>'Select any promotion type..']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('promotion')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('discount_rate')) has-error @endif">
                                    {!! Form::label('discount_rate','Discount Rate*',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('discount_rate',null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('discount_rate')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('unit')) has-error @endif">
                                    {!! Form::label('unit','Unit',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('unit',null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('unit')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('shipping_type')) has-error @endif">
                                    {!! Form::label('shipping_type','Shipping Type',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('shipping_type',array('0'=>'Free Shipping','1'=>'None'),null,['class'=>'form-control','placeholder'=>'Select shipping Type..']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('shipping_type')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('premium_product')) has-error @endif">
                                    {!! Form::label('premium_product','Premium Product',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('premium_product',array('2'=>'YES','1'=>'NO'),null,['class'=>'form-control','placeholder'=>'Select product premium..']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('premium_product')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('item_condition')) has-error @endif">
                                    {!! Form::label('item_condition','Product Condition',['class'=>'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('item_condition',array('0'=>'NEW','1'=>'USED'),null,['class'=>'form-control','placeholder'=>'Select item condition..']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('item_condition')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if ($errors->has('detail')) has-error @endif">
                                    <label class="col-sm-3">Detail</label>
                                    <div class="col-sm-8">
                                        {!! Form::textarea('detail',old('detail'),['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('detail')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8">
                                    {!! form::label('thumbnails','Images (*Max = 2MB)',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <table class="table table-responsive table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($thumbnails as $thumb)
                                                <tr class="row_thumb">
                                                    <td><img src="{{asset('images/thumbnails/shop/'.$thumb->image)}}"> </td>
                                                    <td><a style="cursor: pointer" class="delete_thumb" id="{{$thumb->id}}"><i class="fa fa-trash"></i> </a> </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <p>New Upload Drop here</p>
                                        <div class="dropzone" id="dropzoneFileUpload">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('feature_image_detail')) has-error @endif">
                                    {!! form::label('feature_image_detail','Feature Image Detail',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <div class="feature_image">
                                            @if(!empty($Product->feature_image_detail))
                                                <img src="{{asset('images/user-shop/product/'.$Product->feature_image_detail)}}" width="120px"  height="150px">
                                            @endif
                                        </div>
                                        <table class="table table-responsive table-responsive table-striped">
                                            <tr>
                                                <th>Action</th>
                                                <th>New File</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a style="cursor:pointer;" class="delete_feature_image" id="{{$Product->id}}" name="1">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <input type="file" id="feature_image_detail" accept="image/*" name="feature_image_detail">
                                                </td>
                                            </tr>
                                        </table>
                                        <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('feature_image_detail_1')) has-error @endif">
                                    {!! form::label('feature_image_detail_1','Feature Image Detail 1',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <div class="feature_image_1">
                                            @if(!empty($Product->feature_image_detail_1))
                                                <img src="{{asset('images/user-shop/product/'.$Product->feature_image_detail_1)}}" width="120px"  height="150px">
                                            @endif
                                        </div>
                                        <table class="table table-responsive table-responsive table-striped">
                                            <tr>
                                                <th>Action</th>
                                                <th>New File</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a style="cursor:pointer;" class="delete_feature_image" id="{{$Product->id}}" name="2">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <input type="file" id="feature_image_detail_1" accept="image/*" name="feature_image_detail_1">
                                                </td>
                                            </tr>
                                        </table>
                                        <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_1')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('feature_image_detail_2')) has-error @endif">
                                    {!! form::label('feature_image_detail_2','Feature Image Detail 2',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <div class="feature_image_2">
                                            @if(!empty($Product->feature_image_detail_2))
                                                <img src="{{asset('images/user-shop/product/'.$Product->feature_image_detail_2)}}" width="120px"  height="150px">
                                            @endif
                                        </div>
                                        <table class="table table-responsive table-responsive table-striped">
                                            <tr>
                                                <th>Action</th>
                                                <th>New File</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a style="cursor:pointer;" class="delete_feature_image" id="{{$Product->id}}" name="3">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <input type="file" id="feature_image_detail_2" accept="image/*" name="feature_image_detail_2">
                                                </td>
                                            </tr>
                                        </table>
                                        <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_2')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('feature_image_detail_3')) has-error @endif">
                                    {!! form::label('feature_image_detail_3','Feature Image Detail 3',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <div class="feature_image_3">
                                            @if(!empty($Product->feature_image_detail_3))
                                                <img src="{{asset('images/user-shop/product/'.$Product->feature_image_detail_3)}}" width="120px"  height="150px">
                                            @endif
                                        </div>
                                        <table class="table table-responsive table-responsive table-striped">
                                            <tr>
                                                <th>Action</th>
                                                <th>New File</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a style="cursor:pointer;" class="delete_feature_image" id="{{$Product->id}}" name="4">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <input type="file" id="feature_image_detail_3" accept="image/*" name="feature_image_detail_3">
                                                </td>
                                            </tr>
                                        </table>
                                        <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_3')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('feature_image_detail_4')) has-error @endif">
                                    {!! form::label('feature_image_detail_4','Feature Image Detail 4',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <div class="feature_image_4">
                                            @if(!empty($Product->feature_image_detail_4))
                                                <img src="{{asset('images/user-shop/product/'.$Product->feature_image_detail_4)}}" width="120px"  height="150px">
                                            @endif
                                        </div>
                                        <table class="table table-responsive table-responsive table-striped">
                                            <tr>
                                                <th>Action</th>
                                                <th>New File</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a style="cursor:pointer;" class="delete_feature_image" id="{{$Product->id}}" name="5">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <input type="file" id="feature_image_detail_4" accept="image/*" name="feature_image_detail_4">
                                                </td>
                                            </tr>
                                        </table>
                                        <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_4')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8">
                                    {!! form::label('video_upload','Video Upload',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <input type="file" name="video_upload" accept="video/*">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8">
                                    {!! form::label('video_url','Video Link',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('video_url',null,['class'=>'form-control','placeholder'=>'Enter video url']) !!}
                                    </div>
                                </div>
                            </div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
                            <script type="text/javascript">
                                var baseUrl = "{{ url('/'.$Product->user_id) }}";
                                var product_id = "{{$Product->id}}";
                                var token = "{{ Session::token() }}";
                                Dropzone.autoDiscover = false;
                                var myDropzone = new Dropzone("div#dropzoneFileUpload", {
                                    url: baseUrl + "/shop_thumbnail_edit/"+product_id+"/uploadFiles",
                                    params: {
                                        _token: token
                                    }
                                });
                                Dropzone.options.myAwesomeDropzone = {
                                    paramName: "file", // The name that will be used to transfer the file
                                    maxFilesize: 2, // MB
                                    addRemoveLinks: true,
                                    accept: function(file, done) {

                                    },
                                };
                            </script>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Update</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
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