@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Admin add Product to Shop</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
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
                            {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('category_id')) has-error @endif">
                                    {!! Form::label('category_id','Category*',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::hidden('sku',$sku,['class'=>'form-control']) !!}
                                        {!! Form::select('category_id',$Category,null,['class'=>'form-control','placeholder'=>'Select any category..']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('category_id')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('sub_category_id')) has-error @endif">
                                    {!! Form::label('sub_category_id','SubCategory*',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <select class="form-control " name="sub_category_id" id="sub_category_id">
                                            <option value="">Select any Subcategory ...</option>
                                        </select>
                                        <p class="help-block">{!! implode('<br/>', $errors->get('sub_category_id')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('brand')) has-error @endif">
                                    {!! Form::label('brand','Brand',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('brand',$brand,null,['class'=>'form-control','placeholder'=>'Select any brand..']) !!}
                                        {!! Form::hidden('location',$location) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('brand')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('code')) has-error @endif">
                                    {!! Form::label('code','Product Code*',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('code',null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('code')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('name')) has-error @endif">
                                    {!! Form::label('name','Product Name*',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('quantity')) has-error @endif">
                                    {!! Form::label('quantity','Quantity in Stock*',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('quantity',null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('quantity')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('cost')) has-error @endif">
                                    {!! Form::label('cost','Cost*',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="cost" name="cost" onClick="this.select();" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                        {{--{!! Form::text('cost',null,['class'=>'form-control']) !!}--}}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('cost')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('price')) has-error @endif">
                                    {!! Form::label('price','Selling Price*',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="price" name="price" placeholder="input number only" onClick="this.select();" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                        <p class="help-block">{!! implode('<br/>', $errors->get('price')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('promotion')) has-error @endif">
                                    {!! Form::label('promotion','Promotion',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('promotion',$promotion,null,['class'=>'form-control','placeholder'=>'Select any promotion type..']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('promotion')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('discount_rate')) has-error @endif">
                                    {!! Form::label('discount_rate','Discount Rate (%)',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="discount_rate" name="discount_rate" placeholder="input number only" onClick="this.select();" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                        {{--{!! Form::text('discount_rate',null,['class'=>'form-control']) !!}--}}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('discount_rate')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8">
                                    {!! Form::label('price_after_discount','Price after Discount',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('price_after_discount',null,['class'=>'form-control','readonly']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('unit')) has-error @endif">
                                    {!! Form::label('unit','Unit*',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <?php
                                        $arrayUnit = ['Box'=>'Box','pcs'=>'pcs','cm'=>'cm','Bottle'=>'Bottle','Lite'=>'Lite','ml'=>'ml'];
                                        ?>
                                        {!! Form::select('unit',$arrayUnit,null,['class'=>'form-control']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('unit')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('shipping_type')) has-error @endif">
                                    {!! Form::label('shipping_type','Shipping Type',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('shipping_type',array('0'=>'Free Shipping','1'=>'None'),null,['class'=>'form-control','placeholder'=>'Select shipping Type..']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('shipping_type')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8 @if($errors->has('premium_product')) has-error @endif">
                                    {!! Form::label('premium_product','Premium Product',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('premium_product',array('2'=>'YES','1'=>'NO'),null,['class'=>'form-control','placeholder'=>'Select product premium..']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('premium_product')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('item_condition')) has-error @endif">
                                    {!! Form::label('item_condition','Product Condition',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('item_condition',array('0'=>'NEW','1'=>'USED'),null,['class'=>'form-control','placeholder'=>'Select item condition..']) !!}
                                        <p class="help-block">{!! implode('<br/>', $errors->get('item_condition')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if ($errors->has('detail')) has-error @endif">
                                    <label class="col-sm-4">Detail</label>
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
                                        <div class="dropzone" id="dropzoneFileUpload">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('feature_image_detail')) has-error @endif">
                                    {!! form::label('feature_image_detail','Feature Image Detail',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <input type="file" id="feature_image_detail" accept="image/*" name="feature_image_detail">
                                        <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('feature_image_detail_1')) has-error @endif">
                                    {!! form::label('feature_image_detail_1','Feature Image Detail 1',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <input type="file" id="feature_image_detail_1" accept="image/*" name="feature_image_detail_1">
                                        <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_1')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('feature_image_detail_2')) has-error @endif">
                                    {!! form::label('feature_image_detail_2','Feature Image Detail 2',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <input type="file" id="feature_image_detail_2" accept="image/*" name="feature_image_detail_2">
                                        <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_2')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('feature_image_detail_3')) has-error @endif">
                                    {!! form::label('feature_image_detail_3','Feature Image Detail 3',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <input type="file" id="feature_image_detail_3" accept="image/*" name="feature_image_detail_3">
                                        <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_3')) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-lg-8 @if($errors->has('feature_image_detail_4')) has-error @endif">
                                    {!! form::label('feature_image_detail_4','Feature Image Detail 4',['class'=>'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                        <input type="file" id="feature_image_detail_4" accept="image/*" name="feature_image_detail_4">
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
                                var baseUrl = "{{ url('/'.$user_id) }}";
                                var token = "{{ Session::getToken() }}";
                                Dropzone.autoDiscover = false;
                                var myDropzone = new Dropzone("div#dropzoneFileUpload", {
                                    url: baseUrl + "/shop_thumbnail/uploadFiles",
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
                                <button type="submit" class="btn btn-default">Submit</button>
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