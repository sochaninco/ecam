@extends('layouts.app')
@section('title','My New Product')
@section('my_new_product','active')
@section('my_customer_order','active')
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
            @include('pages.users.my_ecammall_menu_sell')
            <div class="col-sm-9 padding-5px">
                <?php
                $expiredDate = date('Y-m-d',strtotime($expiredDateStr));
                $currentDate = date('Y-m-d');
                ?>

                @if($expiredDate == $currentDate)
                    <div class="alert alert-danger margin-top-30px">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Your Package was expired, <a href="{{url('em-user/'.Auth::user()->id.'/membership_list')}}"> Click Here </a> for renew
                    </div>
                @else
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <h2 class="title text-center">
                    My New Product
                </h2>

                    <div class="row">
                        {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                        <div class="col-lg-12 no-padding">
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('category_id')) has-error @endif">
                                {!! Form::label('category_id','Category*',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    {!! Form::hidden('sku',$sku,['class'=>'form-control']) !!}
                                    {!! Form::select('category_id',$Category,null,['id'=>'product_category_id','class'=>'form-control','placeholder'=>'Select any category..']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('category_id')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('sub_category_id')) has-error @endif">
                                {!! Form::label('sub_category_id','SubCategory*',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    <select class="form-control " name="sub_category_id" id="sub_category_id">
                                        @if(count((array)old('sub_category_id')) > 0 && !empty(old('sub_category_id')))
                                            {{old('sub_category_id')}}
                                            <option value="{{old('sub_category_id')}}" selected>{{$subByCat[old('sub_category_id')]}}</option>
                                        @else
                                            <option value="">Select any Subcategory ...</option>
                                        @endif
                                    </select>
                                    <p class="help-block">{!! implode('<br/>', $errors->get('sub_category_id')) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding">
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('brand')) has-error @endif">
                                {!! Form::label('brand','Brand',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    <select class="form-control" name="brand" id="brand">
                                        <?php
                                        $brandByCat = \App\Brand::where('category_id',old('category_id'))->pluck('name','id');
                                        ?>
                                        @if(count((array)old('brand')) > 0 && !empty(old('brand')))
                                            {{--@foreach($brandByCat as $bran)
                                                <option value="{{$bran->id}}">{{$brand->name}}</option>
                                            @endforeach--}}
                                            <option value="{{old('brand')}}" selected>{{$brandByCat[old('brand')]}}</option>
                                        @else
                                            <option value="">Select any Brand ...</option>
                                        @endif
                                    </select>
                                    {!! Form::hidden('location',$location) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('brand')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('quantity')) has-error @endif">
                                {!! Form::label('quantity','QTY in Stock*',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    {!! Form::text('quantity',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('quantity')) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('code')) has-error @endif">
                                {!! Form::label('code','Coupon Code',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    {!! Form::select('code',$couponCode,null,['class'=>'form-control','placeholder'=>'select any coupon type']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('code')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('name')) has-error @endif">
                                {!! Form::label('name','Product Name*',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('cost')) has-error @endif">
                                {!! Form::label('cost','Cost*',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    <input type="text" class="form-control" id="cost" name="cost" onClick="this.select();" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    {{--{!! Form::text('cost',null,['class'=>'form-control']) !!}--}}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('cost')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('price')) has-error @endif">
                                {!! Form::label('price','Selling Price*',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    <input type="text" class="form-control" id="price" name="price" placeholder="input number only" onClick="this.select();" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    <p class="help-block">{!! implode('<br/>', $errors->get('price')) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding">
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('promotion')) has-error @endif">
                                {!! Form::label('promotion','Promotion',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    {!! Form::select('promotion',$promotion,null,['class'=>'form-control','placeholder'=>'Select any promotion type..']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('promotion')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('item_condition')) has-error @endif">
                                {!! Form::label('item_condition','Product Condition',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    {!! Form::select('item_condition',array('0'=>'NEW','1'=>'USED'),null,['class'=>'form-control','placeholder'=>'Select item condition..']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('item_condition')) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding">
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('discount_rate')) has-error @endif">
                                {!! Form::label('discount_rate','Discount (%)',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    <input type="text" class="form-control" id="discount_rate" name="discount_rate" placeholder="input number only" onClick="this.select();" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    {{--{!! Form::text('discount_rate',null,['class'=>'form-control']) !!}--}}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('discount_rate')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 margin-bottom-0">
                                {!! Form::label('price_after_discount','Price after Discount',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    {!! Form::text('price_after_discount',null,['class'=>'form-control','readonly']) !!}
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding">
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('unit')) has-error @endif">
                                {!! Form::label('unit','Unit*',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    <?php
                                        $arrayUnit = ['Box'=>'Box','pcs'=>'pcs','cm'=>'cm','Bottle'=>'Bottle','Lite'=>'Lite','ml'=>'ml'];
                                    ?>
                                    {!! Form::select('unit',$arrayUnit,null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('unit')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('shipping_type')) has-error @endif">
                                {!! Form::label('shipping_type','Shipping Type',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    {!! Form::select('shipping_type',array('0'=>'Free Shipping','1'=>'None'),null,['class'=>'form-control','placeholder'=>'Select shipping Type..']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('shipping_type')) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding">
                            <div class="form-group col-lg-6 margin-bottom-0 @if($errors->has('premium_product')) has-error @endif">
                                {!! Form::label('premium_product','Premium Product',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    {!! Form::select('premium_product',array('2'=>'YES','1'=>'NO'),null,['class'=>'form-control','placeholder'=>'Select product premium..']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('premium_product')) !!}</p>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 margin-bottom-0">
                                {!! Form::label('admin_promotion','Champain Promotion',['class'=>'col-sm-4 no-padding control-label']) !!}
                                <div class="col-sm-8 no-padding">
                                    <?php
                                        $adminPromotion = \App\AdminPromotion::get();
                                    ?>
                                    <select class="form-control" id="admin_promotion" name="admin_promotion">
                                        <option selected="selected" value="">Select admin promotion..</option>
                                        @foreach($adminPromotion as $promotion)
                                            <?php
                                                if($promotion->value_type == 0){
                                                    $type = '%';
                                                }else{
                                                    $type = '$';
                                                }

                                            ?>
                                        <option value="{{$promotion->id}}">{{$promotion->value }} {{$type}} ({{$promotion->name}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs gray-bg">
                                <li class="active"><a data-toggle="tab" href="#details">Detail</a></li>
                                <li><a data-toggle="tab" href="#images">Images</a></li>
                                <li><a data-toggle="tab" href="#imageFeatured">Galleries</a></li>
                                <li><a data-toggle="tab" href="#video">Video</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="details" class="tab-pane fade in active">
                                    <div class="col-sm-12 no-padding padding-top-10px">
                                        <div class="form-group col-lg-12 no-padding @if ($errors->has('detail')) has-error @endif">
                                            <label class="col-sm-2 no-padding">Detail</label>
                                            <div class="col-sm-10 no-padding">
                                                {!! Form::textarea('detail',old('detail'),['class'=>'form-control']) !!}
                                                <p class="help-block">{!! implode('<br/>', $errors->get('detail')) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="images" class="tab-pane fade">
                                    <div class="col-sm-12 no-padding padding-top-10px">
                                        <div class="form-group col-lg-12 no-padding">
                                            {!! form::label('thumbnails','Images (*Max = 2MB)',['class'=>'col-sm-2 no-padding control-label']) !!}
                                            <div class="col-sm-10 no-padding">
                                                <div class="dropzone" id="dropzoneFileUpload">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
                                    <script type="text/javascript">
                                        var baseUrl = "{{ url('/'.$userId) }}";
                                        var token = "{{ Session::token() }}";
                                        Dropzone.autoDiscover = false;
                                        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
                                            url: baseUrl + "/shop_thumbnail/uploadFiles",
                                            params: {
                                                _token: token
                                            }
                                        });
                                        Dropzone.options.myDropzone = {
                                            paramName: "file", // The name that will be used to transfer the file
                                            maxFilesize: 2, // MB
                                            addRemoveLinks: true,
                                            dictCancelUpload:true,
                                            dictCancelUploadConfirmation:true,
                                            dictRemoveFile:true,
                                            accept: function(file, done) {

                                            },
                                        };
                                    </script>
                                </div>
                                <div id="imageFeatured" class="tab-pane fade">
                                    <div class="col-sm-12 no-padding padding-top-10px">
                                        <div class="form-group col-lg-6 no-padding margin-bottom-0 @if($errors->has('feature_image_detail')) has-error @endif">
                                            {!! form::label('feature_image_detail','Image Detail',['class'=>'col-sm-4 no-padding control-label']) !!}
                                            <div class="col-sm-8 no-padding">
                                                <input type="file" id="feature_image_detail" accept="image/*" name="feature_image_detail">
                                                <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail')) !!}</p>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 no-padding margin-bottom-0 @if($errors->has('feature_image_detail_1')) has-error @endif">
                                            {!! form::label('feature_image_detail_1','Image Detail 1',['class'=>'col-sm-4 no-padding control-label']) !!}
                                            <div class="col-sm-8 no-padding">
                                                <input type="file" id="feature_image_detail_1" accept="image/*" name="feature_image_detail_1">
                                                <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_1')) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 no-padding">
                                        <div class="form-group col-lg-6 no-padding margin-bottom-0 @if($errors->has('feature_image_detail_2')) has-error @endif">
                                            {!! form::label('feature_image_detail_2','Image Detail 2',['class'=>'col-sm-4 no-padding control-label']) !!}
                                            <div class="col-sm-8 no-padding">
                                                <input type="file" id="feature_image_detail_2" accept="image/*" name="feature_image_detail_2">
                                                <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_2')) !!}</p>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 no-padding margin-bottom-0 @if($errors->has('feature_image_detail_3')) has-error @endif">
                                            {!! form::label('feature_image_detail_3','Image Detail 3',['class'=>'col-sm-4 no-padding control-label']) !!}
                                            <div class="col-sm-8 no-padding">
                                                <input type="file" id="feature_image_detail_3" accept="image/*" name="feature_image_detail_3">
                                                <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_3')) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 no-padding">
                                        <div class="form-group col-lg-6 no-padding margin-bottom-0 @if($errors->has('feature_image_detail_4')) has-error @endif">
                                            {!! form::label('feature_image_detail_4','Image Detail 4',['class'=>'col-sm-4 no-padding control-label']) !!}
                                            <div class="col-sm-8 no-padding">
                                                <input type="file" id="feature_image_detail_4" accept="image/*" name="feature_image_detail_4">
                                                <p class="help-block">{!! implode('<br/>', $errors->get('feature_image_detail_4')) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="video" class="tab-pane fade">
                                    <div class="col-sm-12 no-padding padding-top-10px">
                                        <div class="form-group col-lg-6 no-padding margin-bottom-0">
                                            {!! form::label('video_upload','Video Upload',['class'=>'col-sm-4 no-padding control-label']) !!}
                                            <div class="col-sm-8 no-padding">
                                                <input type="file" name="video_upload" accept="video/*">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 no-padding margin-bottom-0">
                                            {!! form::label('video_url','Video Link',['class'=>'col-sm-4 no-padding control-label']) !!}
                                            <div class="col-sm-8 no-padding">
                                                {!! Form::text('video_url',null,['class'=>'form-control','placeholder'=>'Enter video url']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 padding-top-10px">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Submit</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>

                        </div>

                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection