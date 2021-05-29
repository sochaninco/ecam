<?php
$_name = isset($q['sma_products.name'])?($q['sma_products.name']):null;
$_category = isset($q['category_id'])?($q['category_id']):null;
$_brand = isset($q['brand'])?($q['brand']):null;
$_width = isset($width)?($width):null;
$_height = isset($height)?($height):null;
$_image = isset($image)?$image:null;
?>
@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Print Label</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All file for download
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::open(['url'=>url('/admin_print_label_form/'),'method'=>'GET','files'=>true,'role'=>'form']) !!}
                        {!! Form::label('name','Name',['class'=>'col-sm-1 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('name',$_name,['class'=>'form-control','placeholder'=>'Enter name..']) !!}
                        </div>
                        {!! Form::label('category','Category',['class'=>'col-sm-1 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('category',$category,$_category,['class'=>'form-control','placeholder'=>'Select any category..']) !!}
                        </div>
                        {!! Form::label('brand','Brand',['class'=>'col-sm-1 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('brand',$brand,$_brand,['class'=>'form-control','placeholder'=>'Select any brand..']) !!}
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        {!! Form::label('width','Width (mm)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('width',$_width,['class'=>'form-control','placeholder'=>'Enter Width']) !!}
                        </div>
                        {!! Form::label('height','Height (mm)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('height',$_height,['class'=>'form-control','placeholder'=>'Enter Height..']) !!}
                        </div>
                        <div class="col-sm-1 control-label">
                        <input type="checkbox" name="image" value="true" @if($_image == true) checked @endif>
                        </div>
                        <div class="col-sm-2">
                            {!! Form::label('image','Image',['class'=>'control-label']) !!}
                        </div>
                        <div class="col-sm-1">
                            {!! Form::submit('Search',['class'=>'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <br>
                    @if(!empty($_name) || !empty($_category) || !empty($_brand))
                    <div class="form-group pull-right" style="margin-top:10px">
                        <a href="{{url('admin_print_label/?name='.$_name.'&category='.$_category.'&brand='.$_brand.'&width='.$width.'&height='.$height.'&image='.$_image)}}" target="_blank" class="btn btn-info">Print All Result
                        </a>
                    </div>
                    @endif
                    <br>
                    @if(!empty($products))
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Product Code </th>
                                <th> Product Name</th>
                                <th> Categories </th>
                                {{--<th> Product Cost</th>--}}
                                <th> Product Price</th>
                                <th> Quantity </th>
                                <th> Image</th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr class="even gradeC">
                                    <td>{{$product->code}}</td>
                                    <td>{{substr($product->name,0,20)}}...</td>
                                    <td>{{$product->c_name}}</td>
                                    {{--<td>{{$product->cost}}</td>--}}
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td><img src="{{asset('http://ecammall.com/stock/assets/uploads/'.$product->image)}}" class="img-responsive" width="50px"></td>
                                    <td class="center">
                                        <a href="{{url('admin_print_label/?id='.$product->id)}}" target="_blank" class="btn btn-warning"><i class="fa fa-print"></i>
                                        </a>
                                        {{--<button type="button" class="btn btn-danger"><i class="fa fa-times"></i>--}}
                                        {{--</button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    <!-- /.table-responsive -->
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