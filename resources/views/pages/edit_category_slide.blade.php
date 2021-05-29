@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Promotion Slide</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Category Slide
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::model($categorySlide,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            <div class="form-group @if($errors->has('category_id')) has-error @endif">
                                {!! Form::label('category_slide','Category Name*',['class'=>'control-label']) !!}
                                {!! Form::select('category_id',$CategoryName,null,['class'=>'form-control','id'=>'category_slide','placeholder'=>'select any category Name...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('category_id')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('product_id')) has-error @endif">
                                {!! Form::label('product_id','Product Code',['class'=>'control-label']) !!}
                                {!! Form::select('product_id',$product_code,null,['class'=>'form-control','placeholder'=>'select any product code...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('product_id')) !!}</p>
                            </div>
                            <div class="form-group">
                                {!! Form::label('url','External URL',['class'=>'control-label']) !!}
                                {!! Form::text('url',null,['class'=>'form-control','placeholder'=>'Enter URL...']) !!}
                                <input type="checkbox" value="1" name="open_new_tab" @if($categorySlide->open_new_tab == 1) checked @endif> Open new tab
                                <p class="help-block">Optional</p>
                            </div>
                            <div class="form-group @if($errors->has('slide_type')) has-error @endif">
                                {!! Form::label('slide_type','Slide Type*',['class'=>'control-label']) !!}
                                {!! Form::select('slide_type',['1'=>'Vertical','2'=>'Horizontal','3'=>'Header Vertical','4'=>'Header Top Horizontal','5'=>'Advertise Left','6'=>'Footer Image','7'=>'Product Banner','8'=>'Brand Zone Banner','9'=>'Brand Zone Banner Haft','10'=>'Banner Beauty Or Cloth','11'=>'Banner Special Page','12'=>'Horizontal Shop Page','13'=>'Feature Banner','14'=>'Horizontal Top Mobile','15'=>'Advertise Right','17'=>'Horizontal After Top Mobile','18'=>'ECamMall Category Banner'],null,['class'=>'form-control','placeholder'=>'select type of slide...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('slide_type')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image_vertical')) has-error @endif image_vertical">
                                {!! form::label('image_vertical','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image_vertical" accept="image/*" name="image_vertical">
                                <p class="help-block">Image side should be (262px x 410px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('image_vertical')) !!}</p>
                            </div>
                            <div class="form-group style_display @if($errors->has('style_display')) has-error @endif">
                                {!! Form::label('style_display','Style Display',['class'=>'control-label']) !!}
                                {!! Form::select('style_display',['1'=>'Big Banner','2'=>'Small Banner','3'=>'Middle Banner'],null,['class'=>'form-control','placeholder'=>'Select banner type']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('style_display')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('ecammall_category_banner')) has-error @endif ecammall_category_banner">
                                {!! form::label('ecammall_category_banner','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="ecammall_category_banner" accept="image/*" name="ecammall_category_banner">
                                <p class="help-block">Image size for Big Banner should be (282px x 460px) |Image size for Big Banner should be (282px x 153px) | Image size for Small Banner should be (180px x 180px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('ecammall_category_banner')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image_header_vertical')) has-error @endif image_header_vertical">
                                {!! form::label('image_header_vertical','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image_header_vertical" accept="image/*" name="image_header_vertical">
                                <p class="help-block">Image side should be (269px x 425px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('image_header_vertical')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image_header_horizontal')) has-error @endif image_header_horizontal">
                                {!! form::label('image_header_horizontal','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image_header_horizontal" accept="image/*" name="image_header_horizontal">
                                <p class="help-block">Image side should be (1920px x 80px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('image_header_horizontal')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image_ads_left')) has-error @endif image_ads_left">
                                {!! form::label('image_ads_left','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image_ads_left" accept="image/*" name="image_ads_left">
                                <p class="help-block">Image side should be (260px x 450px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('image_ads_left')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('footer_image')) has-error @endif footer_image">
                                {!! form::label('footer_image','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="footer_image" accept="image/*" name="footer_image">
                                <p class="help-block">Image side should be (229px x 155px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('footer_image')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('product_banner')) has-error @endif product_banner">
                                {!! form::label('product_banner','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="product_banner" accept="image/*" name="product_banner">
                                <p class="help-block">Image side should be (1170px x 150px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('product_banner')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('brand_zone_banner')) has-error @endif brand_zone_banner">
                                {!! form::label('brand_zone_banner','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="brand_zone_banner" accept="image/*" name="brand_zone_banner">
                                <p class="help-block">Image side should be (1170px x 150px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('brand_zone_banner')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('brand_zone_banner_haft')) has-error @endif brand_zone_banner_haft">
                                {!! form::label('brand_zone_banner_haft','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="brand_zone_banner_haft" accept="image/*" name="brand_zone_banner_haft">
                                <p class="help-block">Image side should be (585px x 177px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('brand_zone_banner_haft')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('beauty_banner')) has-error @endif beauty_banner">
                                {!! form::label('beauty_banner','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="beauty_banner" accept="image/*" name="beauty_banner">
                                <p class="help-block">Image side should be (1170px x 150px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('beauty_banner')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('banner_special_page')) has-error @endif banner_special_page">
                                {!! form::label('banner_special_page','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="banner_special_page" accept="image/*" name="banner_special_page">
                                <p class="help-block">Image side should be (1170px x 150px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('beauty_banner')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('horizontal_shop_page')) has-error @endif horizontal_shop_page">
                                {!! form::label('horizontal_shop_page','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="horizontal_shop_page" accept="image/*" name="horizontal_shop_page">
                                <p class="help-block">Image side should be (835px x 100px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('horizontal_shop_page')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('feature_banner')) has-error @endif feature_banner">
                                {!! form::label('feature_banner','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="feature_banner" accept="image/*" name="feature_banner">
                                <p class="help-block">Image side should be (600px x 154px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('feature_banner')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('horizontal_top_mobile')) has-error @endif horizontal_top_mobile">
                                {!! form::label('horizontal_top_mobile','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="horizontal_top_mobile" accept="image/*" name="horizontal_top_mobile">
                                <p class="help-block">Image side should be (1200px x 200px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('horizontal_top_mobile')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('horizontal_after_top_mobile')) has-error @endif horizontal_after_top_mobile">
                                {!! form::label('horizontal_after_top_mobile','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="horizontal_after_top_mobile" accept="image/*" name="horizontal_after_top_mobile">
                                <p class="help-block">Image side should be (1200px x 200px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('horizontal_after_top_mobile')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image')) has-error @endif image_horizontal">
                                {!! form::label('image','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image" accept="image/*" name="image">
                                <p class="help-block">Image side should be (1170px x 100px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('image')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('image_ads_right')) has-error @endif image_ads_right">
                                {!! form::label('image_ads_left','Image*',['class'=>'control-label']) !!}
                                <input type="file" id="image_ads_right" accept="image/*" name="image_ads_right">
                                <p class="help-block">Image side should be (260px x 450px)</p>
                                <p class="help-block">{!! implode('<br/>', $errors->get('image_ads_right')) !!}</p>
                            </div>
                            <div class="form-group page">
                                {!! Form::label('page','Page',['class'=>'control-label']) !!}
                                {!! Form::select('page',['1'=>'Best Seller','2'=>'Store Zone','3'=>'discount_deal'],null,['class'=>'form-control','placeholder'=>'Select any page for this banner']) !!}
                                <p class="help-block">Optional</p>
                            </div>
                            <div  class="form-group">
                                <img src="{{asset('images/home/'.$categorySlide->image)}}" style="width: 120px">
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
    <script src="{{asset('js/jquery.js')}}"></script>
    <script>
        if($('#slide_type').find('option:selected').val()==1){
            $('.image_vertical').show();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();

        }
        else if ($('#slide_type').find('option:selected').val()==2){
            $('.image_vertical').hide();
            $('.image_horizontal').show();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==3){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').show();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==4){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').show();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==5){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').show();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==6){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').show();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.feature_banner').hide();
            $('.horizontal_shop_page').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==7){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').show();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==8){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').show();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==9){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').show();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==10){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').show();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==11){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').show();
            $('.page').show();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==12){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').show();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==13){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').show();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==14){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').show();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==15){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').show();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==17){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').show();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        else if($('#slide_type').find('option:selected').val()==18){
            $('.image_vertical').hide();
            $('.image_horizontal').hide();
            $('.image_header_vertical').hide();
            $('.image_header_horizontal').hide();
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.ecammall_category_banner').show();
            $('.style_display').show();
        }
        else{
            $('.image_vertical').hide().find('select').val('');
            $('.image_horizontal').hide().find('select').val('');
            $('.image_header_vertical').hide().find('select').val('');
            $('.image_header_horizontal').hide().find('select').val('');
            $('.image_ads_left').hide();
            $('.footer_image').hide();
            $('.product_banner').hide();
            $('.brand_zone_banner').hide();
            $('.brand_zone_banner_haft').hide();
            $('.beauty_banner').hide();
            $('.banner_special_page').hide();
            $('.page').hide();
            $('.horizontal_shop_page').hide();
            $('.feature_banner').hide();
            $('.horizontal_top_mobile').hide();
            $('.horizontal_after_top_mobile').hide();
            $('.image_ads_right').hide();
            $('.ecammall_category_banner').hide();
            $('.style_display').hide();
        }
        $("select#slide_type").on('change', function(){
            if($(this).val()==1){
                $('.image_vertical').show();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==2){
                $('.image_vertical').hide();
                $('.image_horizontal').show();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==3){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').show();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==4){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').show();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==5){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').show();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==6){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').show();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==7){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').show();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==8){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').show();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==9){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').show();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==10){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').show();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==11){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').show();
                $('.page').show();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==12){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').show();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==13){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').show();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==14){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').show();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==15){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').show();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==17){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').show();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
            else if($(this).val()==18){
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').show();
                $('.style_display').show();
            }
            else{
                $('.image_vertical').hide();
                $('.image_horizontal').hide();
                $('.image_header_vertical').hide();
                $('.image_header_horizontal').hide();
                $('.image_ads_left').hide();
                $('.footer_image').hide();
                $('.product_banner').hide();
                $('.brand_zone_banner').hide();
                $('.brand_zone_banner_haft').hide();
                $('.beauty_banner').hide();
                $('.banner_special_page').hide();
                $('.page').hide();
                $('.horizontal_shop_page').hide();
                $('.feature_banner').hide();
                $('.horizontal_top_mobile').hide();
                $('.image_ads_right').hide();
                $('.horizontal_after_top_mobile').hide();
                $('.ecammall_category_banner').hide();
                $('.style_display').hide();
            }
        });
    </script>
@endsection