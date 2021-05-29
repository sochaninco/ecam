@extends('layouts.app')
@section('title','My New Product')
@section('my_new_product','active')
@section('content')
    <div class="container">
        <div class="row white-bg">
            @include('pages.users.my_ecammall_menu_buy')
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
                    <h2 class="title text-center">
                        Edit Product
                    </h2>
                    {!! Form::model($Product,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                    <div class="col-lg-12 no-padding">
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('category_id')) has-error @endif">
                            {!! Form::label('category_id','Category*',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::hidden('sku',$sku,['class'=>'form-control']) !!}
                                {!! Form::select('category_id',$Category,null,['id'=>'product_category_id','class'=>'form-control','placeholder'=>'Select any category..']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('category_id')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('sub_category_id')) has-error @endif">
                            {!! Form::label('sub_category_id','SubCategory*',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                <select class="form-control " name="sub_category_id" id="sub_category_id">
                                    <option value="{{$Product->sub_category_id}}">{{$SubCategory->name}}</option>
                                </select>
                                <p class="help-block">{!! implode('<br/>', $errors->get('sub_category_id')) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 no-padding">
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('brand')) has-error @endif">
                            {!! Form::label('brand','Brand',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::select('brand',$brand,$Product->brand,['class'=>'form-control','placeholder'=>'Select any brand..']) !!}
                                {!! Form::hidden('location',$location) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('brand')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('quantity')) has-error @endif">
                            {!! Form::label('quantity','QTY in Stock*',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::text('quantity',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('quantity')) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 no-padding">
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('code')) has-error @endif">
                            {!! Form::label('code','Coupon Code',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::select('code',$couponCode,null,['class'=>'form-control','placeholder'=>'select any coupon type']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('code')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('name')) has-error @endif">
                            {!! Form::label('name','Product Name*',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('name')) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 no-padding">
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('cost')) has-error @endif">
                            {!! Form::label('cost','Cost*',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::text('cost',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('cost')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('price')) has-error @endif">
                            {!! Form::label('price','Selling Price*',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                <input type="text" class="form-control" id="price" value="{{$Product->price}}" name="price" placeholder="input number only" onClick="this.select();" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                <p class="help-block">{!! implode('<br/>', $errors->get('price')) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 no-padding">
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('promotion')) has-error @endif">
                            {!! Form::label('promotion','Promotion',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::select('promotion',$promotion,null,['class'=>'form-control','placeholder'=>'Select any promotion type..']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('promotion')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('item_condition')) has-error @endif">
                            {!! Form::label('item_condition','Product Condition',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::select('item_condition',array('0'=>'NEW','1'=>'USED'),null,['class'=>'form-control','placeholder'=>'Select item condition..']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('item_condition')) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 no-padding">
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('discount_rate')) has-error @endif">
                            {!! Form::label('discount_rate','Discount Rate (%)',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                <input type="text" class="form-control" id="discount_rate" value="{{$Product->discount_rate}}" name="discount_rate" placeholder="input number only" onClick="this.select();" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                {{--{!! Form::text('discount_rate',null,['class'=>'form-control']) !!}--}}
                                <p class="help-block">{!! implode('<br/>', $errors->get('discount_rate')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0">
                            {!! Form::label('price_after_discount','Price after Discount',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::text('price_after_discount',number_format($Product->price*(1-($Product->discount_rate/100)),2),['class'=>'form-control','readonly']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 no-padding">
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('unit')) has-error @endif">
                            {!! Form::label('unit','Unit*',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                <?php
                                $arrayUnit = ['Box'=>'Box','pcs'=>'pcs','cm'=>'cm','Bottle'=>'Bottle','Lite'=>'Lite','ml'=>'ml'];
                                ?>
                                {!! Form::select('unit',$arrayUnit,null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('unit')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('shipping_type')) has-error @endif">
                            {!! Form::label('shipping_type','Shipping Type',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::select('shipping_type',array('0'=>'Free Shipping','1'=>'None'),null,['class'=>'form-control','placeholder'=>'Select shipping Type..']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('shipping_type')) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 no-padding">
                        <div class="form-group col-lg-6 padding-5px margin-bottom-0 @if($errors->has('premium_product')) has-error @endif">
                            {!! Form::label('premium_product','Premium Product',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                {!! Form::select('premium_product',array('2'=>'YES','1'=>'NO'),null,['class'=>'form-control','placeholder'=>'Select product premium..']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('premium_product')) !!}</p>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 margin-bottom-0">
                            {!! Form::label('admin_promotion','Admin Promotion',['class'=>'col-sm-4 no-padding control-label']) !!}
                            <div class="col-sm-8 no-padding">
                                <?php
                                $adminPromotion = \App\AdminPromotion::get();
                                $promotionSelect = \App\AdminPromotion::where('id',$Product->admin_promotion)->first();
                                if($promotionSelect){
                                    if($promotionSelect->value_type == 0){
                                        $type = '%';
                                    }else{
                                        $type = '$';
                                    }

                                    $adminPromotion = \App\AdminPromotion::whereNotIn('id',[$promotionSelect->id])->get();
                                }
                                ?>
                                <select class="form-control" id="admin_promotion" name="admin_promotion">
                                    <option selected="selected" value="">Select admin promotion..</option>
                                    @if($promotionSelect)
                                        <option selected="selected" value="{{$Product->admin_promotion}}">{{$promotionSelect->value}} {{$type}} ({{$promotionSelect->name}})</option>
                                    @endif
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
                    <div class="col-sm-12 no-padding">
                        <ul class="nav nav-tabs gray-bg">
                            <li class="active"><a data-toggle="tab" href="#details">Details</a></li>
                            <li><a data-toggle="tab" href="#images">Images</a></li>
                            <li><a data-toggle="tab" href="#imageFeatured">Galleries</a></li>
                            <li><a data-toggle="tab" href="#video">Video</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="details" class="tab-pane fade in active">
                                <div class="col-sm-12 padding-5px padding-top-10px">
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
                                <div class="col-sm-12 padding-5px padding-top-10px">
                                    <div class="form-group col-lg-12 no-padding">
                                        {!! form::label('thumbnails','Images (*Max = 2MB)',['class'=>'col-sm-2 no-padding control-label']) !!}
                                        <div class="col-sm-10 no-padding">
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
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
                                <script type="text/javascript">
                                    var baseUrl = "{{ url('/'.Auth::user()->id) }}";
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
                            </div>
                            <div id="imageFeatured" class="tab-pane fade">
                                <div class="col-sm-12 padding-5px padding-top-10px">
                                    <div class="form-group col-lg-12 no-padding @if($errors->has('feature_image_detail')) has-error @endif">
                                        {!! form::label('feature_image_detail','Image Feature',['class'=>'col-sm-2 no-padding control-label']) !!}
                                        <div class="col-sm-10 no-padding">
                                            <table class="table table-responsive table-responsive table-striped">
                                                <tr>
                                                    <th>Detail</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                    <th>New File</th>
                                                </tr>
                                                <tr>
                                                    <td>Image detail</td>
                                                    <td>
                                                        <div class="feature_image">
                                                            @if(!empty($Product->feature_image_detail))
                                                                <img src="{{asset('images/user-shop/product/'.$Product->feature_image_detail)}}" width="120px"  height="150px">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if(!empty($Product->feature_image_detail))
                                                            <a style="cursor:pointer;" class="delete_feature_image" id="{{$Product->id}}" name="1">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="file" id="feature_image_detail" accept="image/*" name="feature_image_detail">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Image Detail 1</td>
                                                    <td>
                                                        <div class="feature_image_1">
                                                            @if(!empty($Product->feature_image_detail_1))
                                                                <img src="{{asset('images/user-shop/product/'.$Product->feature_image_detail_1)}}" width="120px"  height="150px">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if(!empty($Product->feature_image_detail_1))
                                                            <a style="cursor:pointer;" class="delete_feature_image" id="{{$Product->id}}" name="2">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="file" id="feature_image_detail_1" accept="image/*" name="feature_image_detail_1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Image Detail 2</td>
                                                    <td>
                                                        <div class="feature_image_2">
                                                            @if(!empty($Product->feature_image_detail_2))
                                                                <img src="{{asset('images/user-shop/product/'.$Product->feature_image_detail_2)}}" width="120px"  height="150px">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if(!empty($Product->feature_image_detail_2))
                                                            <a style="cursor:pointer;" class="delete_feature_image" id="{{$Product->id}}" name="3">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="file" id="feature_image_detail_2" accept="image/*" name="feature_image_detail_2">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Image Detail 3</td>
                                                    <td>
                                                        <div class="feature_image_3">
                                                            @if(!empty($Product->feature_image_detail_3))
                                                                <img src="{{asset('images/user-shop/product/'.$Product->feature_image_detail_3)}}" width="120px"  height="150px">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if(!empty($Product->feature_image_detail_3))
                                                            <a style="cursor:pointer;" class="delete_feature_image" id="{{$Product->id}}" name="4">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="file" id="feature_image_detail_3" accept="image/*" name="feature_image_detail_3">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Image Detail 4</td>
                                                    <td>
                                                        <div class="feature_image_4">
                                                            @if(!empty($Product->feature_image_detail_4))
                                                                <img src="{{asset('images/user-shop/product/'.$Product->feature_image_detail_4)}}" width="120px"  height="150px">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if(!empty($Product->feature_image_detail_4))
                                                            <a style="cursor:pointer;" class="delete_feature_image" id="{{$Product->id}}" name="5">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="file" id="feature_image_detail_4" accept="image/*" name="feature_image_detail_4">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="video" class="tab-pane fade">
                                <div class="col-sm-12 padding-5px padding-top-10px">
                                    <div class="form-group col-lg-6 no-padding">
                                        {!! form::label('video_upload','Video Upload',['class'=>'col-sm-4 no-padding control-label']) !!}
                                        <div class="col-sm-8 no-padding">
                                            <table class="table table-responsive table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Video</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="row_thumb">
                                                        <td>{{$Product->video_upload}} </td>
                                                        <td><a style="cursor: pointer" class="delete_video" id="{{$Product->video_upload}}" productId ="{{$Product->id}}"><i class="fa fa-trash"></i> </a> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <input type="file" name="video_upload" accept="video/*">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6 no-padding">
                                        {!! form::label('video_url','Video Link',['class'=>'col-sm-4 no-padding control-label']) !!}
                                        <div class="col-sm-8 no-padding">
                                            {!! Form::text('video_url',null,['class'=>'form-control','placeholder'=>'Enter video url']) !!}
                                            <p class="help-block">url from (youtube, vimeo)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Update</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection