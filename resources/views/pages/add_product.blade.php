@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Product</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Product
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            {{--<div class="form-group @if($errors->has('code')) has-error @endif">--}}
                                {{--{!! Form::label('code','Category Code*',['class'=>'control-label']) !!}--}}
                                {{--{!! Form::text('code',null,['class'=>'form-control']) !!}--}}
                                {{--<p class="help-block">{!! implode('<br/>', $errors->get('code')) !!}</p>--}}
                            {{--</div>--}}
                            <div class="col-sm-5 no-padding-left">
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('type','Product Type',['class'=>'control-label']) !!}
                                    {!! Form::select('type',['standard'=>'standard','combo'=>'combo','digital'=>'digital','service'=>'service'],null,['class'=>'form-control']) !!}
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding @if($errors->has('name')) has-error @endif">
                                    {!! Form::label('name','Product Name*',['class'=>'control-label']) !!}
                                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding @if($errors->has('code')) has-error @endif">
                                    {!! Form::label('code','Product Code*',['class'=>'control-label']) !!}
                                    {!! Form::text('code',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('code')) !!}</p>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding @if($errors->has('slug')) has-error @endif">
                                    {!! Form::label('slug','Product Slug',['class'=>'control-label']) !!}
                                    {!! Form::text('slug',null,['class'=>'form-control','readonly']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('slug')) !!}</p>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding @if($errors->has('second_name')) has-error @endif">
                                    {!! Form::label('second_name','Secondary Name',['class'=>'control-label']) !!}
                                    {!! Form::text('second_name',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('second_name')) !!}</p>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding @if($errors->has('second_name')) has-error @endif">
                                    {!! Form::label('barcode_symbology','Barcode Symbology',['class'=>'control-label']) !!}
                                    <select name="barcode_symbology" class="form-control select" id="barcode_symbology" required="required" title="Barcode Symbology">
                                        <option value="code25">Code25</option>
                                        <option value="code39">Code39</option>
                                        <option value="code128" selected="selected">Code128</option>
                                        <option value="ean8">EAN8</option>
                                        <option value="ean13">EAN13</option>
                                        <option value="upca">UPC-A</option>
                                        <option value="upce">UPC-E</option>
                                    </select>
                                    <p class="help-block">{!! implode('<br/>', $errors->get('barcode_symbology')) !!}</p>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('cost','Cost',['class'=>'control-label']) !!}
                                    {!! Form::text('cost',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('price','Price',['class'=>'control-label']) !!}
                                    {!! Form::text('price',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('category','Category',['class'=>'control-label']) !!}
                                    {!! Form::select('category_id',$category,null,['class'=>'form-control','id'=>'category_admin_product']) !!}
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('subcategory_id','SubCategory',['class'=>'control-label']) !!}
                                    <select class="form-control " name="subcategory_id" id="subcategory_id">
{{--                                        <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>--}}
                                    </select>
                                    {{--{!! Form::select('subcategory_id',$subcategory,null,['class'=>'form-control']) !!}--}}
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('brand','Brand',['class'=>'control-label']) !!}
                                    {!! Form::select('brand',$brand,null,['class'=>'form-control']) !!}
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('unit','Unit',['class'=>'control-label']) !!}
                                    <select class="form-control" id="unit" name="unit">
                                        <option>select unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}} ({{$unit->code}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('sale_unit','Sale Unit',['class'=>'control-label']) !!}
                                    <select class="form-control" id="sale_unit" name="sale_unit">
                                        <option>select unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}" >{{$unit->name}} ({{$unit->code}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('purchase_unit','Purchase Unit',['class'=>'control-label']) !!}
                                    <select class="form-control" id="purchase_unit" name="purchase_unit">
                                        <option>select unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}} ({{$unit->code}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('weight','Weight',['class'=>'control-label']) !!}
                                    {!! Form::text('weight',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-sm-12 no-padding">
                                    {!! Form::label('alert_quantity','Alert Quantity',['class'=>'control-label']) !!}
                                    {!! Form::number('alert_quantity',null,['class'=>'form-control']) !!}
                                </div>

                            </div>
                            <div class="col-sm-6 col-sm-offset-1">
                                <div class="form-group col-sm-12">
                                    <input type="checkbox" value="1" name="promotion" class="promotion">
                                    {!! Form::label('promotion','Promotion',['class'=>'control-label']) !!}
                                </div>
                                <div class="promotion_block">
                                    <div class="form-group col-sm-6">
                                        {!! Form::label('start_date','Start Date',['class'=>'control-label']) !!}
                                        <div style="position: relative">
                                            {!! Form::text('start_date',null,['class'=>'form-control start_date']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        {!! Form::label('end_date','End Date',['class'=>'control-label']) !!}
                                        {!! Form::text('end_date',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-sm-6 no-padding">
                                <input type="checkbox" value="1" name="featured">
                                {!! Form::label('featured','Featured (Shop homepage listing)',['class'=>'control-label']) !!}
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-sm-6 no-padding">
                                <input type="checkbox" value="1" name="hide_pos">
                                {!! Form::label('hide_pos','Hide in POS Module',['class'=>'control-label']) !!}
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-sm-6 no-padding">
                                <input type="checkbox" value="1" name="hide">
                                {!! Form::label('hide','Hide in Shop Module',['class'=>'control-label']) !!}
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-sm-6 no-padding">
                                <input type="checkbox" value="1" class="custom_field">
                                {!! Form::label('custom_field','Custom Field',['class'=>'control-label']) !!}
                            </div>
                            <div class="clearfix"></div>
                            <div class="custom_field_block">
                                <div class="form-group col-sm-4 no-padding-left">
                                    {!! Form::label('cf1','Product Custom Field 1',['class'=>'control-label']) !!}
                                    {!! Form::text('cf1',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('cf2','Product Custom Field 2',['class'=>'control-label']) !!}
                                    {!! Form::text('cf2',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('cf3','Product Custom Field 3',['class'=>'control-label']) !!}
                                    {!! Form::text('cf3',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-4 no-padding-left">
                                    {!! Form::label('cf4','Product Custom Field 4',['class'=>'control-label']) !!}
                                    {!! Form::text('cf4',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('cf5','Product Custom Field 5',['class'=>'control-label']) !!}
                                    {!! Form::text('cf5',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('cf6','Product Custom Field 6',['class'=>'control-label']) !!}
                                    {!! Form::text('cf6',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-sm-12 no-padding">
                                <ul class="nav nav-tabs gray-bg">
                                    <li class="active"><a data-toggle="tab" href="#details">Detail</a></li>
                                    <li><a data-toggle="tab" href="#productPhoto">Galleries</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="details" class="tab-pane fade in active">
                                        <br>
                                        <div class="form-group @if ($errors->has('details')) has-error @endif">
                                            <label>Product details for invoice</label>
                                            <input type="text" name="details" value="" class="form-control">
                                            <p class="help-block">{!! implode('<br/>', $errors->get('details')) !!}</p>
                                        </div>
                                        <div class="form-group @if ($errors->has('details')) has-error @endif">
                                            <label>Detail</label>
                                            {!! Form::textarea('product_details',old('product_details'),['class'=>'form-control']) !!}
                                            <p class="help-block">{!! implode('<br/>', $errors->get('product_details')) !!}</p>
                                        </div>
                                    </div>
                                    <div id="productPhoto" class="tab-pane fade">
                                        <br>
                                        <div class="form-group @if($errors->has('image')) has-error @endif">
                                            <div class="clearfix"></div>
                                            {!! form::label('image','Image*',['class'=>'control-label']) !!}
                                            <input type="file" id="image" accept="image/*" name="image">
                                            <p class="help-block">{!! implode('<br/>', $errors->get('image')) !!}</p>
                                        </div>
                                        <div class="form-group">
                                            {!! form::label('thumbnails','Thumbnails (*Max = 2MB)',['class'=>'control-label']) !!}

                                            <div class="dropzone" id="dropzoneFileUpload">
                                            </div>
                                        </div>

                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>

                                        <script type="text/javascript">
                                            var baseUrl = "{{ url('/ADMIN') }}";
                                            var token = "{{ Session::token() }}";
                                            Dropzone.autoDiscover = false;
                                            var myDropzone = new Dropzone("div#dropzoneFileUpload", {
                                                url: baseUrl + "/byAdmin/thumbnail/uploadFiles",
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
                                    </div>
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
