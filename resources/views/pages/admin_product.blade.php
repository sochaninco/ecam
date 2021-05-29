@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-11 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin Product</li>
                </ol>
            </nav>
        </div>
        <div class="col-lg-1">
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="{{url('admin_add_product')}}"><i class="fa fa-edit fa-fw"></i> Add New</a>
                    </li>
                    <li>
                        <a href="{{url('#')}}"><i class="fa fa-plus-circle fa-fw"></i> Add New </a>
                    </li>
                    <li>
                        <a href="{{url('#')}}"><i class="fa fa-plus-circle fa-fw"></i> Add New </a>
                    </li>
                    <li>
                        <a href="{{url('#')}}"><i class="fa fa-plus-circle fa-fw"></i> Add New </a>
                    </li>
                </ul>
            </div>
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
                    {{--{!! Form::open(['url'=>url('/admin_print_label/'),'method'=>'GET','files'=>true,'role'=>'form','target'=>'_blank']) !!}
                    <div class="form-group">
                        {!! Form::label('name','Name',['class'=>'col-sm-1 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter name..']) !!}
                        </div>
                        {!! Form::label('category','Category',['class'=>'col-sm-1 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('category',$category,null,['class'=>'form-control','placeholder'=>'Select any category..']) !!}
                        </div>
                        {!! Form::label('brand','Brand',['class'=>'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::select('brand',$brand,null,['class'=>'form-control','placeholder'=>'Select any brand..']) !!}
                        </div>
                        <div class="col-sm-1">
                            {!! Form::submit('Print Label',['class'=>'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <br><br><br>--}}
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Image</th>
                                <th> Product Code </th>
                                <th> Product Name</th>
                                <th> Categories </th>
                                {{--<th> Product Cost</th>--}}
                                <th> Product Price</th>
                                <th> Quantity </th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr class="even gradeC">
                                <td>
                                    <a data-toggle="modal" data-target="#productImageModal" id="{{$product->id}}" class="admin-product-image">
                                        <img src="{{asset('stock/assets/uploads/thumbs/'.$product->image)}}" class="img-responsive" style="width: 40px;height: 40px">
                                    </a>
                                </td>
                                <td><a data-toggle="modal" data-target="#productDetailModal" id="{{$product->id}}" class="admin-product-detail">{{$product->code}}</a></td>
                                <td><a data-toggle="modal" data-target="#productDetailModal" id="{{$product->id}}" class="admin-product-detail">{{substr($product->name,0,20)}}...</a></td>
                                <td>{{$product->c_name}}</td>
                                {{--<td>{{$product->cost}}</td>--}}
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td class="center">
                                    <a href="{{url('edit_product/'.$product->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i>
                                    </a>
                                    {{--<button type="button" class="btn btn-danger"><i class="fa fa-times"></i>--}}
                                    {{--</button>--}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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


    <!-- Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" role="dialog" aria-labelledby="productDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="productDetailModalBody">
                    ...
                </div>
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="productImageModal" tabindex="-1" role="dialog" aria-labelledby="productImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productImageModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="productImageModalBody">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection
