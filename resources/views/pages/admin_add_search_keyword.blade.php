<?php
$keywordId = isset($searchKeyword->id) ? $searchKeyword->id : null;
?>
@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($keywordId)
                <h1 class="page-header"> Update Keyword</h1>
            @else
                <h1 class="page-header">Add Keyword</h1>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($keywordId)
                        Update Keyword
                    @else
                        Add Keyword
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            @if($keywordId)
                                {!! Form::model($searchKeyword,['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @else
                                {!! Form::Open(['method'=>'POST','files'=>true,'role'=>'form']) !!}
                            @endif
                            <?php
                                $labelText = \App\SearchKeyword::where('label_promo','!=','')->first();
                            ?>
                            <div class="form-group @if($errors->has('label_promo')) has-error @endif">
                                {!! Form::label('label_promo','Label Promotion Text',['class'=>'control-label']) !!}
                                {!! Form::text('label_promo',$labelText->label_promo,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('label_promo')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('type')) has-error @endif">
                                {!! Form::label('type','Type',['class'=>'control-label']) !!}
                                {!! Form::select('type',['0'=>'Search Keyword','1'=>'exhibition'],null,['class'=>'form-control','placeholder'=>'Select type option ...']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('type')) !!}</p>
                            </div>
                            <div class="form-group @if($errors->has('keyword')) has-error @endif">
                                {!! Form::label('keyword','Keyword*',['class'=>'control-label']) !!}
                                {!! Form::text('keyword',null,['class'=>'form-control']) !!}
                                <p class="help-block">{!! implode('<br/>', $errors->get('keyword')) !!}</p>
                            </div>
                            <div class="col-sm-12 no-padding shop_exhibition">
                                <div class="col-sm-6 form-group no-padding">
                                    <?php
                                        $shops = \App\PageShops::where('status',0)->pluck('shop_name','user_id');
                                    ?>
                                    {!! Form::label('shop','Select Shop',['class'=>'control-label']) !!}
                                    {!! Form::select('shop',$shops,null,['class'=>'form-control','placeholder'=>'Select any shop ...']) !!}
                                </div>
                                <div class="col-sm-6 form-group no-padding">
                                    {!! Form::label('product_by_shop','Product By Shop',['class'=>'control-label']) !!}
                                    <select class="form-control " name="product_by_shop" id="product_by_shop">
                                        @if($keywordId and $searchKeyword->type == 1)
                                            <?php
                                                $productInfo = \App\ShopProduct::where('id',$searchKeyword->product_by_shop)->first();
                                            ?>
                                            <option value="{{$searchKeyword->product_by_shop}}" selected> {{$productInfo->name}}</option>
                                        @endif
                                        <option value="">Select any product ...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 no-padding link_to">
                                <div class="form-group col-sm-6 no-padding @if($errors->has('link_to')) has-error @endif">
                                    {!! Form::label('link_to','Link To',['class'=>'control-label']) !!}
                                    {!! Form::select('link_to',['0'=>'Search Page','1'=>'Category Page','2'=>'Subcategory page'],null,['class'=>'form-control','placeholder'=>'Select link to option ...']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('link_to')) !!}</p>
                                </div>
                                <div class="keyword-category form-group col-sm-6 no-padding @if($errors->has('category_id')) has-error @endif">
                                    {!! Form::label('category_id','Category',['class'=>'control-label']) !!}
                                    {!! Form::select('category_id',$categories,null,['class'=>'form-control']) !!}
                                    <p class="help-block">{!! implode('<br/>', $errors->get('category_id')) !!}</p>
                                </div>
                            </div>
                            <div class="col-sm-12 no-padding keyword-subcategory">
                                <div class="form-group col-sm-6 no-padding">
                                    {!! Form::label('sub_category_id','Sub Category',['class'=>'control-label']) !!}
                                    <select class="form-control " name="sub_category_id" id="sub_category_id">
                                        <option value="">Select any Subcategory ...</option>
                                    </select>
                                </div>
                            </div>
                            @if($keywordId)
                                <button type="submit" class="btn btn-default">Update</button>
                            @else
                                <button type="submit" class="btn btn-default">Submit</button>
                            @endif
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
    @if($keywordId)
        <script>
            $('.shop_exhibition').hide();
        </script>
    @endif